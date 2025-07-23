<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function viewiIndex()
    {
        $content = Content::all();
        return view('contents.index')->with('contents', $content);
    }

    public function index()
    {
        $contents = Content::all();

        return response()->json([
            'status' => 'success',
            'data' => $contents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = Category::all();
        // return view('contents.create')->with('categories', $categories);
        // return view('contents.create');
        $categories = Category::all();
        return view('contents.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'category_id' => 'required|exists:categories,id',  // Validate category_id
        ]);

        $data = $request->only(['title', 'text', 'category_id']); // explicitly get these fields
        $data['text'] = json_encode($data['text'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        Content::create($data);

        return redirect()->route('contents.index')->with('success', 'Content created successfully.');
    }






    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        $categories = Category::all();  // fetch all categories

        return view('contents.details', compact('content', 'categories'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
     //we don't need it edit with details in same page
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content)
    {
        $request->validate([
        'title' => 'required|string',
        'text' => 'required|string', // or string if it's not JSON yet
        'category_id' => 'required|exists:categories,id',
    ]);
        $data = $request->all();
        $content->title = $data['title'];
        $content->category_id = $data['category_id'];
        // Save TinyMCE HTML as JSON
        $content->text = json_encode($data['text'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $content->save();

        session()->flash('success', 'Content updated successfully');
        return redirect(route('contents.index'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        $content->delete();

        return redirect(route('contents.index'));
    }


    public function details(Content $content) {
        $categories = Category::all();  // fetch all categories

        return view('contents.details', compact('content', 'categories'));

    }
    
}
