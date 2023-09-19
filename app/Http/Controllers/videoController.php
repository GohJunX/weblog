<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\shortvideo;
use App\Models\thumbsup;
use App\Models\comment;
use Illuminate\Http\Request;

class videoController extends Controller
{
    public function index()
    {
      
      
     
        $user = Auth::user(); // Assuming you are using Laravel's built-in authentication
        // $userId = $user->id;
        
        $thumbsupCount = thumbsup::with(['user'])->get();  
        $comment= comment::with(['user'])->get();
        $videos = shortvideo::with(['user'])
        ->where('short_valide', 1)
        ->orderBy('created_at', 'desc') // You can use 'updated_at' if you prefer
        ->simplePaginate(1);
        return view('shortvideo', compact('videos','comment','thumbsupCount'));
        
    }
        
    
    // 'thumbsupCount','commentCount',

    
    public function indexD($id)
    {
        $user = Auth::user(); // Assuming you are using Laravel's built-in authentication
        $userId = $user->id;
    
        $thumbsupCount = thumbsup::with(['user'])->get();
        $comment = comment::with(['user'])->get();
    
        $videos = shortvideo::with(['user'])
            ->where('short_id', $id)
            ->first();
    
        // Now you can access the specific video and its associated user
        if ($videos) {
            // Do something with the video and user
            return view('shortvideoD', compact('videos', 'comment', 'thumbsupCount', 'userId'));
        } else {
            // Video not found
            // You can handle the case where the video with the given ID doesn't exist
            return redirect()->back()->with('error', 'Video not found.');
        }
    }

    public function uploadShow()
    {
        return view('UploadShortVideo');
    }



    public function upload(Request $request)
    {
        $validatedData = $request->validate([
            'video' => 'required|mimes:mp4,avi,mov|max:50000', 
            'interface' => 'required|mimes:jpeg,png,jpg,gif|max:20000',
            'description' => 'required|string|max:255',
        ], [
            'video.required' => 'Please upload a video.',
            'video.file' => 'The uploaded file is not valid.',
            'video.max' => 'The uploaded video cannot exceed 50MB.',
            'description.required' => 'Please provide a description.',
            'description.string' => 'The description must be a string.',
            'interface.max'=>'The uploaded interface picture cannot exceed 20MB.',
            'description.max' => 'The description cannot exceed 255 characters.',
            'video.mimes' => 'The uploaded video must be in one of the following formats: mp4, avi, mov.',
            'interface.mimes' => 'The uploaded interface picture must be in one of the following formats: jpeg,png,jpg,gif.',
        ]);
        $videoPath = $request->file('video')->store('videos', 'public');
        $interfacePath = $request->file('interface')->store('interfaces', 'public');


        $user = Auth::user(); // Assuming you are using Laravel's built-in authentication
        $userID = $user->id;

        $video = new shortvideo;    
        $video->short_file_path = $videoPath;
        $video->interface_path = $interfacePath;
        $video->u_id = $userID;
        $video->short_des = $request->input('description');
        $video->save();

        // Redirect or perform additional actions as desired
        return redirect()->back()->with('success', 'The video has been uploaded and is being verifying');
    }



    public function stores(Request $request,$videoId)
    {
      
        // Validate the comment input
        $validatedData = $request->validate([
            'comment_text' => 'required|max:255',
        ]);
       
    
       
        // Create a new comment
        $comment = new comment();
        $comment->u_id = auth()->user()->id; // Assuming you are using authentication
        $comment->video_id = $videoId;
        $comment->comment_text = $validatedData['comment_text'];
        $comment->save();
        
        return redirect()->back()->with('success', 'Comment added successfully.');
    }





    public function toggleLike(Request $request, $videoId)
    {
        $user = auth()->user(); // Assuming you are using authentication
    
        // Check if the user has already liked the video
        $existingLike = thumbsup::where('u_id', $user->id)
            ->where('short_id', $videoId)
            ->first();
    
        if ($existingLike) {
            // User has already liked the video, so remove the like
            $existingLike->delete();
            $message = 'Like removed successfully.';
            $isLiked = false;
        } else {
            // User has not liked the video yet, so add a new like
            $like = new thumbsup();
            $like->u_id = $user->id;
            $like->short_id = $videoId;
            $like->save();
            $message = 'Like added successfully.';
            $isLiked = true;
        }
    
        return response()->json([
            'message' => $message,
            'isLiked' => $isLiked,
        ]);
    }

    
    public function checkLike(Request $request, $videoId)
{
    $user = $request->user();
    
    // Check if the user has liked the video
    $liked = thumbsup::where('u_id', $user->id)
        ->where('short_id', $videoId)
        ->exists();
    
    return response()->json(['liked' => $liked]);
}


public function videoDelete($id) {
    $short = ShortVideo::where('short_id', $id)->first();
    if ($short) {
        $short->delete();

        if (auth()->user()->u_role == "job_seeker") {
            return redirect()->route('user.profile',auth()->id())->with('success', 'Short video deleted successfully');
        } else if (auth()->user()->u_role == "employer") {
            return redirect()->route('profileEmp.show',auth()->id())->with('success', 'Short video deleted successfully');
        }
    }

    // If the short video doesn't exist or an unexpected situation occurs
    return back()->with('error', 'Failed to delete short video');
}
}
