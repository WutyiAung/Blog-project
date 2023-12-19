<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{                    #index for list
    public  function index(){
   
         $filters=request(['search','category','username']);
         
        $query =Blog::with('user','category')
                ->search($filters)#scope query method
                ->latest()
                ->paginate(3)
                ->withQueryString();
                
        return view('blogs.index',[
         'blogs' =>$query
        ]);
    }   
     
    public function show(Blog $blog){
        return view('blogs.show',[
         'blog' => $blog,
         'randomBlogs' =>Blog::inRandomOrder()->take(3)->get()
        ]);
     }

}
