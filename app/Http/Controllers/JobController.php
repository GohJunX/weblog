<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\jobpost;
use App\Models\User;
use App\Models\notification;

class JobController extends Controller
{
    // 显示所有职位列表
    public function index(Request $request)
    {
        
        $jobs = jobpost::with('user')->paginate(6);
        if ($request->ajax()) {
            return view('jobboard', ['jobs' => $jobs])->render();
        }
        return view('jobboard', ['jobs' => $jobs]);
    }

  
    public function showCreateJobPost()
    {
        
        return view('jobPost');
    }
    
 



    // 搜索职位
    public function search(Request $request)
    {
        $keywords = $request->input('keywords');
        session()->put('keywords', $keywords);
        $state = $request->input('state');
        $experience = $request->input('experience');
        $salary = $request->input('salary');
        $role = $request->input('role');
        $jobType =$request->input('jobType');
    
        // 构建查询条件
        $query = jobpost::query();

        if (!empty($keywords)&&empty($role)) {
            $query->where(function ($query) use ($keywords, $role) {
                    $query->where('jp_pos', 'like', '%' . $keywords . '%')
                        ->orWhere('jp_location', 'like', '%' . $keywords . '%');
               
            });
        }
        elseif(!empty($keywords)&&!empty($role)){
            $query->where(function ($query) use ($keywords, $role) {
             
                    $query->where('jp_pos', 'like', '%' . $keywords . '%')
                        ->orWhere('jp_pos', 'like', '%' . $role . '%');
               
            });
        
        }
        elseif(empty($keywords)&&!empty($role)){
            $query->where(function ($query) use ($keywords, $role) {
               
                    $query->where('jp_pos', 'like', '%' . $role . '%');
                       
            });
        
        }

        if (!empty($state)) {
            $query->where('jp_location', 'like', '%' . $state . '%');
        }
    
        if (!empty($experience)) {
            $query->where('jp_exp_time', $experience);
        }
    
        if (!empty($salary)) {
            $query->where('jp_salary', $salary);
        }

        if (!empty($jobType)) {
            $query->where('jp_fulltime_parttime', $jobType);
        }
  
        $jobs = $query->latest()->get();
    
        return view('searchJobboard', ['jobs' => $jobs]);
    }



    public function showApplyJobForm($id, $successMessage = null)
    {
        $jobpost = jobpost::findOrFail($id);
        
        $user = auth()->user();
        return view('applyJob',['jobpost'=>$jobpost,'user'=>$user,'successMessage'=>$successMessage]);
    }

