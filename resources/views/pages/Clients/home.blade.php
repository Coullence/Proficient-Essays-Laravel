@extends('layouts.app')

@section('template_title')
    {{ Auth::user()->name }}'s' Homepage
@endsection

@section('template_fastload_css')
@endsection

@section('content')
<!-- content section -->
     @include('panels.clientHome')

@endsection

@section('footer_scripts')
@endsection
