<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\User;
use App\Category;
use Input;
use App\Blog;
use App\Friend;
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
        $isFriend = false;
        if($user){
            $check = Friend::where('id_user1', Auth::id() )->where('id_user2', $user->id )->get();
            $check2 = Friend::where('id_user2', Auth::id() )->where('id_user1', $user->id )->get();
            if(count($check) || count($check2))
                $isFriend = true;
        }
        return view('profile', ['user' => $user, 'isFriend' => $isFriend]);
    }

    public function updateProfile($id)
    {
        $user = User::find($id);
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        if(!empty(Input::get('password'))) 
            $user->password = bcrypt(Input::get('password'));
        $user->save();
        return view('profile', ['user' => $user, 'info' => 'User updated']);
    }   
}
