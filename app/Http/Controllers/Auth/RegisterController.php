<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return 
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function registerJobSeeker(Request $request)
{
    $data = $request->all();

    $validator = Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'u_gender' => $data['genders'],
        'u_role' => 'job_seeker',
        'u_company_validate' => 1,
    ]);

    return redirect()->route('login')->with('success', 'Job seeker registered successfully');
}

    public function showJobSeekerRegistrationForm()
    {
        return view('auth.register');
    }

    // Register job seeker
  

    // Show employer registration form
    public function showEmployerRegistrationForm()
    {
        return view('auth.empregister');
    }

    // Register employer
    public function registerEmployer(Request $request)
    {
        $data = $request->all();
    
        $validator = Validator::make($data, [
            'companyName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'companyAddress' => ['required', 'string', 'min:8'],
            'companyPhone' => ['required', 'string', 'min:10', 'max:15'],
            'companyDescription' => ['required', 'string'],
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        User::create([
            'name' => $data['companyName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'u_location' => $data['companyAddress'],
            'u_role' => 'employer',
            'u_company_validate' => 0,
            'u_phone_number' => $data['companyPhone'],
            'u_desc' => $data['companyDescription'],
        ]);
    
        return redirect()->route('login')->with('success', 'Employer registered successfully');
    }
}
