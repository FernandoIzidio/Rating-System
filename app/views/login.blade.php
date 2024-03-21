@extends("root");


@section("main")
    @include('global.partials.loginForm', ['data' => $data])
@endsection