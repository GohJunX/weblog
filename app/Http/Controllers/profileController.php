<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\blog;
use App\Models\shortvideo;

class profileController extends Controller
{


    public function show($id)
    {
        $user = User::findOrFail($id);
        $blogs = blog::where('u_id', $id)->get();
        $videos = shortvideo::where('u_id', $id)->get();
        // Retrieve the active box parameter from the URL query string
        $quizzes = $user->quizzes()->withPivot('score')->get();

        if ($user->u_role == 'job_seeker') {
            return view('profileJobseeker', compact('user', 'blogs', 'videos', 'quizzes'));
        } else {
            return view('profileEmployer', compact('user', 'blogs', 'videos', 'quizzes'));
        }
    }
    // public function showEmp()
    // {
    //     // $user = User::findOrFail($id);
    //     // $blogs = $user->blogs;
    //     // $videos = $user->shortVideos;
    //     return view('profileEmployer');
    // }



    public function editShow()
    {
        $user = auth()->user();
        $genders = ['male', 'female', 'other'];
        $userGender = $user->u_gender;
        return view('jobSeeker.EditProfile', ['user'=>$user, 'genders'=>$genders, 'userGender'=>$userGender]);
     
    }



    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Validate the form data
        $validatedData = $request->validate([
            'username' => 'required|string|max:20|unique:users,name,' . $user->id,
            'password' => 'nullable|string|min:8',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'gender' => 'required|string|in:male,female,other',
            'state' => 'required|string|in:Johor,Kedah,Kelantan,Melaka,Negeri Sembilan,Pahang,Perak,Perlis,Pulau Pinang,Sabah,Sarawak,Selangor,Terengganu',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:20000',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20000',
        ],[
            'resume.max' => 'The uploaded resume file size cannot exceed 20MB.',
            'profile_picture.max' => 'The uploaded profile picture size cannot exceed 20MB'
            // ... (other custom error messages)
        ]);

        // Update the user's profile
        $user->name = $validatedData['username'];
        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
        $user->email = $validatedData['email'];
        $user->u_phone_number = $validatedData['phone'];
        $user->u_gender = $validatedData['gender'];
        $user->u_state = $validatedData['state'];

        // Handle resume upload if provided
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $resumePath = $resume->store('resumes');
            $user->u_resume_file_path = $resumePath;
        }

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePicturePath = $profilePicture->store('profile_pictures');
    
            // Delete the previous profile picture if it exists
            if (!empty($user->u_profile_pic)) {
                File::delete(storage_path('app/' . $user->u_profile_pic));
            }
    
            $user->u_profile_pic = $profilePicturePath;
        }

        $user->save();

        // Redirect the user back to the profile page with a success message
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }



    public function editEmpShow()
    {
        $user = auth()->user();
        return view('Employer.EditProfile', ['user'=>$user]);
     
    }



    public function updateEmpProfile(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'company_name' => 'required|string|max:25|unique:users,name,' . $user->id,
            'password' => 'nullable|string|min:8',
            'company_description' => 'required',
            'company_location' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2000',
        ]);

        $user->name = $validatedData['company_name'];
    if (!empty($validatedData['password'])) {
        $user->password = bcrypt($validatedData['password']);
    }
    $user->u_desc = $validatedData['company_description'];
    $user->u_location = $validatedData['company_location'];
    $user->email = $validatedData['email'];
    $user->u_phone_number = $validatedData['phone'];

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        $profilePicture = $request->file('profile_picture');
        $profilePicturePath = $profilePicture->store('profile_pictures');

        // Delete the previous profile picture if it exists
        if (!empty($user->u_profile_pic)) {
            File::delete(storage_path('app/' . $user->u_profile_pic));//
        }

        $user->u_profile_pic = $profilePicturePath;
    }

    $user->save();

    return redirect()->route('profileEmp.edit')->with('success', 'Profile updated successfully.');
}
}
