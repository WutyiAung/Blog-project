<?php

namespace App\Http\Controllers;

use App\Mail\SubscriberMail;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\returnSelf;

class CommentController extends Controller
{
    public function store(Blog $blog){
    request()->validate([
        'body' =>['required']
    ]);

    $comment = $blog->comments()->create([
        'body'=>request('body'),
        'user_id'=>auth()->id(),
    ]);

    $blog->subscribedUsers->filter(function($user){
        return $user->id != auth()->id();
    })->each(function($subscriber) use($comment){
      Mail::to($subscriber->email)->queue(new SubscriberMail($subscriber,$comment));
    });
    // $subscribers = $blog->subscribedUsers->filter(function($user){
    //     return $user->id != auth()->id();
    //  })->each(function($subscriber) use ($comment){
    //    Mail::to($subscriber->email)->queue(new SubscriberMail($subscriber,$comment));
    //  });

    return back();
    }

    public function destroy(Comment $comment){
      $comment->delete();
      return back();
    }

    public function edit(Comment $comment){
     return view('comments.edit',[
        'comment' => $comment
     ]);
    }

    public function update(Comment $comment){
     request()->validate([
        'body' => ['required']
     ]);

     $comment->body = request('body');
     $comment->save();

     $blog = $comment->blog;
     return redirect()->route('blogs.show',$comment->blog->id);
     //return redirect()->route('blogs.show', ['blog' => $blog])->with('success', 'comment updated successfully');
    }
}
