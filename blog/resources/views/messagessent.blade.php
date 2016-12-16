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
                 <div class="panel-heading clearfix">Messages sent<a href="{{ url('/message/list') }}" class="btn btn-warning pull-right" role="button"><i class="fa fa-envelope" aria-hidden="true"></i> Inbox</a></div>
                <div class="panel-body">
                        @foreach ($messages as $k => $message)
                            <p><strong>To : </strong>{{ App\User::Find($message->id_recipient)->name }}</p>
                            <p><strong>Date : </strong>{{ $message->created_at }}</p>
                            <pre>
                                <p class="text-center">{{$message->text}}</p>  
                            </pre>
                            <a href="{{ url('/message/send/'.$message->id_recipient.'') }}" class="btn btn-primary" role="button"><i class="fa fa-reply" aria-hidden="true"></i> Contact</a>

                            <a href="{{ url('/message/remove/'.$message->id.'/sent') }}" class="btn btn-danger" role="button"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                            <?php $k != count($messages) - 1 && print("<hr>") ; ?> 
                        @endforeach
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
