<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{
    //show register
    // public function create()
    // {
    //     return view('users.register');
    // }
    public function create()
    {
        return Inertia::render('Users/Register');
    }

    //create new user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        //Hash password
        $formFields['password'] = bcrypt($formFields['password']);
        
        // Set default values: active but approval depends on system setting
        $formFields['is_active'] = true;
        $formFields['is_approved'] = Setting::get('auto_approve_users', false);
        
        if ($formFields['is_approved']) {
            $formFields['approved_at'] = now();
        }

        //create user
        $user = User::create($formFields);

        // Auto-login if user is approved
        if ($formFields['is_approved']) {
            Auth::login($user);
            return redirect('/')->with('success', 'Registration successful! Welcome!');
        }

        // Return success response for frontend modal handling
        return redirect()->back()
            ->with('success', 'Registration successful! Please wait for admin approval before logging in.')
            ->with('autoApproved', false);
    }

    //logout user
    public function logout(Request $request)
    {
        // Only logout the user guard, don't invalidate the entire session
        Auth::guard('web')->logout();
        
        // Don't invalidate the session to preserve admin login
        // $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    //show login form

    // public function login()
    // {
    //     return view('users.login');
    // }

    public function login()
    {
        return Inertia::render('Users/Login');
    }

    //Log user in

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        
        // Debug: Log authentication attempt
        Log::info('User authentication attempt', [
            'email' => $formFields['email'],
            'admin_authenticated_before' => Auth::guard('admin')->check(),
            'user_authenticated_before' => Auth::guard('web')->check(),
            'session_id' => session()->getId()
        ]);
        
        if (Auth::guard('web')->attempt($formFields)) {
            $user = Auth::guard('web')->user();
            
            // Debug: Log successful authentication
            Log::info('User authenticated successfully', [
                'user_id' => $user->id,
                'admin_authenticated_after' => Auth::guard('admin')->check(),
                'user_authenticated_after' => Auth::guard('web')->check()
            ]);
            
            // Check if user is active
            if (!$user->is_active) {
                Auth::guard('web')->logout();
                // Don't invalidate session to preserve admin login
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'Your account has been deactivated. Please contact support for assistance.'])->onlyInput('email');
            }
            
            // Check if user is approved
            if (!$user->is_approved) {
                Auth::guard('web')->logout();
                // Don't invalidate session to preserve admin login
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'Your account is pending approval. Please wait for an administrator to review your registration.'])->onlyInput('email');
            }
            
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
