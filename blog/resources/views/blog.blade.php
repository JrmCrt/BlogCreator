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

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">{{$blog->title}} 
                @if($blog->id_author != Auth::id())
                    @if(!$isFollowed)
                        <a href="{{ url('/blog/share/'.$blog->id.'') }}" class="btn btn-primary pull-right" role="button"><i class="fa fa-share" aria-hidden="true"></i> Follow</a>
                    @else
                        <a href="{{ url('/blog/unfollow/'.$blog->id.'') }}" class="btn btn-danger pull-right" role="button"><i class="fa fa-times" aria-hidden="true"></i> Unfollow</a>   
                    @endif
                 @endif   
                </div>
                <div class="panel-body">
          
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
