# Laravel Admin Panel Setup

This document provides instructions for setting up and using the enhanced admin panel for your Laravel 101 project.

## Features

- **Admin Authentication**: Separate login system for administrators
- **Complete User Management**: 
  - Approve/reject user registrations with email notifications
  - Edit user information
  - Activate/deactivate users (ban spammers)
  - Delete users with confirmation
  - View user activity and listing history
  - Filter users by status (approved, pending, active, inactive)
- **Listing Management**: View, edit, and delete any listing
- **Dashboard**: Overview of users, listings, pending approvals, and recent activity
- **User Approval Workflow**: New users must be approved before creating listings
- **Email Notifications**: Optional approval/rejection email system
- **Advanced Permissions**: Active status and approval status management

## Setup Instructions

### 1. Run Migrations

```bash
php artisan migrate
```

This will create:
- `admins` table for admin accounts
- Add `is_approved`, `is_active`, `rejection_reason`, `approved_at`, `deactivated_at` columns to `users` table

### 2. Seed Admin Users

```bash
php artisan db:seed --class=AdminSeeder
```

Or run all seeders:
```bash
php artisan db:seed
```

Default admin account:
- **Admin**: admin@laravel101.com / password

### 3. Access Admin Panel

Navigate to: `/admin/login`

Login with admin credentials above.

## Admin Routes

All admin routes are prefixed with `/admin`:

- `/admin/login` - Admin login page
- `/admin/dashboard` - Admin dashboard
- `/admin/users` - Manage all users
- `/admin/users/pending` - View pending user approvals
- `/admin/users/{id}/edit` - Edit user information
- `/admin/users/{id}/activity` - View user activity
- `/admin/listings` - Manage all listings
- `/admin/settings` - Admin settings

## User Management Features

### User Status Management
- **Approval Status**: `is_approved` (boolean) - Controls if user can create listings
- **Active Status**: `is_active` (boolean) - Controls if user account is active
- **Rejection Reason**: `rejection_reason` (text) - Stores reason for rejection
- **Approval Date**: `approved_at` (datetime) - When user was approved
- **Deactivation Date**: `deactivated_at` (datetime) - When user was deactivated

### User Actions Available
- **Approve User**: Approve pending users (sets `is_approved = true`, `approved_at = now()`)
- **Reject User**: Reject users with reason (sets `rejection_reason`)
- **Edit User**: Update user name, email, and active status
- **Activate User**: Reactivate deactivated users
- **Deactivate User**: Temporarily ban users (sets `is_active = false`)
- **Delete User**: Permanently remove users with confirmation
- **View Activity**: See all listings submitted by user with application counts

### Filtering & Search
- Filter users by: All, Approved, Pending, Active, Inactive
- Search users by name or email
- Pagination for large user lists

## User Approval Workflow

1. New users register through normal registration process
2. Users are created with `is_approved = false` and `is_active = true` by default
3. Unapproved users cannot access:
   - Listing creation (`/listings/create`)
   - Listing management (`/listings/manage`)
   - Edit/delete their own listings
4. Admins can approve/reject users from admin panel with optional email notifications
5. Approved and active users can create and manage listings normally

## Security & Permissions

### Middleware Protection
- **Admin Authentication**: All admin routes protected with `auth:admin`
- **User Approval**: Listing routes protected with `approved.user` middleware
- **Permission Checks**: Users must be both approved AND active to create listings

### User Permission Logic
```php
// User can create listings if:
$user->is_approved && $user->is_active

// Available helper methods:
$user->isApproved()     // Returns boolean
$user->isActive()       // Returns boolean  
$user->canCreateListings() // Returns boolean
```

## Models

### Admin Model
- Uses `Authenticatable` trait
- Fields: `name`, `email`, `password`, `role`
- Located in: `app/Models/Admin.php`

### User Model (Extended)
- Added fields: `is_approved`, `is_active`, `rejection_reason`, `approved_at`, `deactivated_at`
- Added methods: `isApproved()`, `isActive()`, `canCreateListings()`
- Added scopes: `approved()`, `pending()`, `active()`, `inactive()`
- Located in: `app/Models/User.php`

## Controllers

### AdminController
Enhanced single controller handling all admin functionality:
- `showLoginForm()` - Admin login form
- `login()` - Admin authentication
- `logout()` - Admin logout
- `dashboard()` - Statistics overview
- `users()` - User management with filtering
- `pendingUsers()` - Pending user approvals
- `editUser()` - Edit user information
- `updateUser()` - Update user data
- `approveUser($id)` - Approve user with email notification
- `rejectUser($id)` - Reject user with reason and email notification
- `activateUser($id)` - Activate deactivated users
- `deactivateUser($id)` - Deactivate users (temporary ban)
- `deleteUser($id)` - Permanently delete users
- `userActivity($id)` - View user's listing activity
- `manageListings()` - Listing management

## Frontend Integration

All admin controllers return Inertia responses to Vue components:

### Admin Pages (Vue)
```
resources/js/Pages/Admin/
├── Layout/
│   └── AdminLayout.vue
├── Components/
│   ├── AdminSidebar.vue
│   ├── AdminCard.vue
│   └── AdminFlashMessage.vue
├── Pages/
│   ├── Dashboard.vue
│   ├── Users.vue
│   ├── PendingUsers.vue
│   ├── EditUser.vue
│   ├── UserActivity.vue
│   ├── Listings.vue
│   └── Settings.vue
└── Auth/
    └── Login.vue
```

### Page Features
- **Dashboard.vue**: Statistics cards and recent activity
- **Users.vue**: Complete user management with filtering, search, and all actions
- **PendingUsers.vue**: Dedicated pending user approval interface
- **EditUser.vue**: User information editing form
- **UserActivity.vue**: User's listing history with application counts
- **Listings.vue**: Listing management with view/edit/delete
- **Settings.vue**: Admin profile and system settings
- **Login.vue**: Admin login form
- **AdminLayout.vue**: Navigation with dropdown menus

## Email Notifications (Optional)

The system includes commented code for email notifications. To enable:

1. Configure your mail settings in `.env`
2. Uncomment the email code in `AdminController`
3. Create the mail mailables (`UserApproved`, `UserRejected`)

Example email templates:
- **Approval**: "Your account has been approved. You can now create listings."
- **Rejection**: "Your account was rejected for the following reason: [reason]"

## Database Schema

### Admins Table
```sql
- id (bigint, primary)
- name (string)
- email (string, unique)
- email_verified_at (timestamp, nullable)
- password (string, hashed)
- role (string, nullable)
- remember_token (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### Users Table (Extended)
```sql
- ... existing columns ...
- is_approved (boolean, default false)
- is_active (boolean, default true)
- rejection_reason (text, nullable)
- approved_at (timestamp, nullable)
- deactivated_at (timestamp, nullable)
```

## API Endpoints

All admin functionality is available through standard HTTP routes (not REST API):
- User management: `/admin/users/*`
- Listing management: `/admin/listings/*`
- Authentication: `/admin/login`, `/admin/logout`

## Security Considerations

1. **Separate Guards**: Admin authentication uses a separate guard
2. **Middleware Protection**: All admin routes are protected
3. **User Approval**: New users cannot create listings until approved
4. **Account Management**: Admins can deactivate/ban problematic users
5. **Email Verification**: Optional email notifications for user actions

## Next Steps

1. **Customize Admin Panel**: Modify Vue components to match your design
2. **Enable Email Notifications**: Configure mail settings and uncomment email code
3. **Add Permissions**: Implement role-based permissions for different admin actions
4. **Audit Logging**: Add logging for admin actions
5. **Reports**: Create additional dashboard reports and analytics
6. **API Integration**: Add REST API endpoints if needed

## Compatibility

This admin panel is fully compatible with:
- Laravel 10
- Vue 3
- Inertia.js
- Existing project conventions
- Current UserController and ListingController functionality
