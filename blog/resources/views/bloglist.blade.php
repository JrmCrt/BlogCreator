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
                <div class="panel-heading clearfix">Blogs </div>
                <div class="panel-body">
                  @foreach($allBlogs as $k => $b)
                    <p><a href="{{ url(''.$b->id.'') }}" > {{ App\Blog::find($b->id)->title}}</a> by <a href="{{ url('profile/'.$b->id_author) }}"/>{{App\User::Find($b->id_author)->name}}</a> created at {{$b->created_at}}</p>
                    
                    <?php $k != count($allBlogs) - 1 && print("<hr>"); ?> 
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
