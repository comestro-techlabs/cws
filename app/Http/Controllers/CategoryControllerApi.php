<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category as CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
class CategoryControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');

        $categories = CategoryModel::where('cat_title', 'like', "%{$search}%")
            ->orWhere('cat_description', 'like', "%{$search}%")
            ->paginate($perPage);

        return CategoryResource::collection($categories);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'cat_title' => 'required|string|unique:categories,cat_title',
                'cat_description' => 'string',
            ]);

            $category = CategoryModel::create($validated);

            return response()->json([
                'message' => 'Category added successfully!',
                'data' => new CategoryResource($category)
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed. Please provide all required fields.',
                'errors' => $e->errors(),
            ], 422);
        }
    }
    public function show($slug)
    {
        $category = CategoryModel::where('cat_slug', $slug)->firstOrFail();
        return new CategoryResource($category);
    }
    public function update(Request $request, $slug)
    {
        try {
            $category = CategoryModel::where('cat_slug', $slug)->firstOrFail();
            
            $validated = $request->validate([
                'cat_title' => [
                    'sometimes',
                    'string',
                    Rule::unique('categories', 'cat_title')->ignore($category->id),
                ],
                'cat_description' => 'sometimes|string',
            ]);
        
            $category->update($validated);
        
            return response()->json([
                'message' => 'Category updated successfully!',
                'data' => new CategoryResource($category)
            ], 200);
        
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Category with the provided slug not found'
            ], 404);
        
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the category.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy(CategoryModel $category)
    {
        if ($category->delete()) {
            return response()->json([
                'message' => 'Category deleted successfully!',
            ], 200);
        }
    
        return response()->json([
            'message' => 'Category could not be deleted!',
        ], 400);
    }
    
}
