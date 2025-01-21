@extends('layout')

@section('content')
    <div style="height: 100vh;">
        <h1>Welcome to the Blog Commenting System</h1>
        @auth
            <a href="{{ route('feed') }}">Go to Feed</a> |
            <a href="{{ route('logout') }}">Logout</a>
        @else
            <a href="{{ route('login') }}">Login</a> |
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </div>
@endsection
