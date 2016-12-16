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
use App\Notification;

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
    	if(is_null($blog)) 
    		return view('newblog', []);
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

    	$blog = Blog::find($id);
    	$notification = new Notification;
       	$notification->id_user = $blog->id_author;
       	$notification->url = '/profile/' . Auth::id();
       	$notification->icon = 'share';
       	$notification->content = Auth::user()->name . ' is now following your blog ' . $blog->title;
   		$notification->save();

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
    	$blog = Blog::find($id);
    	if($blog->id_author != Auth::id())
    		return redirect()->back()->with('info', 'Permission denied !');

    	$comments = DB::table('comments')
            ->join('articles', 'articles.id', '=', 'comments.id_article')
            ->select('*', 'comments.content as commentContent', 'comments.id as id_comment')
            ->where('id_blog', $id)
            ->get();

    	return view('comments', ['comments' => $comments]);
    }

    public function removeComment($id)
    {	
    	$author = DB::table('comments')
            ->join('articles', 'articles.id', '=', 'comments.id_article')
            ->join('blogs', 'blogs.id', '=', 'articles.id_blog')
            ->join('users', 'users.id', '=', 'blogs.id_author')
            ->select('users.id')
            ->where('comments.id', $id)
            ->pluck('users.id')
            ->toArray();

        if(empty($author))
        	return redirect()->back()->with('info', 'Permission denied !');

        $author = $author[0];
        if($author != Auth::id())
        	return redirect()->back()->with('info', 'Permission denied !');

    	$comment = Comment::find($id);
        $article = Article::find($comment->id_article);
        $blog = Blog::find($article->id_blog);
    	$comment->destroy($comment->id);

    	if($comment->id_user != Auth::id()){
	    	$notification = new Notification;
	       	$notification->id_user = $comment->id_user;
	       	$notification->url = "blog/$blog->id/read/$article->id";
	       	$notification->icon = 'times';
	       	$notification->content = Auth::user()->name . ' has deleted your comment on ' . $article->title;
	   		$notification->save();
    	}

    	return redirect()->back()->with('info', 'Comment removed !');
    }

    public function article($id)
    {	
    	$articles = Article::where('id_blog', $id)->orWhereIn('id', 
        		SharedArticle::where('id_blog', $id)->select('id_article')->get())->orderBy('created_at', 'DESC')->get();
    	$blog = Blog::find($id);

    	if($blog->id_author != Auth::id())
    		return redirect()->back()->with('info', 'Permission denied !');
  
    	return view('articles', ['articles' => $articles, 'blog' => $blog]);
    }

    public function removeArticle($id)
    {	
    	$article = Article::find($id);
    	if($article->id_author != Auth::id())
    		return redirect()->back()->with('info', 'Permission denied !');

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
        if(count($blogsId))
	        foreach($blogsId as $b){
	        	$bArticle = Article::where('id_blog', $b)->orWhereIn('id', 
	        		SharedArticle::where('id_blog', $b)->select('id_article')->get())->orderBy('created_at', 'DESC')->get();
	        	$articles = isset($articles) ? $articles->merge($bArticle)->sortByDesc('created_at') : $bArticle;
	        }
	    else
	    	return view('home', ['articles' => [], 'blogsId' => []]);

        return view('home', ['articles' => $articles, 'blogsId' => $blogsId->toArray()]);
    }

    public function filterBlog($id)
    {
    	$blog = Blog::find($id);
        $r = Article::where('id_blog', $id)->orWhereIn('id', 
        		SharedArticle::where('id_blog', $id)->select('id_article')->get())->orderBy('created_at', 'DESC')->get();
        $category = Input::get('category');
        
        if($category != 0)
        	$r = $r->where('id_category', $category);

        $year = Input::get('year');
        if($year != 0)
        	$r = $r->where('created_at', '>=', "$year-01-01")->where('created_at', '<', ($year + 1 ). '-01-01');

    	$isFollowed = !is_null(SharedBlog::where('id_user', Auth::id())->where('id_blog', $id)->first());
    	return view('blog', ['blog' => $blog, 'isFollowed' => $isFollowed, 'articles' => $r]);
    }

    public function filterwall()
    {
        $blogs = Blog::where('id_author', Auth::id())
               ->orderBy('created_at', 'asc')
               ->get();
 
        $blogsId = Sharedblog::where('id_user', Auth::id())->pluck('id_blog');

        if(!count($blogsId))
        	return view('home', ['articles' => []]);

        foreach($blogsId as $b){
        	$bArticle = Article::where('id_blog', $b)->orWhereIn('id', 
        		SharedArticle::where('id_blog', $b)->select('id_article')->get())->orderBy('created_at', 'DESC')->get();
        	$articles = isset($articles) ? $articles->merge($bArticle)->sortByDesc('created_at') : $bArticle;
        } 
        
        $category = Input::get('category');
        
        if($category != 0)
        	$articles = $articles->where('id_category', $category);

        $year = Input::get('year');
        if($year != 0)
        	$articles = $articles->where('created_at', '>=', "$year-01-01")->where('created_at', '<', ($year + 1 ). '-01-01');

        return view('home', ['articles' => $articles, 'blogsId' => $blogsId->toArray()]);
    }

    public function _list()
    {
    	$allBlogs = Blog::all();
    	return view('bloglist', ['allBlogs' => $allBlogs]);
    }

    public function manage($id)
    {
    	$blog = Blog::find($id);

    	if(is_null($blog))
    		return redirect()->back()->with('info', 'No blog found');

    	if($blog->id_author != Auth::id())
    		return redirect()->back()->with('info', 'Permission denied !');

    	return view('blogedit', ['blog' => $blog]);
    }

    public function edit($id)
    {	
    	$blog = Blog::find($id);
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

    	$blog->save();
    	return redirect()->back()->with('info', 'Blog updated !');
    }
}
