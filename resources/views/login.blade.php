@extends('master')

@section('title', 'Package Form')

@section('content')
    <form action="" method="post">
        <input type="text" name="username" id="username" placeholder="Username">
        <input type="password" name="password" id="password" placeholder="Password">
        <button type="submit">Log In</button>
    </form>
@endsection