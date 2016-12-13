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
                <div class="panel-heading">Profile</div>
                <div class="panel-body">
                @if(isset($user))
                    @if($user->id != Auth::id()){{-- not out profile --}}
                    <div class="panel-body">
                        <p><strong>Name : </strong>{{ $user->name }}</p>
                        <p><strong>Email : </strong>{{ $user->email }}</p>
                        <p><strong>Blogs : </strong>
                        @foreach (App\Blog::where('id_author', $user->id)->orderBy('created_at', 'asc')->get() as $b)
                                            <a href="{{ url('/'.$b->id.'') }}"/>{{$b->title}}</a>   
                        @endforeach
                        </p>

                        <a href="{{ url('/message/send/'.$user->id.'') }}" class="btn btn-primary" role="button"><i class="fa fa-envelope-o" aria-hidden="true"></i> Contact</a>

                        <?php if(!$isFriend): ?>
                        <a href="{{ url('/friend/add/'.$user->id.'') }}" class="btn btn-warning" role="button"><i class="fa fa-user-plus" aria-hidden="true"></i> Friend</a>
                        <?php else: ?>
                        <a href="{{ url('/friend/remove/'.$user->id.'') }}" class="btn btn-danger" role="button"><i class="fa fa-user-times" aria-hidden="true"></i> Unfriend</a>
                        <?php endif; ?>
                    </div>
                    @else {{-- our profile --}}

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/profile/'. Auth::id().'') }} " >
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control" name="email" value="{{ $user->email}}" required>
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" value="">
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

                    @endif
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
