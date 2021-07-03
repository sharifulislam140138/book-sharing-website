<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\Author;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors=Author::all();
        return view('backend.pages.authors.index',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'name' => 'required|max:50',
        'description' => 'nullable|min:5',
    ]);
      
        $author= new Author();
        $author->name = $request->name;
        $author->link =str_slug($request->name);
        $author->description = $request->description;
        $author->save();

        session()->flash('success', 'author has been created');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validated = $request->validate([
        'name' => 'required|max:50',
        'description' => 'nullable',
    ]);
         $author= Author::find($id);
        $author->name = $request->name;
        //$author->link =str_slug($request->name);
        $author->description = $request->description;
        $author->save();

        session()->flash('success', 'updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
         $author= Author::find($id);
        
        $author->delete();
        session()->flash('success', 'author has been deleted');
        return back();
    }
}
