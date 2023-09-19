<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\notification;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $emails = notification::with(['sender', 'user', 'job'])
            ->orderBy('created_at', 'desc') // Assuming 'created_at' is the time column
            ->get();
        
        return view('email', ['emails' => $emails, 'users' => $users]);
    }

    public function show($id)
    {
        $user = Auth::user();
        $email = Notification::with(['sender', 'user'])->findOrFail($id);

        return view('emailDetail', ['email' => $email,'user'=>$user]);
    }

    public function replyshow($id)
    {
       
        $email = Notification::with(['sender', 'user'])->findOrFail($id);// 根据给定的id查找特定的电子邮件记录

        return view('emailReply',['email' => $email]);
    }

    public function reply(Request $request,$id)
    {
   
        $validatedData = $request->validate([
            'content' => 'required|max:255',
    
        ]);
    
        // Create a new email/notification record
        $email = new Notification();
        $email->n_content = $request->input('content');
        $email->n_interview_time = $request->input('interview_time');
        $emails = notification::with(['sender', 'user'])->findOrFail($id);
        $email->u_id=$emails->sender->id;
        $email->e_id=$emails->user->id;
        $emailss = notification::findOrFail($id); 
        $email->jb_id=$emailss->jb_id;
        
        // Set other properties as needed
    
        // Save the email/notification record
        $email->save();
    
        // Redirect to the desired page
        return redirect()->route('notification.index')->with('success', 'Email sent successfully!');
    }

      public function indexJ()
    
      {
          $users = Auth::user();
          $emails = notification::with(['sender', 'user', 'job'])
              ->orderBy('created_at', 'desc') // Assuming 'created_at' is the time column
              ->get();
          
          return view('emailJ', ['emails' => $emails, 'users' => $users]);
      }

    public function showJ($id)
    {
        $user = Auth::user();
        $email = notification::with(['sender', 'user'])->findOrFail($id);

        return view('emailJDetail', ['email' => $email,'user'=>$user]);
    }

    public function replyJShow($id)
    {
        $email = notification::with(['sender', 'user'])->findOrFail($id);// 根据给定的id查找特定的电子邮件记录

        return view('emailJReply',['email' => $email]);
    }

    public function replyJ(Request $request,$id)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:255',
     
        ]);
    
        // Create a new email/notification record
        $email = new Notification();
        $email->n_content = $request->input('content');
        $email->n_interview_time = $request->input('interview_time');
        $emails = notification::with(['sender', 'user'])->findOrFail($id);
        $email->u_id=$emails->sender->id;
        $email->e_id=$emails->user->id;
        $emailss = notification::findOrFail($id); 
        $email->jb_id=$emailss->jb_id;
        
        // Set other properties as needed
    
        // Save the email/notification record
        $email->save();
    
        // Redirect to the desired page
        return redirect()->route('notification.index')->with('success', 'Email sent successfully!');
    }
}
