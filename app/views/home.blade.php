@extends("global.base")

@section("links")
    <li><a href="/">Home</a></li>
    <li><a href="/login">Login</a></li>
    <li><a href="/register">Register</a></li>
    @if ($isAdmin)
    
    @endif
@endsection


@section("main")
    <h1>Hello from index</h1>
@endsection