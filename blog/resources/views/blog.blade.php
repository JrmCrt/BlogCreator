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

@if(isset($blog) && $blog->id_author == Auth::id()){{--if this is our blog...add blog menu --}}
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Blog menu</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="{{ url('/blog/'.$blog->id.'/article/new') }}"><i class="fa fa-plus" aria-hidden="true"></i> New article</a></li>
			<li><a href="{{ url('/blog/'.$blog->id.'/article/manage') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> Manage articles</a></li>
			<li><a href="{{ url('/blog/'.$blog->id.'/comment/manage') }}"><i class="fa fa-comments" aria-hidden="true"></i> Manage comments</a></li>
			<li><a href="{{ url('/category/manage') }}"><i class="fa fa-cog" aria-hidden="true"></i> Manage categories</a></li>
			<li><a href="{{ url('/blog/'.$blog->id.'/manage') }}"><i class="fa fa-book" aria-hidden="true"></i> Manage Blog</a></li>
		</ul>
	</div>
</nav>
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

<div class="banner" style="color:blue;">
	<img src="{{ URL::asset('files/'.$blog->banner)}}" class="img-fluid" alt="Responsive image">
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<div class="panel panel-info">
				<div class="panel-heading clearfix"><p><strong>{{$blog->title}}</strong> by <a href="{{ url('profile/'.$blog->id_author) }}"/>{{App\User::Find($blog->id_author)->name}}</p></a> <em>{{$blog->description}}</em>
					@if($blog->id_author != Auth::id())
					@if(!$isFollowed)
					<a href="{{ url('/blog/share/'.$blog->id.'') }}" class="btn btn-primary pull-right" role="button"><i class="fa fa-share" aria-hidden="true"></i> Follow</a>
					@else
					<a href="{{ url('/blog/unfollow/'.$blog->id.'') }}" class="btn btn-danger pull-right" role="button"><i class="fa fa-times" aria-hidden="true"></i> Unfollow</a>   
					@endif
					@endif   
				</div>
				<div class="panel-body">
					@foreach ($articles as $k => $article)
					<p><h2>{{ $article->title }}</h2> {{ $article->created_at }} </p>
					<p><em>{{ $article->chapo }}</em> | {{App\Category::find($article->id_category)->name}} </p>
					@if($article->id_blog != $blog->id)
					<p><em><strong>Shared from </strong></em><a href="{{ url(''.$article->id_blog.'') }}" > {{ App\Blog::find($article->id_blog)->title}}</a></p>
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
							@if($b->id != $blog->id)
							<a class="dropdown-item" href="{{ url('blog/'. $b->id.'/article/share/'.$article->id) }}"/>{{$b->title}}</a>   
							<div class="dropdown-divider"></div>
							@endif        
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
