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

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Articles </div>
                <div class="panel-body">
                   @foreach($articles as $k => $article)
                        @if($article->id_blog == $blog->id)
                            <p><a href="{{ url('/profile/'.$article->id_author.'') }}"/>{{App\User::find($article->id_author)->name}}</a> | {{$article->created_at}}</p>
                            <p>{{$article->title}}</p>
                            <p>{{$article->chapo}}</p>
                            <p>{{$article->content}}</p>
                            <a href="{{ url('/article/remove/'.$article->id.'') }}" class="btn btn-danger" role="button"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                            <a href="{{ url('/article/edit/'.$article->id.'') }}" class="btn btn-primary" role="button"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                        @else
                            <p><em><strong>Shared from </strong></em><a href="{{ url('/blog/'.$article->id_blog.'/read/'.$article->id.'') }}" > {{ App\Blog::find($article->id_blog)->title}}</a></p>
                            <p><a href="{{ url('/profile/'.$article->id_author.'') }}"/>{{App\User::find($article->id_author)->name}}</a> | {{$article->created_at}}</p>
                            <p>{{$article->title}}</p>
                            <p>{{$article->chapo}}</p>
                            <p>{{$article->content}}</p>
                            <a href="{{ url('/blog/'.$blog->id.'/article/unshare/'.$article->id) }}" class="btn btn-danger" role="button"><i class="fa fa-trash" aria-hidden="true"></i> Unshare</a>
                        @endif    
                        <?php $k != count($articles) - 1 && print("<hr>"); ?> 
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
