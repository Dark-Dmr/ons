<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = Content::all();
        return view('contents.index')->with('contents', $content);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->all();

        $content = new Content();
        $content->tittle = $data['tittle'];
        $content->text = $data['text'];
        $content->save();

        session()->flash('success', 'Content created succesfully');

        return redirect(route('contents.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        //
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
        $data = request()->all();

   
        $content->tittle = $data['tittle'];
        $content->text = $data['text'];
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


    public function details(Content $content){

        return view('contents.details')->with('contents', $content);
    
    }
}
