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
    	return redirect('home');
    }

    public function index()
    {
    	var_dump('dsqdqs');
    }
}
