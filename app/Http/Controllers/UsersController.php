<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Category;
use App\Publisher;
use App\Author;
use App\User;
use App\BookAuthor;
use Auth;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile($username)
    {
        $user=User::where('username',$username)->first();
       if(!is_null($user)){
        return view('frontend.pages.users.show',compact('user'));
       }
       return redirect()->route('index');
    }

    public function books($username)
    {
        $user=User::where('username',$username)->first();
       if(!is_null($user)){
        $books=$user->books;
        return view('frontend.pages.users.show',compact('user','books'));
       }
       return redirect()->route('index');
    }

 }
