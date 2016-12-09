<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\User;
use App\Category;

class IndexController extends Controller
{
    public function home()
    {	
    	//var_dump($user = User::find(1));
    	return view('exemple' ,[]);
    }
}
