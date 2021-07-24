<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Category;
use App\Publisher;
use App\Author;
use App\BookAuthor;
use Auth;

class BooksController extends Controller
{
    public function show()
    {
    	return view('frontend.pages.books.show');
    }

        public function upload()
    {
    	    $categories=Category::all();
        $publishers=Publisher::all();
        $authors=Author::all();
         $books=Book::where('is_approved',1)->get();
        return view('frontend.pages.books.create', compact('categories','publishers','authors','books'));
    }
    public function create()
    {
        $categories=Category::all();
        $publishers=Publisher::all();
        $authors=Author::all();
         $books=Book::where('is_approved',1)->get();
        return view('backend.pages.books.create', compact('categories','publishers','authors','books'));

    }

     public function store(Request $request)
    {
    	if(!Auth::check()){
    		abort(403,'unauthorized action');
    	}
       

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
        $book->is_approved=0;
        $book->user_id=Auth::id();
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
        return redirect()->route('index');
    }

    }


