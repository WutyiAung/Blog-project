<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\MustBeAdminUser;
use App\Http\Middleware\MustBeAuthUser;
use App\Http\Middleware\MustBeGuestUser;
use App\Mail\SubscriberMail;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware(MustBeAuthUser::class)->group(function(){
    Route::get("/blogs/{blog}",[BlogController::class,'show'])->name('blogs.show');
    Route::get('/',[BlogController::class,'index']);
    Route::post('/logout',[LogoutController::class,'destroy']);
    Route::post('/blogs/{blog:slug}/handle-subscriptions',[SubscriptionController::class,'toggle']);
    Route::post('/blogs/{blog:slug}/comments',[CommentController::class,'store']);
    Route::delete('/comments/{comment}/delete',[CommentController::class,'destroy']);
    Route::get('/comments/{comment:id}/edit',[CommentController::class,'edit']);
    Route::patch('/comments/{comment:id}/edit',[CommentController::class,'update']);

    Route::post('/subscription',[SubscriptionController::class,'store']);

});

#do these routes if the user is not a auth user ,the user is guest user
Route::middleware(MustBeGuestUser::class)->group(function(){
    Route::get('/register',[RegisterController::class,'create']);
    Route::post('/register',[RegisterController::class,'store']);
    Route::get('/login',[LoginController::class,'create']);
    Route::post('/login',[LoginController::class,'store']);
    
});
Route::middleware(MustBeAdminUser::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/blogs/create', [AdminController::class, 'create']);
    Route::delete('/admin/blogs/{blog}/destroy',[AdminController::class,'destroy'])
    ->middleware('can:delete,blog');
    Route::post('/admin/blogs/store',[AdminController::class,'store']);
    Route::get('/admin/blogs/{blog}/edit',[AdminController::class,'edit'])
    ->middleware('can:edit,blog');
    Route::put('/admin/blogs/{blog}/update',[AdminController::class,'update']);

    Route::get('/categories',[CategoryController::class,'index']);
    Route::get('/categories/create',[CategoryController::class,'create']);
    Route::get('/category/{category}/edit',[CategoryController::class,'edit']);
    Route::post('/categories/store', [CategoryController::class,'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/category/{category}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// Route::get('/categories/{category:slug}',function(Category $category){
//     return view('blogs.index',[
//       'blogs' => $category->blogs()->with('category','user')->paginate(),
//       'currentCategory'=>$category
//     ]);
// });

// Route::get('/users/{user:username}',function (User $user){
//   return view('blogs.index' ,[
//     'blogs' => $user->blogs()->with('category','user')->paginate(),
//   ]);
// });


