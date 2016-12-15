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
use App\Image;
use App\Notification;

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
        
        $images = Input::file('images');
        if(!is_null($images))
            foreach($images as $image){ 
                $fName = $image->getClientOriginalName();
                $destinationPath = "files";
                $image->move($destinationPath, $fName); 
                $img = new Image;
                $img->id_article = $article->id;
                $img->image = $fName;
                $img->mime = $image->getClientMimeType();
                $img->save();
            }

        $blog = Blog::find($id);
        $followers = SharedBlog::where('id_blog', $id)->pluck('id_user');

        if(!is_null($followers))
            foreach($followers as $user){
                $notification = new Notification;
                $notification->id_user = $user;
                $notification->url = "blog/$id/read/$article->id";
                $notification->icon = 'file-text-o';
                $notification->content = 'New article on blog ' . $blog->title;
                $notification->save();
            }


        return redirect()->back()->with('info', 'Article saved !');
    }

    public function share($id_blog, $id)
    {   
        $blog = Blog::find($id_blog);
        if($blog->id_author != Auth::id())
            return redirect()->back()->with('info', 'Permission denied !');

        $sharedArticle = new SharedArticle;
        $sharedArticle->id_article = $id;
        $sharedArticle->id_blog = $id_blog;
        $sharedArticle->save();

        $article = Article::find($id);
        $notification = new Notification;
        $notification->id_user = $article->id_author;
        $notification->url = "$blog->id";
        $notification->icon = 'retweet';
        $notification->content = Auth::user()->name . ' shared your article ' . $article->title . ' on their blog ' . $blog->title;
        $notification->save();

        return redirect()->back()->with('info', 'Article shared !');
    }

    public function addComment($id)
    {   
        $comment = new Comment;
        $comment->id_user = Auth::id();
        $comment->id_article = $id;
        $comment->content = Input::get('content');
        $comment->save();

        $article = Article::find($id);

        if(Auth::id() != $article->id_author){
            $notification = new Notification;
            $notification->id_user = $article->id_author;
            $notification->url = "blog/$article->id_blog/read/$article->id";
            $notification->icon = 'comment';
            $notification->content = Auth::user()->name . ' commented on your article ' . $article->title;
            $notification->save();            
        }

        return redirect()->back()->with('info', 'Comment saved !');  
    }

    public function editArticle($id)
    {   
        $article = Article::find($id);
         if(is_null($article))
            return redirect()->back()->with('info', 'No article found !');

        return view('articleedit', ['article' => $article]);
    }

    public function doEdit($id)
    {   
        $article = Article::find($id);
        $article->title = Input::get('title');
        $article->chapo = Input::get('chapo');
        $article->content = Input::get('content');
        $article->save();

        $images = Input::file('images');
        if(!is_null($images))
            foreach($images as $image){ 
                $fName = $image->getClientOriginalName();
                $destinationPath = "files";
                $image->move($destinationPath, $fName); 
                $img = new Image;
                $img->id_article = $id;
                $img->image = $fName;
                $img->mime = $image->getClientMimeType();
                $img->save();
            }
        return redirect()->back()->with('info', 'Article updated !');  
    }

    public function removeImg($id)
    {   
        $image = Image::find($id);
        $image->destroy($image->id);
        return redirect()->back()->with('info', 'Image removed !');
    }

    public function read($id_blog, $id)
    {   
        $article = Article::find($id);
        $blog = Blog::find($id_blog);

        if(is_null($article) || is_null($blog))
            return redirect()->back()->with('info', 'No article found !');

        $isFollowed = !is_null(SharedBlog::where('id_user', Auth::id())->where('id_blog', $id_blog)->first());
        return view('article', ['blog' => $blog, 'article' => $article, 'isFollowed' => $isFollowed]);
    }
}
