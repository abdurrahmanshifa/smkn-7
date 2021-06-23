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

@section('content')
    @include('template.education.pages.detail-'.$page)
@endsection