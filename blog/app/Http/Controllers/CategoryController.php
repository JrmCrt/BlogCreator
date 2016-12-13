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

class CategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$categories = Category::all();
		return view('categories', ['categories' => $categories]);
	}

	public function _new()
	{
		return view('categorynew', []);
	}

	public function doNew()
	{
		$category = new Category;
		$category->name = Input::get('name');
		$category->save();
		return redirect()->action('CategoryController@index')->with('info', 'Category created !');
	}

	public function remove($id)
	{
		$category = Category::find($id);
		$category->destroy($category->id);
		return redirect()->action('CategoryController@index')->with('info', 'Category removed !');
	}

	public function edit($id)
	{
		$category = Category::find($id);
		return view('categoryedit', ['category' => $category]);
	}

	public function doEdit($id)
	{
		$category = Category::find($id);
		$category->name = Input::get('name');
		$category->save();
		return redirect()->action('CategoryController@index')->with('info', 'Category updated !');
	}
}