    // 提交 Apply Job 表单
    public function submitApplication(Request $request, $id)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:255',
            'email' => 'required|email',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:20000',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20000',
        ]);
        
        $jobPost = JobPost::findOrFail($id);
        // Handle the resume file
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes');
        } else {
            // Use the existing resume file
            $resumePath = $request->input('existing_resume');
        }
    
        // Handle the profile picture file
    
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures');
        }else {
            // Use the existing resume file
            $profilePicturePath = $request->input('existing_profile_pic');
        }
       
    
        // Create a new notification record
        notification::create([
            'n_content' => $validatedData['content'],
            'n_interview_time' => null,
            'n_interview_date' => null,
            'n_email' => $validatedData['email'],
            'n_resume_file_path' => $resumePath,
            'n_profile_pic_file_path' => $profilePicturePath,
            'n_assessment_file_path' => null,
            'u_id' => $jobPost->u_id,
            'e_id' => auth()->user()->id,
            'jb_id' => $jobPost->jp_id, // You can assign the appropriate job post ID here
        ]);
    
        // Perform any additional actions or redirect the user as needed
        $successMessage = 'Your application has been submitted successfully!';
      
        return redirect()->route('applyJobForm', ['id' => $id, 'successMessage' => $successMessage]);
    }



    public function showEmployer()
    {   $user = Auth::user();
        $jobs = jobpost::where('u_id', $user->id)->get();
        return view('jobPostHome',['jobs' => $jobs]);
    }





    public function jobPostDetailShow($id)
    {
      
        $jobPost = jobpost::where('jp_id', $id)->firstOrFail();
        return view('jobPostDetail',['jobPost'=>$jobPost]);
    }


    public function  jobPostDetail(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jobTitle' => 'required',
            'jobDescription' => 'required|max:2550',
            'jobImages.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20000',
            'jobVideos.*' => 'nullable|mimes:mp4,avi,mov|max:50000', 
           
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Find and update the existing job post
        $jobPost = JobPost::findOrFail($id);
        $jobPost->jp_pos = $request->input('jobTitle');
        $jobPost->jp_des = $request->input('jobDescription');
        $jobPost->jp_salary = $request->input('salary');
        $jobPost->jp_exp_time = $request->input('experience');
        $jobPost->jp_fulltime_parttime = $request->input('jobType');
        $jobPost->jp_location = $request->input('jobLocation');
        $jobPost->u_id = Auth::id();
        $jobPost->save();
    
        // Handle job images
        if ($request->hasFile('jobImages')) {
            $images = [];
            foreach ($request->file('jobImages') as $image) {
                $path = $image->store('job_images', 'public');
                $images[] = $path;
            }
            $jobPost->jp_img = implode(',', $images);
            $jobPost->save();
        }
    
        // Handle job videos
        if ($request->hasFile('jobVideos')) {
            $videos = [];
            foreach ($request->file('jobVideos') as $video) {
                $path = $video->store('job_videos', 'public');
                $videos[] = $path;
            }
            $jobPost->jp_video = implode(',', $videos);
            $jobPost->save();
        }
    
        // Redirect to a success page or perform other actions
        return redirect()->route('employerDetail.show', ['id' => $jobPost->jp_id])->with('success', 'Job updated successfully!');
    }





    
    public function createjobPost(Request $request)
{
    $validator = Validator::make($request->all(), [
        'jobTitle' => 'required',
        'jobDescription' => 'required|max:2550',
        'jobImages.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20000',
        'jobVideos.*' => 'nullable|mimes:mp4,avi,mov|max:50000', 

    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

  
   // Initialize an array to store the file paths
   $job = new jobpost;
   $job->jp_pos = $request->jobTitle;
   $job->jp_des = $request->jobDescription;
   $job->jp_salary = $request->salary;
   $job->jp_exp_time = $request->experience;
   $job->jp_fulltime_parttime = $request->jobType;
   $job->jp_location = $request->jobLocation;
   $job->u_id = Auth::id();
   $job->job_ver =0;
   
   // Initialize arrays to store the file paths
   $videoPaths = [];
   $imagePaths = [];
   
   // Check if job image is uploaded
   if ($request->hasFile('jobImages')) {
    $images = $request->file('jobImages');
    foreach ($images as $image) {
        if ($image->isValid()) {
            $imageName = time() . '_' . $image->getClientOriginalName(); // Generate a unique name for the image
            $imagePath = $image->storeAs('job-images', $imageName); // Save the image with the generated name
            $imagePaths[] = $imagePath; // Add the image path to the array
        } else {
            return redirect()->back()
                ->withErrors(['jobImages' => 'Invalid image file. Please upload a valid image file.'])
                ->withInput();
        }
    }
    }

    // Check if job video is uploaded
    if ($request->hasFile('jobVideos')) {
        $videos = $request->file('jobVideos');
        foreach ($videos as $video) {
            if ($video->isValid()) {
                $videoName = time() . '_' . $video->getClientOriginalName(); // Generate a unique name for the video
                $videoPath = $video->storeAs('job-videos', $videoName); // Save the video with the generated name
                $videoPaths[] = $videoPath; // Add the video path to the array
            } else {
                return redirect()->back()
                    ->withErrors(['jobVideos' => 'Invalid video file. Please upload a valid video file.'])
                    ->withInput();
            }
        }
    }
    // Convert the arrays of file paths to delimited strings
    $videoPathString = implode(',', $videoPaths);
    $imagePathString = implode(',', $imagePaths);

    // Assign the delimited strings to the columns in the database

    $job->jp_video = $videoPathString;
    $job->jp_img = $imagePathString;

    $job->save();

    // Redirect to success page or perform other operations
    return redirect()->route('employer.show')->with('success', 'Job posted successfully!');
}


public function destroy($id)
{
    // Find the job post by its ID
    $jobPost = JobPost::findOrFail($id);

    // Delete associated images
    if ($jobPost->jp_img) {
        $imagePaths = explode(',', $jobPost->jp_img);
        foreach ($imagePaths as $imagePath) {
            if (file_exists(public_path(trim($imagePath)))) {
                unlink(public_path(trim($imagePath)));
            }
        }
    }

    // Delete associated videos
    if ($jobPost->jp_video) {
        $videoPaths = explode(',', $jobPost->jp_video);
        foreach ($videoPaths as $videoPath) {
            if (file_exists(public_path(trim($videoPath)))) {
                unlink(public_path(trim($videoPath)));
            }
        }
    }

    // Delete the job post record
    $jobPost->delete();

    $user = Auth::user();
    $jobs = jobpost::where('u_id', $user->id)->get();

    return view('jobPostHome',['jobs' => $jobs]);
}

public function show($id){
    $job = JobPost::findOrFail($id);
    return view('jobDetailPage',['job'=>$job]);

}
}