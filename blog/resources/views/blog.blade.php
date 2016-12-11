@extends('layouts.app')

@section('content')

@if(isset($info))
    <div class="alert alert-success alert-dismissible fade in" role="alert">
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
                <div class="panel-heading">{{$blog->title}}</div>
                <div class="panel-body">
          
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
