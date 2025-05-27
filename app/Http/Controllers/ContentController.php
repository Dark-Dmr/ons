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
        return view('contents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        Content::create([
            'title' => $request->title,
            'text' => json_encode($request->text, JSON_UNESCAPED_UNICODE)
        ]);

        session()->flash('success', 'تم إنشاء المحتوى بنجاح');
        return redirect()->route('contents.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(Content $id)
    {
        $content = Content::find($id);

    if (!$content) {
        return response()->json(['message' => 'Content not found'], 404);
    }

    return response()->json(['contents' => $content]);

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
        $data = $request->all();
        $content->title = $data['title'];

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
        // $categories = Category::all();
    
        // return view('contents.details', [
        //     'contents' => $content,
        //     // 'categories' => $categories,
        // ]);

         return view('contents.details')->with('contents', $content);

    }
    
}
