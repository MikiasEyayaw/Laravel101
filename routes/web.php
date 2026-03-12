<?php

//use Illuminate\Http\Request;

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
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
Route::get('/listings/create', [ListingController::class,'create'])->middleware('auth');

//Store listing Data
Route::post('/listings', [ListingController::class, 'store' ])->middleware('auth');

//Store edit form
route::get('/listings/{listing}/edit',[ListingController::class,'edit'])->middleware('auth');

//Edit submit to update
route::put('/listings/{listing}',[ListingController::class,'update'])->middleware('auth');

//Delete Listing
route::delete('/listings/{listing}',[ListingController::class,'destroy'])->middleware('auth');

//Manage listings
Route::get('listings/manage',[ListingController::class,'manage'])->middleware('auth');

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