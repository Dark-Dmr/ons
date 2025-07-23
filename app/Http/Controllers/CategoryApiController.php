<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
     public function index()
        {
            $categories = Category::all();

            return response()->json([
                'success' => true,
                'data' => $categories
            ]);
        }

    public function contents($id)
    {
        $category = Category::with('contents')->find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'category' => $category->name,
            'contents' => $category->contents
        ]);
    }
}
