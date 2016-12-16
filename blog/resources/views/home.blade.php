@extends('layouts.app')

@section('content')

@if(isset($info))
<div class="alert alert-success alert-dismissible fade in text-center" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong> {{ $info }}</strong> 
</div>
@endif

@if (session('info'))
<div class="alert alert-success alert-dismissible fade in text-center" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong> {{ session('info') }}</strong> 
</div>
@endif

<form class="form-horizontal" role="form" method="POST" action="">
  {{ csrf_field() }}
  <div class="form-group">
      <label for="category" class="col-md-4 control-label">Category</label>

      <div class="col-md-4">
           <select class="form-control" name="category">
           <option value="0">All</option>
                @foreach (App\Category::all() as $category)
                  <option value="{{$category->id}}" 
                  <?php isset($_POST['category']) && $_POST['category'] == $category->id && print('selected');?>>{{$category->name}}</option>    
                @endforeach
          </select>
      </div>
  </div>
      <div class="form-group">
       <label for="year" class="col-md-4 control-label">Year</label>
      <div class="col-md-4">
           <select class="form-control" name="year">
           <option value="0">All</option>
                <?php for($i=date("Y"); $i >= 2010; $i--): ?>
                  <option value="{{$i}}"<?php isset($_POST['year']) && $_POST['year'] == $i && print('selected');?>>{{$i}}</option>
                <?php endfor; ?>
          </select>
      </div>
</div>

  <div class="form-group">
      <div class="col-md-6 col-md-offset-4">
          <button type="submit" class="btn btn-primary">
              <i class="fa fa-filter"></i> Filter
          </button>
      </div>
  </div>

</form>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-info">
                <div class="panel-heading clearfix"><strong>Wall</strong>
                </div>
                <div class="panel-body">
                    @foreach ($articles as $k => $article)
                    
                    @if(!in_array($article->id_blog, $blogsId))
                      <p><em><strong>Shared from </strong></em><a href="{{ url('/blog/'.$article->id_blog.'/read/'.$article->id) }}" > {{ App\Blog::find($article->id_blog)->title}}</a></p>
                      <?php
                      	$originalBlog = App\SharedArticle::where('id_article', $article->id)->whereIn('id_blog', $blogsId)->first();
                      ?>
                     	<p>From<a href="{{ url('/'.$originalBlog->id_blog.'') }}"/> {{App\Blog::find($originalBlog->id_blog)->title}}</a>
                		by<a href="{{ url('/profile/'.$article->id_author.'') }}"/> {{App\User::find(
                			App\Blog::find($originalBlog->id_blog)->id_author)->name}}</a></p>
                    <p><h2><a href="{{ url('/blog/'.$article->id_blog.'/read/'.$article->id.'') }}" >{{ $article->title }}</a></h2> {{ $article->created_at }} </p>
                    <p><em>{{ $article->chapo }}</em> | {{App\Category::find($article->id_category) != null ? App\Category::find($article->id_category)->name : 'Unknown'}} </p>
                    @else

                    <p>From<a href="{{ url('/'.$article->id_blog.'') }}"/> {{App\Blog::find($article->id_blog)->title}}</a>
                    by<a href="{{ url('/profile/'.$article->id_author.'') }}"/> {{App\User::find($article->id_author)->name}}</a></p>
                    <p><h2><a href="{{ url('/blog/'.$article->id_blog.'/read/'.$article->id.'') }}" >{{ $article->title }}</a></h2> {{ $article->created_at }} </p>
                    <p><em>{{ $article->chapo }}</em> | {{App\Category::find($article->id_category) != null ? App\Category::find($article->id_category)->name : 'Unknown'}} </p>
                    	  
                    @endif

                    <pre>{{ $article->content }}</pre>  
                    @foreach (App\Image::where('id_article', $article->id)->orderBy('created_at', 'asc')->get() as $image)
                        @if(strstr($image->mime, 'image'))
                            <img src="{{ URL::asset('files/'.$image->image)}}" class="articleImg" alt="Responsive image" >  
                        @else
                            <a href="{{ URL::asset('files/'.$image->image)}}" download="{{$image->image}}">Download {{$image->image}}</a>       
                        @endif        
                    @endforeach

                    <br/>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-share-alt" aria-hidden="true"></i> Share
                        </button>
                        <div class="dropdown-menu">
                            @foreach (App\Blog::where('id_author', Auth::id())->orderBy('created_at', 'asc')->get() as $b)
                        
                            <a class="dropdown-item" href="{{ url('blog/'. $b->id.'/article/share/'.$article->id) }}"/>{{$b->title}}</a>   
                            <div class="dropdown-divider"></div>
                           
                            @endforeach  
                        </div>
                    </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/article/comment/'. $article->id.'') }} " >
                        {{ csrf_field() }}
                        <br>
                        <div class="form-group ">

                            <div class="col-md-6">
                                <textarea class="form-control" rows="5" id="comment" name="content"></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-0">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-comment" aria-hidden="true"></i> Comment
                                </button>
                            </div>
                        </div>

                    </form>
                    @foreach (App\Comment::where('id_article', $article->id)->orderBy('created_at', 'asc')->get() as $comment)
                    <p><a href="{{ url('/profile/'.$comment->id_user.'') }}"/>{{App\User::find($comment->id_user)->name}}</a> | {{$comment->created_at}}</p>
                    <p>{{$comment->content}}</p>
                    <br>                
                    @endforeach  

                    <?="<hr>" ?> 
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
