<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function viewIndex(){
        $categories = Category::all();
        return view("categories.index")->with('categories', $categories);
    }
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'تم إنشاء التصنيف بنجاح');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
   public function show($id)
{
    $category = Category::findOrFail($id);
    return view('categories.show', compact('category'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $category = Category::findOrFail($id);
    return view('categories.edit', compact('category'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated!');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'تم حذف التصنيف بنجاح');
    }

}
