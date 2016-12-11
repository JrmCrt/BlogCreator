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
                <div class="panel-heading">Messages</div>
                <div class="panel-body">
                        @foreach ($messages as $k => $message)
                            <p><strong>From : </strong>{{ App\User::Find($message->id_sender)->name }}</p>
                            <p><strong>Date : </strong>{{ $message->created_at }}</p>
                            <pre>
                                <p class="text-center">{{$message->text}}</p>  
                            </pre>
                            <a href="{{ url('/message/send/'.$message->id_sender.'') }}" class="btn btn-primary" role="button"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>

                            <a href="{{ url('/message/remove/'.$message->id.'') }}" class="btn btn-danger" role="button"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                            <?php $k != count($messages) - 1 && print("<hr>") ; ?> 
                        @endforeach
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
