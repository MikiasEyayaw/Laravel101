<?php

//use Illuminate\Http\Request;

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Models\Listing;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/test', function () {
    return Inertia::render('Home', [
        'name' => 'Mikias'
    ]);
});
//All listings
Route::get('/', [ListingController::class,'index']);

//Show create form
Route::get('/listings/create', [ListingController::class,'create'])->middleware(['auth', 'approved.user']);

//Store listing Data
Route::post('/listings', [ListingController::class, 'store' ])->middleware(['auth', 'approved.user']);

//Store edit form
route::get('/listings/{listing}/edit',[ListingController::class,'edit'])->middleware(['auth', 'approved.user']);

//Edit submit to update
route::put('/listings/{listing}',[ListingController::class,'update'])->middleware(['auth', 'approved.user']);

//Delete Listing
route::delete('/listings/{listing}',[ListingController::class,'destroy'])->middleware(['auth', 'approved.user']);

//Manage listings
Route::get('listings/manage',[ListingController::class,'manage'])->middleware(['auth', 'approved.user']);

//single listing
Route::get('/listings/{listing}', [ListingController::class, 'show' ]);
//Show register form
Route::get('/register',[UserController::class,'create'])->middleware('guest');

//create users
Route::post('/users',[UserController::class,'store']);

//Log User Out

Route::Post('/logout',[UserController::class,'logout'])->middleware('auth');

// show loggin form

Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');

//Log user in
Route::post('/users/authenticate',[UserController::class,'authenticate']);

Route::post('/listings/{listing}/apply', [ListingController::class, 'apply']);

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login']);
    
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'updateSystemSettings'])->name('settings.update');
        
        // Admin profile management
        Route::post('/admin/profile', [AdminController::class, 'updateAdminProfile'])->name('admin.profile.update');
        Route::post('/admin/password', [AdminController::class, 'updateAdminPassword'])->name('admin.password.update');
        
        // User management routes
        Route::get('/users', [AdminController::class, 'users'])->name('users.index');
        Route::get('/users/pending', [AdminController::class, 'pendingUsers'])->name('users.pending');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::post('/users/{id}/approve', [AdminController::class, 'approveUser'])->name('users.approve');
        Route::post('/users/{id}/reject', [AdminController::class, 'rejectUser'])->name('users.reject');
        Route::post('/users/{id}/activate', [AdminController::class, 'activateUser'])->name('users.activate');
        Route::post('/users/{id}/deactivate', [AdminController::class, 'deactivateUser'])->name('users.deactivate');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
        Route::get('/users/{id}/activity', [AdminController::class, 'userActivity'])->name('users.activity');
        
        // Listing management routes
        Route::get('/listings', [AdminController::class, 'manageListings'])->name('listings.index');
        Route::get('/listings/pending', [AdminController::class, 'pendingListings'])->name('listings.pending');
        Route::get('/listings/{id}/edit', [AdminController::class, 'editListing'])->name('listings.edit');
        Route::get('/listings/{id}', [AdminController::class, 'viewListing'])->name('listings.show');
        Route::put('/listings/{id}', [AdminController::class, 'updateListing'])->name('listings.update');
        Route::post('/listings/{id}/approve', [AdminController::class, 'approveListing'])->name('listings.approve');
        Route::post('/listings/{id}/reject', [AdminController::class, 'rejectListing'])->name('listings.reject');
        Route::post('/listings/{id}/feature', [AdminController::class, 'featureListing'])->name('listings.feature');
        Route::post('/listings/{id}/unfeature', [AdminController::class, 'unfeatureListing'])->name('listings.unfeature');
        Route::delete('/listings/{id}', [AdminController::class, 'deleteListing'])->name('listings.delete');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});
Route::get('/mail-test', function () {
    try {
        Mail::raw('This is a test email', function ($message) {
            $message->to('miki07448@gmail.com')
                    ->subject('Laravel SMTP Test');
        });
        return "Email sent successfully!";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});
//function (Listing $listing) {

    // $listing = Listing::find($id);
    // if ($listing) {
    //     return view('listing', [
    //         'listing' => $listing
    //     ]);
    // }
    // else{
    //     abort(404);
    // }
//});

// Route::get('/', function () {
//     return view('listings', [
//         'heading' => 'Latest Listings',
//         'listings' => [
//             [
//                 'id' => 1,
//                 'title' => 'Listing One',
//                 'description' => 'Ah! You want to know how to write multi-line comments in Laravel. Let’s break it down clearly because it depends on where you are commenting — Blade files, PHP code, or JavaScript inside Laravel.'
//             ],
//             [
//                 'id' => 2,
//                 'title' => 'Listing Two',
//                 'description' => 'Ah! You want to know how to write multi-line comments in Laravel. Let’s break it down clearly because it depends on where you are commenting — Blade files, PHP code, or JavaScript inside Laravel.'
//             ],

//         ]
//     ]);
// });
/*
Route::get('/hello', function () {
    return response('<h1>Hello World</h1>', 200)
        ->header('Content-Type', 'text/plain')
        ->header('foo', 'bar');
});

Route::get('/posts/{id}', function ($id) {
    return response('Post ' . $id);
})->where('id', '[0-9]+');

Route::get('/search', function (Request $request) {
    return ($request->name . ' ' . $request->city);
});

Route::prefix('api')->group(function () {
    Route::get('/posts', function () {
        return response()->json([
            'posts' => [
                [
                    'title' => 'Post One'
                ]
            ]
        ]);
    });
});
*/