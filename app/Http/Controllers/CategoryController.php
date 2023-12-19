<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use GuzzleHttp\Psr7\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryFormRequest $request){
        $cleanData = $request->validated();
        Category::create($cleanData);
        return redirect('/categories');
     }

     public function edit(Category $category)
     {
         return view('categories.edit', [
            'category' => $category
         ]);
     }
 
     public function update(CategoryFormRequest $request, Category $category)
     {
         $cleanData =$request->validated();
         $category->update($cleanData);
         return redirect('/categories');
     }
 
     public function destroy(Category $category)
     {
         $category->delete();
         return redirect('/categories');
     }
}
