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

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function profile($id)
    {
        $user = User::find($id);
        return view('profile', ['user' => $user]);
    }

    public function updateProfile($id)
    {
        $user = User::find($id);
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->save();
        return view('profile', ['user' => $user, 'info' => 'User updated']);
    }   
}
