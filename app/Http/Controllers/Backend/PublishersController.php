<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\Publisher;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers=Publisher::all();
        return view('backend.pages.publishers.index',compact('publishers'));
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
        'link' => 'nullable|url',
        'description' => 'nullable',
    ]);
      
        $Publisher= new Publisher();
        $Publisher->name = $request->name;
        $Publisher->link =$request->link;
        $Publisher->outlet = $request->outlet;
        $Publisher->address = $request->address;
        $Publisher->description = $request->description;
        $Publisher->save();

        session()->flash('success', 'Publisher has been created');
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
         $Publisher= Publisher::find($id);
        $Publisher->name = $request->name;
          $Publisher->link =$request->link;
        $Publisher->outlet = $request->outlet;
        $Publisher->address = $request->address;
       
        $Publisher->description = $request->description;
        $Publisher->save();

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
        
         $Publisher= Publisher::find($id);
        
        $Publisher->delete();
        session()->flash('success', 'Publisher has been deleted');
        return back();
    }
}
