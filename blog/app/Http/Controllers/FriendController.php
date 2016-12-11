<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\User;
use App\Category;
use App\Message;
use Input;
use App\Blog;
use App\Friend;
use Auth;

class FriendController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function add($id)
	{	
		$info = 'Friend added';
		$friend = User::Find($id);
		$f = new Friend;
		$f->id_user1 = Auth::id();
		$f->id_user2 = $friend->id;
		$check1 = Friend::where('id_user1', Auth::id() )->where('id_user2', $friend->id )->first();
		$check2 = Friend::where('id_user2', Auth::id() )->where('id_user1', $friend->id )->first();
		if(!count($check1) && !count($check2))
       		$f->save();
       	else
       		$info = "User already friended";
		return view('home', ['user' => Auth::user(), 'info' => $info]);   
	}

	public function remove($id)
	{	
		$friend = User::Find($id);
		$check1 = Friend::where('id_user1', Auth::id() )->where('id_user2', $friend->id )->first();
		$check2 = Friend::where('id_user2', Auth::id() )->where('id_user1', $friend->id )->first();
		if(count($check1))
			$check1->destroy($check1->id);
		elseif(count($check2))
			$check2->destroy($check2->id);

		if(count($check1) || count($check2))
			return view('home', ['user' => Auth::user(), 'info' => 'Friend removed']);	

		return view('home', ['user' => Auth::user()]);
	}

	public function getFriends()
	{	
		$friends = Friend::where('id_user1', Auth::id() )->orwhere('id_user2', Auth::id() )->get();
		return view('friends', ['friends' => $friends]);
	}

}
