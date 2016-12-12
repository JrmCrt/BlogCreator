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
use App\Comment;
use DB;

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

    public function blog($id)
    {
    	$blog = Blog::find($id);
    	$articles = Article::where('id_blog', $id)->get();
    	$isFollowed = !is_null(SharedBlog::where('id_user', Auth::id())->where('id_blog', $id)->first());
    	return view('blog', ['blog' => $blog, 'isFollowed' => $isFollowed, 'articles' => $articles]);
    }

    public function shareBlog($id)
    {
    	$sharedBlog = new SharedBlog;
    	$sharedBlog->id_user = Auth::id();
    	$sharedBlog->id_blog = $id;
    	$sharedBlog->save();
    	$articles = Article::where('id_blog', $id)->get();

    	return view('blog', ['blog' => Blog::find($id), 
    		'isFollowed' => !is_null(SharedBlog::where('id_user', Auth::id())->where('id_blog', $id)->first()),
    		'info' => 'Blog now followed',
    		'articles' => $articles]);
    }

    public function unfollowBlog($id)
    {
    	$sharedBlog = SharedBlog::where('id_user', Auth::id())->where('id_blog', $id)->first();
    	if(!is_null($sharedBlog))
    		$sharedBlog->destroy($sharedBlog->id);
    	
    	$articles = Article::where('id_blog', $id)->get();
    	return view('blog', ['blog' => Blog::find($id), 
    		'isFollowed' => !is_null(SharedBlog::where('id_user', Auth::id())->where('id_blog', $id)->first()),
    		'info' => 'Blog unfollowed',
    		'articles' => $articles]);
    }

    public function comment($id)
    {	
    	$comments = DB::table('comments')
            ->join('articles', 'articles.id', '=', 'comments.id_article')
            ->select('*', 'comments.content as commentContent', 'comments.id as id_comment')
            ->where('id_blog', $id)
            ->get();
    	return view('comments', ['comments' => $comments]);
    }

    public function removeComment($id)
    {	
    	$comment = Comment::find($id);
    	$comment->destroy($comment->id);
    	return view('home', ['info' => 'Comment removed']);
    }

    public function article($id)
    {	
    	$articles = Article::where('id_blog', $id)->get();
    	return view('articles', ['articles' => $articles]);
    }

    public function removeArticle($id)
    {	
    	$article = Article::find($id);
    	$article->destroy($article->id);
    	return view('home', ['info' => 'Article removed']);
    }
}
