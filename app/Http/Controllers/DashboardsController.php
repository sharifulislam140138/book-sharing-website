<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use Auth;



class DashboardsController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
	}
	
    public function index()
    {
    	$user=Auth::user();
    	//$username=Auth::user()->username;
    	//$user=User::where('username',$username)->first();

       if(!is_null($user)){
        return view('frontend.pages.users.dashboard',compact('user'));
       }
       return redirect()->route('index');
    }

     public function books()
    {
    	$user=Auth::user();
    	//$username=Auth::user()->username;
    	//$user=User::where('username',$username)->first();
        
       
       if(!is_null($user)){
        $books=$user->books;
        return view('frontend.pages.users.dashboard_books',compact('user','books'));
       }
       return redirect()->route('index');
    }

}
