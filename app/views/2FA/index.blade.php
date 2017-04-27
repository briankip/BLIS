@extends('layout')
@section('content')
<div>
    <ol class="breadcrumb">
      <li><a href="{{{URL::route('user.home')}}}">{{ trans('messages.home') }}</a></li>
      <li class="active">{{trans('messages.2fa')}}</li>
    </ol>
</div>
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="panel panel-primary">
    <div class="panel-heading ">
        <span class="glyphicon glyphicon-adjust"></span>
        {{ trans('messages.2fa') }}
    </div>
    <br>
    <div class="container spark-screen">
        <div class="row">
	        <div class="col-md-10">
	            <div class="panel panel-default">
	                <div class="panel-heading">Active consent Privacy</div>

	                <div class="panel-body">
	                    @if (Auth::user()->google2fa_secret())
	                    <a href="{{ url('2fa/disable') }}" class="btn btn-danger">Disable 2FA</a>
	                    @else
	                    <a href="{{ url('2fa/enable') }}" class="btn btn-primary">Enable 2FA</a>
	                    @endif
	                </div>
	            </div>
	        </div>
    	</div>
    </div>
</div>
@endsection