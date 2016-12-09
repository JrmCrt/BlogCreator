<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\User;
use App\Category;
use Input;
use App\Blog;
use Auth;

class BlogController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {	
    	return view('newblog', []);
    }

    public function newBlog()
    {	
    	$blog =  new Blog;
    	$blog->title = Input::get('title');
    	$blog->description = Input::get('description');
    	if(!empty(Input::file('banner')) )
    	{
    		$file = Input::file('banner'); 
    		$fName = Input::file('banner')->getClientOriginalName();
    		$destinationPath = "files";
			$file->move($destinationPath, $fName); 
			$blog->banner = $fName;
    	}

    	$blog->id_author = Auth::id();
    	$blog->save();
    	return view('newblog', ['info' => 'New blog created']);
    }
}
