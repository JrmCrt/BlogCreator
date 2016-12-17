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
                <div class="panel-heading">New blog</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label for="title" class="col-md-4 control-label">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title" required value="{{$blog->title}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-md-4 control-label">Description</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control" name="description" required value="{{$blog->description}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="banner" class="col-md-4 control-label">Banner</label>

                        <div class="col-md-6">
                            <input id="banner" type="file" class="form-control-file" name="banner" >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4 ">
                            <a href="{{ url('/blog/delete/'.$blog->id) }}" class="btn btn-danger" role="button"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
