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
use App\SharedArticle;
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
    	// $articles = Article::where('id_blog', $id)->orderBy('created_at', 'DESC')->get();
    	// $articles = DB::table('articles')->where('id_blog', $id)->orderBy('created_at', 'DESC')->get();
    	// $sharedArticles = DB::table('articles')
     //        ->join('sharedArticles', 'sharedArticles.id_article', '=', 'articles.id')
     //        ->select('articles.id_blog', 'id_article as id', 'title', 'chapo', 'content', 'id_category', 'sharedArticles.created_at', 'id_author')
     //        ->where('sharedArticles.id_blog', $id)
     //        ->get();
     //    $r = $articles->merge($sharedArticles)->sortByDesc('created_at');
        $r = Article::where('id_blog', $id)->orWhereIn('id', 
        		SharedArticle::where('id_blog', $id)->select('id_article')->get())->orderBy('created_at', 'DESC')->get();

    	$isFollowed = !is_null(SharedBlog::where('id_user', Auth::id())->where('id_blog', $id)->first());
    	return view('blog', ['blog' => $blog, 'isFollowed' => $isFollowed, 'articles' => $r]);
    }

    public function shareBlog($id)
    {
    	$sharedBlog = new SharedBlog;
    	$sharedBlog->id_user = Auth::id();
    	$sharedBlog->id_blog = $id;
    	$sharedBlog->save();
    	$articles = Article::where('id_blog', $id)->get();

    	return redirect()->back()->with('info', 'Blog now followed !');
    }

    public function unfollowBlog($id)
    {
    	$sharedBlog = SharedBlog::where('id_user', Auth::id())->where('id_blog', $id)->first();
    	if(!is_null($sharedBlog))
    		$sharedBlog->destroy($sharedBlog->id);
    	
    	$articles = Article::where('id_blog', $id)->get();
    	return redirect()->back()->with('info', 'Blog unfollowed !');
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
    	return redirect()->back()->with('info', 'Comment removed !');
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
    	return redirect()->back()->with('info', 'Article removed !');
    }

    public function wall()
    {
        $blogs = Blog::where('id_author', Auth::id())
               ->orderBy('created_at', 'asc')
               ->get();
 
        //$articles = Article::whereIn('id_blog', SharedBlog::where('id_user', Auth::id())->select('id_blog')->get())->get(); 
        $blogsId = Sharedblog::where('id_user', Auth::id())->pluck('id_blog');
        foreach($blogsId as $b){
        	$bArticle = Article::where('id_blog', $b)->orWhereIn('id', 
        		SharedArticle::where('id_blog', $b)->select('id_article')->get())->orderBy('created_at', 'DESC')->get();
        	$articles = isset($articles) ? $articles->merge($bArticle)->sortByDesc('created_at') : $bArticle;
        } 
               
        return view('home', ['articles' => $articles]);
    }

    public function filterBlog($id)
    {
    	$blog = Blog::find($id);
        $r = Article::where('id_blog', $id)->orWhereIn('id', 
        		SharedArticle::where('id_blog', $id)->select('id_article')->get())->orderBy('created_at', 'DESC')->get();
        $category = Input::get('category');
        
        if($category != 0)
        	$r = $r->where('id_category', $category);

    	$isFollowed = !is_null(SharedBlog::where('id_user', Auth::id())->where('id_blog', $id)->first());
    	return view('blog', ['blog' => $blog, 'isFollowed' => $isFollowed, 'articles' => $r]);
    }

    public function filterwall()
    {
        $blogs = Blog::where('id_author', Auth::id())
               ->orderBy('created_at', 'asc')
               ->get();
 
        $blogsId = Sharedblog::where('id_user', Auth::id())->pluck('id_blog');
        foreach($blogsId as $b){
        	$bArticle = Article::where('id_blog', $b)->orWhereIn('id', 
        		SharedArticle::where('id_blog', $b)->select('id_article')->get())->orderBy('created_at', 'DESC')->get();
        	$articles = isset($articles) ? $articles->merge($bArticle)->sortByDesc('created_at') : $bArticle;
        } 
        
        $category = Input::get('category');
        
        if($category != 0)
        	$articles = $articles->where('id_category', $category);

        return view('home', ['articles' => $articles]);
    }
}
