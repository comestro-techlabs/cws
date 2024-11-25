<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(4);
        return view("admin.manageCategory")->with('categories', $categories);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'cat_title' =>'required|string|max:255',
            'cat_description' =>'required|string|max:255',
        ]);

        
        $data['cat_slug']  = Str::slug($data['cat_title']); 
        // dd($data);
         

        Category::create($data);
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('error', 'Category deleted successfully.');
    }
}
