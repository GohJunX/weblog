<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\blog;
use App\Models\shortvideo;
use App\Models\thumbsup;
use App\Models\comment;
use App\Models\jobpost;
use App\Mail\ApprovalNotification;
use Illuminate\Support\Facades\Mail;

class VerifyController extends Controller
{
    public function index()
    {
        $companies = User::where('u_company_validate',0)->get();
        return view('admin.adminCompanyVerify',compact('companies'));
    }

    public function show($id)
    {
        $companies = User::where('id',$id)->first();
        return view('admin.adminCompanyVerifyDetail',compact('companies'));
    }

    public function approve($id)
    {
        $company=User::where('id',$id)->first();
        $company->u_company_validate = 1;
        $company->save();
        
        Mail::to($company->email)->send(new ApprovalNotification('approve'));
        return redirect()->route('admin.verify.index');
    }

    public function reject($id)
    {
        $company=User::where('id',$id)->first();
        $company->delete();
        Mail::to($company->email)->send(new ApprovalNotification('reject'));
        return redirect()->route('admin.verify.index');
    }

    public function indexSB()
    {
        $shorts = shortvideo::where('short_valide', 0)->get();
        $blogs= blog::where('blog_valide', 0)->get();
        return view('admin.adminBlogAndVideoVerify',compact('shorts','blogs'));
    }

    public function showS($id)
    {
        $user = Auth::user(); // Assuming you are using Laravel's built-in authentication
        $userId = $user->id;
        $thumbsupCount = thumbsup::with(['user'])->get();  
        $comment= comment::with(['user'])->get();
        $videos = shortvideo::with(['user'])->where('short_valide', 0)
                                            ->where('short_id',$id)->first();
        return view('admin.adminVideoDetailVerify', compact('videos','comment','thumbsupCount','userId'));
    }

    public function approveS($id)
    {
        $short=shortvideo::where('short_id',$id)->first();
        $short->short_valide = 1;
        $short->save();

        $status = 'approve'; // This variable determines the status for the email
        $user = $short->user; // Assuming you have a relationship between short video and user
        Mail::to($user->email)->send(new ApprovalNotification($status));
        return redirect()->route('admin.verifySB.index');
    }

    public function rejectS($id)
    {
        $short=shortvideo::where('short_id',$id)->first();
        $short->delete();
        $status = 'reject'; // This variable determines the status for the email
        $user = $short->user; // Assuming you have a relationship between short video and user
        Mail::to($user->email)->send(new ApprovalNotification($status));

        return redirect()->route('admin.verifySB.index');
    }


    public function showB($id)
    {
        $blog = blog::orderBy('created_at','desc')->where('blog_valide', 0)->where('blog_id', $id)->first();
        return view('admin.adminBlogDetailVerify',compact('blog'));
    }

    public function approveB($id)
    {
        $blog=blog::where('blog_id',$id)->first();
        $blog->blog_valide = 1;
        $blog->save();
        $status = 'approve'; // This variable determines the status for the email
        $user = $blog->user; // Assuming you have a relationship between short video and user
        Mail::to($user->email)->send(new ApprovalNotification($status));
        return redirect()->route('admin.verifySB.index');
    }

    public function rejectB($id)
    {
        $blog=blog::where('blog_id',$id)->first();
        $blog->delete();
        $status = 'reject'; // This variable determines the status for the email
        $user = $blog->user; // Assuming you have a relationship between short video and user
        Mail::to($user->email)->send(new ApprovalNotification($status));
        return redirect()->route('admin.verifySB.index');
    }

    public function indexJB()
    {
        $allUsers = User::all();

        // Filter users with the role 'employer'
        $employers = $allUsers->filter(function ($user) {
            return $user->u_role === 'employer';
        });
    
        // Create a pluck array for employers (id => name) and prepend the default option
        $companies = $employers->pluck('name', 'id')->prepend('Select Company', '');
    
        // Rest of the code
        $jobs = jobpost::with('user')->orderBy('job_ver', 'asc')->latest()->get();
        return view('admin.adminJobboardVerify', ['jobs' => $jobs, 'companies' => $companies]);
    }



    public function showJB($id)
    {
        $job = jobpost::with('user')->findOrFail($id);
        return view('admin.adminJobboardDetailVerify',compact('job'));
    }

    public function approveJB($id)
    {
        // Find the job post by ID and update its status to approved
        $job = jobpost::findOrFail($id);
        $job->job_ver=1;
        $job->save();
        $status = 'approve'; // This variable determines the status for the email
        $user = $job->user; // Assuming you have a relationship between short video and user
        Mail::to($user->email)->send(new ApprovalNotification($status));
        return redirect()->route('admin.verifyJB.index');
    }

    public function rejectJB($id)
    {
        $job = jobpost::where('jp_id',$id)->first();
        $job->delete();
        $status = 'reject'; // This variable determines the status for the email
        $user = $job->user; // Assuming you have a relationship between short video and user
        Mail::to($user->email)->send(new ApprovalNotification($status));
    
      
        return redirect()->route('admin.verifyJB.index');
    }

    public function search(Request $request)
    {
        $keywords = $request->input('keywords');
        $companyId = $request->input('company');
    
        // Perform the database query based on search criteria
        $query = jobpost::with('user')->orderBy('job_ver', 'asc')->latest();;
    
        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->where('jp_pos', 'like', "%$keywords%")
                  ->orWhere('jp_fulltime_parttime', 'like', "%$keywords%")
                  ->orWhere('jp_location', 'like', "%$keywords%")
                  ->orWhere('jp_exp_time', 'like', "%$keywords%")
                  ->orWhere('jp_salary', 'like', "%$keywords%")
                  ->orWhere('jp_role', 'like', "%$keywords%");
            });
        }
    
        if ($companyId) {
            $query->where('u_id', $companyId);
        }
    
        $jobs = $query->get();
    
        // Store the keywords in the session to retain it in the search form
        $request->session()->put('keywords', $keywords);
    
        // Fetch the companies and pass them to the view as before
        $companies = User::where('u_role', 'employer')->pluck('name', 'id')->prepend('Select Company', '');
    
        return view('admin.adminJobboardVerify', ['jobs' => $jobs, 'companies' => $companies]);
}

}
