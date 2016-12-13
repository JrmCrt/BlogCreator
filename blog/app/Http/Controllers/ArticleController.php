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
use App\SharedBlog;
use App\Article;
use App\SharedArticle;
use App\Comment;

class ArticleController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {	
    	return view('articlenew', []);
    }

    public function _new($id)
    {   
        $article = new Article;
        $article->id_blog = $id;
        $article->id_category = Input::get('category');
        $article->id_author = Auth::id();
        $article->title = Input::get('title');
        $article->chapo = Input::get('chapo');
        $article->content = Input::get('content');
        $article->save();
        return redirect()->back()->with('info', 'Article saved !');
    }

    public function share($id_blog, $id)
    {   
        $sharedArticle = new SharedArticle;
        $sharedArticle->id_article = $id;
        $sharedArticle->id_blog = $id_blog;
        $sharedArticle->save();
        return redirect()->back()->with('info', 'Article shared !');
    }

    public function addComment($id)
    {   
        $comment = new Comment;
        $comment->id_user = Auth::id();
        $comment->id_article = $id;
        $comment->content = Input::get('content');
        $comment->save();   
        return redirect()->back()->with('info', 'Comment saved !');  
    }

    public function editArticle($id)
    {   
        $article = Article::find($id);
        return view('articleedit', ['article' => $article]);
    }

    public function doEdit($id)
    {   
        $article = Article::find($id);
        $article->title = Input::get('title');
        $article->chapo = Input::get('chapo');
        $article->content = Input::get('content');
        $article->save();
        return redirect()->back()->with('info', 'Article updated !');  
    }
}
