@extends('template.education.layouts.education')

@section('title')
    @php
        if(request()->is('/') || request()->is('home') ):
            $title = 'BERANDA';
        else:
            $title = strtoupper(strtolower(str_replace('-',' ',$page)));
        endif;
    @endphp
    <title>{{$title}} | {{ str_replace("_"," ",config('app.name')) }}</title>
@endsection

@if(request()->is('/') || request()->is('home') )
    @section('slider')
        @include('template.education.includes.slider')
    @endsection
@else 
    @section('slider')
        @include('template.education.includes.headline')
    @endsection
@endif

@section('content')
    @if(request()->is('/') || request()->is('/home') )
        @include('template.education.pages.home')
    @else
        @include('template.education.pages.'.$page)
    @endif 
@endsection