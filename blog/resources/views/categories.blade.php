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
                <div class="panel-heading clearfix">Categories <a href="{{ url('/category/new') }}" class="btn btn-warning pull-right" role="button"><i class="fa fa-plus" aria-hidden="true"></i> New</a></div>
                <div class="panel-body">
                  @foreach($categories as $k => $category)
                    <p>{{$category->name}}</p>
                     <a href="{{ url('/category/remove/'.$category->id.'') }}" class="btn btn-danger" role="button"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                    <a href="{{ url('/category/edit/'.$category->id.'') }}" class="btn btn-primary" role="button"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                    <?php $k != count($categories) - 1 && print("<hr>"); ?> 
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
