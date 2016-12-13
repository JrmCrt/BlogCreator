@extends('layouts.app')

@section('content')

@if(isset($info))
<div class="alert alert-success alert-dismissible fade in text-center" role="alert" >
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong > {{ $info }}</strong> 
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
                <div class="panel-heading">Wall</div>

                <div class="panel-body">{{-- get articles here to not fuck up all redirection --}}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
