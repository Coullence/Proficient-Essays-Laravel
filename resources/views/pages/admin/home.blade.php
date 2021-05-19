@extends('layouts.app')

@section('template_title')
    Welcome {{ Auth::user()->name }}
@endsection

@section('head')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
     	    <div class="col-md-12 col-sm-12">
     	    @include('panels.adminHome')
     	    </div>
           
        </div>
        <br>
      
    </div>

@endsection
