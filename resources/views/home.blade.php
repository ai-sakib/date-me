@extends('layouts.app')

@section('content')
<style type="text/css">
	
</style>
<div style="padding-top: 10%;" class="container">
    <div style="padding-left: 50px;padding-right: 50px" class="row justify-content-center">
        <h2>Welcome to the best Dating app, <strong style="color: #39b398">Date Me</strong></h2>
        
    </div>
    <center>
        <div>
            <hr>
            <a href="{{ route('user-list') }}" class="btn btn-primary">Start Dating</a>
        </div>
    </center>
</div>
@endsection
