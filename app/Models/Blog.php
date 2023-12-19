<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Blog extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    public static function boot() { # Model Event
        parent::boot();
        static::deleted(function($item) {
         $item->comments()->delete();
         $item->subscribedUsers()->detach();
         File::delete(public_path($item->photo));
        });
    }

    # a blog belongsTo a category

    public function category(){
        return $this->belongsTo(Category::class ); #(Category::class,'category_id' );
    }

    # a blog belongsTo a user
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    public function scopeSearch($query ,$filter){
        if($filter['search'] ?? null){
            $query->where(function($query) use ($filter)
            {
                $query
                      ->where('title','like','%'.$filter['search'].'%');
                 //->orWhere('body','like','%'.$filter['search'].'%');
            });
               
          }
          
        if($filter['category'] ?? null){
            $query->whereHas('category',function($catQuery) use($filter){
                $catQuery->where('slug',$filter['category']);
            });
        }

        if($filter['username'] ?? null){
            $query->whereHas('user',function($userQuery) use($filter){
               $userQuery->where('username',$filter['username']);
            });
        }

    }
    public function subscribedUsers(){
      return $this->belongsToMany(User::class);#connect by blog_user table 
    }
    
    public function isSubscribeBy($user){
        return $this->subscribedUsers->contains('id' ,$user->id);
    }
}
