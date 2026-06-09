@extends('home.layouts.app')

@section('title', 'Khurshid Alam | Full Stack AI Developer')

@section('content')
    @include('home.components.navigation')
    @include('home.components.hero')
    @include('home.components.about')
    @include('home.components.projects')
    @include('home.components.skills')
    @include('home.components.contact')
    @include('home.components.footer-nav')
@endsection