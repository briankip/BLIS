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
            <div class="col-md-10 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Privacy Secret Key</div>
                    <div class="panel-body">
                        Open up your google authencticator mobile app and scan the following QR barcode:
                        <br />
                        <br />
                        <img alt="Image of QR barcode" src="{{ $image }}" />

                        <br />
                        <br />
                        If your authenticator mobile app does not support QR barcodes, 
                        enter in the following number: <code>{{ $secret }}</code>
                        <br /><br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection