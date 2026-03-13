<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function showLoginForm(): Response
    {
        return Inertia::render('Admin/Auth/Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }

    public function dashboard(): Response
    {
        $totalUsers = User::count();
        $totalListings = Listing::count();
        $pendingUsers = User::where('is_approved', false)->count();
        $approvedUsers = User::where('is_approved', true)->count();
        $pendingListings = Listing::where('is_approved', false)->count();
        $featuredListings = Listing::where('featured_until', '>', now())->count();
        
        $recentUsers = User::latest()->take(5)->get();
        $recentListings = Listing::with('user')->latest()->take(5)->get();

        return Inertia::render('Admin/Pages/Dashboard', [
            'totalUsers' => $totalUsers,
            'totalListings' => $totalListings,
            'pendingUsers' => $pendingUsers,
            'approvedUsers' => $approvedUsers,
            'pendingListings' => $pendingListings,
            'featuredListings' => $featuredListings,
            'recentUsers' => $recentUsers,
            'recentListings' => $recentListings,
        ]);
    }

    public function settings(): Response
    {
        $settings = Setting::all();
        $autoApproveUsers = Setting::get('auto_approve_users', false);
        $currentAdmin = Auth::guard('admin')->user();
        
        return Inertia::render('Admin/Pages/Settings', [
            'settings' => $settings,
            'autoApproveUsers' => $autoApproveUsers,
            'auth' => [
                'admin' => $currentAdmin
            ]
        ]);
    }

    public function users(): Response
    {
        $users = User::latest()->paginate(10);

        return Inertia::render('Admin/Pages/Users', [
            'users' => $users,
            'pendingCount' => User::where('is_approved', false)->count(),
        ]);
    }

    public function pendingUsers(): Response
    {
        $pendingUsers = User::pending()->latest()->paginate(10);

        return Inertia::render('Admin/Pages/PendingUsers', [
            'users' => $pendingUsers,
        ]);
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_approved' => true,
            'approved_at' => now(),
            'rejection_reason' => null
        ]);

        // Send approval email (optional)
        try {
            // Mail::to($user->email)->send(new UserApproved($user));
        } catch (\Exception $e) {
            // Log email error but continue
        }

        return redirect()->back()->with('success', 'User approved successfully.');
    }

    public function rejectUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $user->update([
            'is_approved' => false,
            'rejection_reason' => $request->rejection_reason
        ]);

        // Send rejection email (optional)
        try {
            // Mail::to($user->email)->send(new UserRejected($user, $request->rejection_reason));
        } catch (\Exception $e) {
            // Log email error but continue
        }

        return redirect()->back()->with('success', 'User rejected successfully.');
    }

    public function editUser($id): Response
    {
        $user = User::findOrFail($id);
        
        return Inertia::render('Admin/Pages/EditUser', [
            'user' => $user,
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'is_active' => 'boolean',
        ]);

        $user->update($request->only(['name', 'email', 'is_active']));

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function deactivateUser($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => false,
            'deactivated_at' => now()
        ]);

        return redirect()->back()->with('success', 'User deactivated successfully.');
    }

    public function activateUser($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => true,
            'deactivated_at' => null
        ]);

        return redirect()->back()->with('success', 'User activated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function userActivity($id): Response
    {
        $user = User::findOrFail($id);
        $listings = $user->listings()->withCount('applications')->latest()->paginate(10);

        return Inertia::render('Admin/Pages/UserActivity', [
            'user' => $user,
            'listings' => $listings,
        ]);
    }

    public function manageListings(): Response
    {
        // Debug: Check if admin is authenticated
        if (!Auth::guard('admin')->check()) {
            \Log::error('Admin not authenticated in manageListings');
            return redirect()->route('admin.login');
        }
        
        $listings = Listing::with('user')->latest()->paginate(10);
        
        // Add is_featured attribute to each listing for Vue
        $listings->getCollection()->transform(function ($listing) {
            $listing->is_featured = $listing->isFeatured();
            return $listing;
        });

        return Inertia::render('Admin/Pages/Listings', [
            'listings' => $listings,
            'pendingCount' => Listing::pending()->count(),
        ]);
    }

    public function pendingListings(): Response
    {
        $pendingListings = Listing::pending()->with('user')->latest()->paginate(10);
        
        // Add is_featured attribute to each listing for Vue
        $pendingListings->getCollection()->transform(function ($listing) {
            $listing->is_featured = $listing->isFeatured();
            return $listing;
        });

        return Inertia::render('Admin/Pages/PendingListings', [
            'listings' => $pendingListings,
        ]);
    }

    public function viewListing($id): Response
    {
        $listing = Listing::with('user')->findOrFail($id);

        return Inertia::render('Admin/Pages/ViewListing', [
            'listing' => $listing,
        ]);
    }

    public function editListing($id): Response
    {
        $listing = Listing::findOrFail($id);
        
        // Debug: Log the listing data
        \Log::info('Edit Listing Data:', $listing->toArray());

        return Inertia::render('Admin/Pages/EditListing', [
            'listing' => $listing,
        ]);
    }

    public function updateListing(Request $request, $id)
    {
        $listing = Listing::findOrFail($id);
        
        // Debug: Log all request data
        \Log::info('Update Listing Request Data', $request->all());
        \Log::info('Website field', ['website' => $request->input('website')]);
        \Log::info('Has file', ['has_file' => $request->hasFile('logo')]);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'email' => 'required|email',
            'website' => 'nullable|string|max:255',
            'tags' => 'required|string',
            'description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_approved' => 'boolean',
        ], [
            'logo.image' => 'The logo must be an image file.',
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif, svg.',
            'logo.max' => 'The logo may not be greater than 2MB.',
            'website.string' => 'Please enter a valid website URL.',
        ]);

        // Custom website validation
        $data = $request->except(['logo', '_method', '_token']);
        
        if ($request->filled('website')) {
            $website = $request->input('website');
            // Add protocol if missing
            if (!preg_match('/^https?:\/\//', $website)) {
                $website = 'https://' . $website;
            }
            // Basic URL validation
            if (!filter_var($website, FILTER_VALIDATE_URL)) {
                return redirect()->back()
                    ->withErrors(['website' => 'Please enter a valid URL.'])
                    ->withInput();
            }
            $data['website'] = $website;
        } else {
            $data['website'] = null;
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('logos', 'public');
            $data['logo'] = $logoPath;
        }

        $listing->update($data);

        return redirect()->back()->with('success', 'Listing updated successfully.');
    }

    public function approveListing($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update([
            'is_approved' => true,
            'approved_at' => now(),
            'rejection_reason' => null
        ]);

        // Send approval email (optional)
        try {
            // Mail::to($listing->user->email)->send(new ListingApproved($listing));
        } catch (\Exception $e) {
            // Log email error but continue
        }

        return redirect()->back()->with('success', 'Listing approved successfully.');
    }

    public function rejectListing(Request $request, $id)
    {
        $listing = Listing::findOrFail($id);
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $listing->update([
            'is_approved' => false,
            'rejection_reason' => $request->rejection_reason
        ]);

        // Send rejection email (optional)
        try {
            // Mail::to($listing->user->email)->send(new ListingRejected($listing, $request->rejection_reason));
        } catch (\Exception $e) {
            // Log email error but continue
        }

        return redirect()->back()->with('success', 'Listing rejected successfully.');
    }

    public function deleteListing($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->delete();

        return redirect()->back()->with('success', 'Listing deleted successfully.');
    }

    public function featureListing(Request $request, $id)
    {
        $listing = Listing::findOrFail($id);
        $request->validate([
            'days' => 'required|integer|min:1|max:365'
        ]);

        $listing->update([
            'featured_until' => now()->addDays($request->days)
        ]);

        return redirect()->back()->with('success', 'Listing featured successfully.');
    }

    public function unfeatureListing($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update([
            'featured_until' => null
        ]);

        return redirect()->back()->with('success', 'Listing unfeatured successfully.');
    }

    // System settings
    public function updateSystemSettings(Request $request)
    {
        $request->validate([
            'auto_approve_users' => 'boolean',
        ]);

        Setting::set('auto_approve_users', $request->boolean('auto_approve_users'), 'boolean', 'Automatically approve new user registrations');

        return redirect()->back()->with('success', 'System settings updated successfully.');
    }

    // Admin management
    public function updateAdminProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updateAdminPassword(Request $request)
    {
        \Log::info('Password update request received');
        \Log::info('Request data: ' . json_encode($request->all()));
        
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        \Log::info('Password validation passed');

        $admin = Auth::guard('admin')->user();
        
        \Log::info('Admin found: ' . $admin->email);
        \Log::info('Current password hash: ' . $admin->password);
        \Log::info('Entered current password: ' . $request->current_password);
        
        if (!Hash::check($request->current_password, $admin->password)) {
            \Log::info('Current password check failed');
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        \Log::info('Password verification passed, updating password');

        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        \Log::info('Password updated successfully');

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
