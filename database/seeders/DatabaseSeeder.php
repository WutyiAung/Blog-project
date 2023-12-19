<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    { 
        $frontend = Category::factory()->create(['title'=>'frontend','slug'=>'frontend']);
        $backend = Category::factory()->create(['title'=>'backend','slug'=>'backend']);

        Blog::factory(10)
        ->has(
            Comment::factory(3)
        )
        ->create(['category_id'=>$frontend->id]);

        Blog::factory(10)
        ->has(
            Comment::factory(3)
        )
        ->create(['category_id'=>$backend->id]);
    }
}


