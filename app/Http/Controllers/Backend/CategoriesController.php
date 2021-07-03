<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        $parent_categories=Category::where('parent_id',null)->get();
        return view('backend.pages.categories.index',compact('categories','parent_categories'));
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
        'slug' => 'nullable|unique:categories',
        'description' => 'nullable',
    ]);
      
        $category= new Category();
        $category->name = $request->name;
       if(empty($request->slug)){
        $category->slug=str_slug($request->name);
       }else{
        $category->slug=$request->slug;
       }

        $category->parent_id = $request->parent_id;
        $category->description = $request->description;
        $category->save();

        session()->flash('success', 'category has been created');
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
         'link' => 'nullable|url',
        'description' => 'nullable',
    ]);
         $category= Category::find($id);
        $category->name = $request->name;
          $category->link =$request->link;
        $category->outlet = $request->outlet;
        $category->address = $request->address;
       
        $category->description = $request->description;
        $category->save();

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
        
         $category= Category::find($id);
        
        $category->delete();
        session()->flash('success', 'Publisher has been deleted');
        return back();
    }
}
