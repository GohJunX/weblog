<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            // Redirect to admin dashboard
            return redirect()->intended('/admin');
        } elseif ($user->hasRole('job_seeker')) {
            // Redirect to manager dashboard
            return redirect()->intended('/manager');
        } elseif ($user->hasRole('user')) {
            // Redirect to user dashboard
            return redirect()->intended('/user');
        } else {
            // Handle unrecognized role
            return redirect()->route('login')->with('error', 'Invalid role');
        }
    } else {
        return redirect()->route('login')->with('error', 'Invalid credentials');
    }
}

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Show job seeker registration form
    public function showJobSeekerRegistrationForm()
    {
        return view('auth.register');
    }

    // Register job seeker
    public function registerJobSeeker(Request $request)
    {
        // Handle job seeker registration logic
        // ...

        return redirect()->route('login')->with('success', 'Job seeker registered successfully');
    }

    // Show employer registration form
    public function showEmployerRegistrationForm()
    {
        return view('auth.empregister');
    }

    // Register employer
    public function registerEmployer(Request $request)
    {
        // Handle employer registration logic
        // ...

        return redirect()->route('login')->with('success', 'Employer registered successfully');
    }
}