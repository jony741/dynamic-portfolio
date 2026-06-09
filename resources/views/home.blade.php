@extends('home.layouts.app')
@section('title', $profile->full_name . ' | ' . $profile->designation)

@section('content')
    @include('home.components.navigation', ['profile' => $profile])
    @include('home.components.hero', ['profile' => $profile])
    @include('home.components.about',['profile' => $profile, 'experiences' => $experiences])
    @include('home.components.projects', ['projects' => $projects]))
    @include('home.components.skills', ['stackItems' => $stackItems])
    @include('home.components.contact', ['profile' => $profile])
    @include('home.components.footer-nav')
@endsection