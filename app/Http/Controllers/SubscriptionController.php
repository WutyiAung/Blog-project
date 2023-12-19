<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
  public function toggle(Blog $blog)
  {  
      if ($blog->isSubscribeBy(auth()->user())) {
          $blog->subscribedUsers()->detach(auth()->id()); 
      } else {
          $blog->subscribedUsers()->attach(auth()->id());
      }
      return back();
  }
  
  public function store(Request $request)
    {
       $cleanData = $request->validate([
            'email' => ['required','email'],
        ]);
        $email = $cleanData['email'];
        if (Subscription::where('email', $email)->exists()) {
            return redirect()->back()->with('error', 'Email is already subscribed.');
        }else{
            Subscription::create($cleanData);
            return redirect()->back()->with('success', 'Subscription added successfully!');
        }

       
    }

  }

