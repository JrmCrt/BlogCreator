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
                <div class="panel-heading">Message</div>
                <div class="panel-body">
                   <p><strong>To : </strong>{{ $recipient->name }}</p>

                   <form class="form-horizontal" role="form" method="POST" action="{{ url('/message/send/'. $recipient->id.'') }} " >
                      {{ csrf_field() }}
                      <div class="form-group">
                          <textarea class="form-control" rows="5" id="comment" name="content"></textarea>
                      </div>

                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-share-square" aria-hidden="true"></i> Send
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
