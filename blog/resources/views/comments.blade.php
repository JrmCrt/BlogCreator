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
                <div class="panel-heading">Comments</div>
                <div class="panel-body">
                   @foreach($comments as $k => $comment)
                        <p><a href="{{ url('/profile/'.$comment->id_user.'') }}"/>{{App\User::find($comment->id_user)->name}}</a> | {{$comment->created_at}}</p>
                        <p>{{$comment->commentContent}}</p>
                        <a href="{{ url('/comment/remove/'.$comment->id_comment.'') }}" class="btn btn-danger" role="button"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        <?php $k != count($comments) - 1 && print("<hr>") ; ?> 
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
