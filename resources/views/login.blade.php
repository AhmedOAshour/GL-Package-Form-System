@extends('master')

@section('title', 'Package Form')

@section('content')

    @if (isset($error))
        <h3>{{$error}}</h3>
    @endif

    <form action="" method="post">
        @csrf
        <input type="text" name="username" id="username" placeholder="Username">
        <input type="password" name="password" id="password" placeholder="Password">
        <button type="submit">Log In</button>
    </form>
@endsection