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
                <div class="panel-heading">Friends</div>
                <div class="panel-body">
                    <?php foreach ($friends as $k => $f): 
                       $friend = $f->id_user1 != Auth::id() ? App\User::Find($f->id_user1) : App\User::Find($f->id_user2);
                    ?>   
                       <p><strong>Name : </strong> <a href="{{ url('profile/'.$friend->id) }}"/>{{$friend->name}}</a></p>
                        <p><strong>Email : </strong>{{ $friend->email }}</p>
                        <p><strong>Blogs : </strong>
                        @foreach (App\Blog::where('id_author', $friend->id)->orderBy('created_at', 'asc')->get() as $b)
                                            <p> - <a href="{{ url('/'.$b->id.'') }}"/>{{$b->title}}</a></p>   
                        @endforeach
                        <?php $k != count($friends) - 1 && print("<hr>") ; ?> 
                   <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
