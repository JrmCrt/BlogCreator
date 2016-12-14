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
                <div class="panel-heading">New article</div>
                <div class="panel-body">
                   <form class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title" class="col-md-4 control-label">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title" required value="{{$article->title}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="chapo" class="col-md-4 control-label">Chapo</label>

                        <div class="col-md-6">
                            <input id="chapo" type="text" class="form-control" name="chapo" required value="{{$article->chapo}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category" class="col-md-4 control-label">Category</label>

                        <div class="col-md-6">
                             <select class="form-control" name="category">
                                @foreach (App\Category::all() as $category)
                                    @if($category->id == $article->id_category)
                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->name}}</option>               
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category" class="col-md-4 control-label">Content</label>

                        <div class="col-md-6">
                            <textarea class="form-control" rows="10" id="comment" name="content">{{$article->content}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="images" class="col-md-4 control-label">Add images</label>

                        <div class="col-md-6">
                            <input id="images" type="file" class="form-control-file" name="images[]" multiple>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>

                </form>

                @foreach (App\Image::where('id_article', $article->id)->orderBy('created_at', 'asc')->get() as $image)
                    @if(strstr($image->mime, 'image'))
                        <div class="col-md-6 col-md-offset-4">
                        <img src="{{ URL::asset('files/'.$image->image)}}" class="articleImg" alt="Responsive image" >
                        <a href="{{ url('/image/remove/'.$image->id.'') }}" class="btn btn-primary" role="button"><i class="fa fa-times" aria-hidden="true"></i> Remove</a>     
                        </div>
                    @else   
                        <div class="col-md-6 col-md-offset-4">
                        {{$image->image}}
                        <a href="{{ url('/image/remove/'.$image->id.'') }}" class="btn btn-primary" role="button"><i class="fa fa-times" aria-hidden="true"></i> Remove</a>     
                        </div>
                    @endif 
                @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
