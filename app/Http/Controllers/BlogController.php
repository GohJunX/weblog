<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $recommendedBlogs = blog::orderBy('created_at','desc')->where('blog_valide', 1)->paginate(5);
        // return view('blog.home', compact('recommendedBlogs'));
        return view('blog', ['recommendedBlogs'=> $recommendedBlogs]);
    }

    public function indexProfile($id)
    {
        $blog = Blog::find($id);

        return view('blogDetailprofile',['blog'=>$blog]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $recommendedBlogs = blog::where('blog_valide', 1)->where('blog_title', 'like', '%' . $searchTerm . '%')->where('blog_valide', 1)->get();
        return view('blog', [ 'recommendedBlogs'=>$recommendedBlogs]);
    }

    public function create()
    {
        return view('createBlog');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'BlogVideos.*' => 'mimes:mp4,avi,mov|max:50000',
            'BlogImages.*' => 'mimes:jpeg,png,jpg,gif|max:20000',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:20000',
        ]);
        
        // Save the blog data to the database
        $blog = new Blog();
        $blog->blog_title = $validatedData['title'];
        $blog->blog_content = $validatedData['content'];
        // Set other properties of the blog model as needed
        $blog->u_id = Auth::id();
        $blog->save();
        
        // Process the uploaded videos
        if ($request->hasFile('BlogVideos')) {
            $videos = [];
            foreach ($request->file('BlogVideos') as $video) {
                $path = $video->store('Blog_videos', 'public');
                $videos[] = $path;
            }
            $blog->blog_video_file_path = implode(',', $videos);
            $blog->save();
        }
        
        // Process the uploaded images
        if ($request->hasFile('BlogImages')) {
            $images = [];
            foreach ($request->file('BlogImages') as $image) {
                $path = $image->store('Blog_images', 'public');
                $images[] = $path;
            }
            $blog->blog_img_file_path = implode(',', $images);
            $blog->save();
        }
        
        // Process the interface image
        if ($request->hasFile('image')) {
            $interfaceImage = $request->file('image');
            $interPath = $interfaceImage->store('images', 'public');
            $blog->blog_interface_img_file_path = $interPath;
            $blog->save();
        }
        
        // Optionally, you can redirect the user to a success page
        return redirect()->route('blog.create')->with('success', 'Blog post created successfully and is under verifying.');
        
        //return redirect()->route('blog', $blog->id)->with('success', 'Blog post created successfully.');
    }

    public function show($id)
    {
        $blog = Blog::find($id);

        return view('blogDetail',['blog'=>$blog]);
    }

    public function blogDelete($id)
    {
        $blog=blog::where('blog_id',$id)->first();
        $blog->delete();

        if (auth()->user()->u_role == "job_seeker") {
            return redirect()->route('user.profile',auth()->id());
        } else if (auth()->user()->u_role == "employer") {
            return redirect()->route('profileEmp.show',auth()->id());
        }

        return back()->with('error', 'Failed to delete short video');
    }
}
