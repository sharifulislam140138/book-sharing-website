<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\Book;
use App\Category;
use App\Publisher;
use App\Author;
use App\BookAuthor;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books=Book::all();
        return view('backend.pages.books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $publishers=Publisher::all();
        $authors=Author::all();
         $books=Book::where('is_approved',1)->get();
        return view('backend.pages.books.create', compact('categories','publishers','authors','books'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

          $request->validate([
        
        'title' => 'required|max:50',
        'category_id' => 'required',
         'publisher_id' => 'required',
        'slug' => 'nullable|unique:books',
        'description' => 'nullable',
       'image' => 'required|image|max:2048'
        
    
    ]);
      
        $book= new Book();
        $book->title = $request->title;
       if(empty($request->slug)){
        $book->slug=str_slug($request->title);
       }else{
        $book->slug=$request->slug;
       }

        $book->category_id = $request->category_id;
        $book->publisher_id = $request->publisher_id;
        $book->publish_year = $request->publish_year;
        $book->description = $request->description;
        $book->is_approved=1;
        $book->user_id=1;
        $book->isbn=$request->isbn;
        $book->translator_id=$request->translator_id;
        $book->save();

        //image uplod
         if($request->image){
            $file= $request->file('image');
            $ext= $file->getClientOriginalExtension();
            $name=time().'-'.$book->id.'.'.$ext;
            $path="images/books";
            $file->move($path, $name);
            $book->image=$name;
            $book->save();

            
        }


       foreach($request->author_ids as $id){
         //book authors
        $book_author= new BookAuthor();
        $book_author->book_id=$book->id;
        $book_author->author_id=$id;
        $book_author->save();

       }

       

        session()->flash('success', 'book has been created');
        return redirect()->route('admin.books.index');

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
        $book=Book::find($id);
        
        $categories=Category::all();
        $publishers=Publisher::all();
        $authors=Author::all();
         $books=Book::where('is_approved',1)->where('id', '!=',$id)->get();
        return view('backend.pages.books.edit', compact('categories','publishers','authors','books','book'));
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
        // $category= Book::find($id);
         
       //  $validated = $request->validate([
       // 'name' => 'required|max:50',
       // 'slug' => 'nullable|unique:categories,slug,'.$category->id,
       // 'description' => 'nullable',
      //  ]);
      
      //  $category= Book::find($id);
      //  $category->name = $request->name;
      // if(empty($request->slug)){
      //  $category->slug=str_slug($request->name);
      // }else{
      //  $category->slug=$request->slug;
      // }

       // $category->parent_id = $request->parent_id;
       // $category->description = $request->description;
       // $category->save();

        //session()->flash('success', 'category has been updated');
       // return back();


          $book=Book::find($id);
          $request->validate([
        
        'title' => 'required|max:50',
        'category_id' => 'required',
         'publisher_id' => 'required',
        'slug' => 'nullable|unique:books,slug',$book->id,
        'description' => 'nullable',
       'image' => 'nullable|image|max:2048'
        
    
    ]);
      
        $book= new Book();
        $book->title = $request->title;
       if(empty($request->slug)){
        $book->slug=str_slug($request->title);
       }else{
        $book->slug=$request->slug;
       }

        $book->category_id = $request->category_id;
        $book->publisher_id = $request->publisher_id;
        $book->publish_year = $request->publish_year;
        $book->description = $request->description;
       // $book->is_approved=1;
        //$book->user_id=1;
        $book->isbn=$request->isbn;
        $book->translator_id=$request->translator_id;
        $book->save();

        //image uplod
         if($request->image){
            $file= $request->file('image');
            $ext= $file->getClientOriginalExtension();
            $name=time().'-'.$book->id.'.'.$ext;
            $path="images/books";
            $file->move($path, $name);
            $book->image=$name;
            $book->save();

            
        }
        //book authors
        //delete old authors table data 
        $book_authors=BookAuthor::where('book_id',$book_id)->get();
        foreach($book_author as $author){
            $author->delete();
        }

       foreach($request->author_ids as $id){
         
        $book_author= new BookAuthor();
        $book_author->book_id=$book->id;
        $book_author->author_id=$id;
        $book_author->save();

       }

       

        session()->flash('success', 'book has been created');
        return redirect()->route('admin.books.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //child category delete
        $child_categories= Book::where('parent_id', $id)->get();
        foreach($child_categories as $child){
            $child->delete();
        }

        
         $category= Book::find($id);
        
        $category->delete();
        session()->flash('success', 'category has been deleted');
        return back();
    }
}
