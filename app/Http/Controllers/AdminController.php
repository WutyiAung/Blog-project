<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFormRequest;
use App\Mail\BlogUpdateMail;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index',[
            'blogs'=> auth()->user()->blogs()->latest()->paginate(5),
        ]);
    }
    public function create(){
        return view('admin.create',[
            "categories" => Category::all()
        ]);
    }
    public function destroy(Blog $blog){
        $blog->delete();
       // $blog->comments()->delete(); delete comments from model event
        return back();
    }

    public function store(BlogFormRequest $request){
       $cleanData = $request->validated();
       $cleanData['user_id'] = auth()->id();
       $cleanData['photo'] =  '/storage/'.request('photo')->store('/blogs');
       Blog::create($cleanData);
       
       $subscribers = Subscription::all();
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new BlogUpdateMail());
        }

       return redirect('/admin');
    }
    public function edit(Blog $blog){
        return view('admin.edit',[
            'categories' => Category::all(),
            'blog' =>$blog
        ]);
    }
    public function update(Blog $blog,BlogFormRequest $request){
        $cleanData = $request->validated();
        if(request('photo')){
           $cleanData['photo'] = '/storage/'.request('photo')->store('/blogs');
           File::delete(public_path($blog->photo));#delete photo
        }
    
       $blog->update($cleanData);
       return redirect('/admin');
    }
}
