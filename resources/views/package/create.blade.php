@extends('master')

@section('title', 'Package Form')

@section('content')
<a href="/login">Log In</a>

@if (isset($submit))
    <h2>Form Submitted!</h2>
@endif

<form action="" method="post">
    @csrf

    <input type="text" name="member_name" id="member_name" placeholder="Name"> <br>

    <input type="text" name="member_id" id="member_id" placeholder="Student ID"> <br>

    <div>
        <h3>Package Items:</h3>
        <input type="checkbox" name="tshirt" id="tshirt">
        <label for="t-shirt">T-shirt</label> <br>
        
        <input type="checkbox" name="nametag" id="nametag">
        <label for="nametag">Nametag</label> <br>
        
        <input type="checkbox" name="bracelet" id="bracelet">
        <label for="bracelet">Bracelet</label> <br>
    </div> <br>
    
    Amount: <p id='amount'></p>  <br>
    <button type="submit">Submit</button>
</form>
@endsection