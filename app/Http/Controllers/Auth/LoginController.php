<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
        if ($user->u_role == 'admin') {
            return redirect('/admin/verify');
        }

        if ($user->u_company_validate === 0) {
            // Block the user
            // Redirect them to the login page with an error message
            Auth::logout();
            return redirect()->route('login')->withErrors(['error' => 'Your account still in validation processing. ']);
        }
    
        // Rest of the code for successful login
        if ($request->has('remember')) {
            Cookie::queue('user', $request->email, 1440);
            Cookie::queue('userpwd', $request->password, 1440);
        } else {
            Cookie::queue(Cookie::forget('user'));
            Cookie::queue(Cookie::forget('userpwd'));
        }
    
        if ($user->u_role == 'employer') {
            return redirect('/employerjobpost');
        } elseif ($user->u_role == 'job_seeker') {
            return redirect('/');
        }
    }
}
