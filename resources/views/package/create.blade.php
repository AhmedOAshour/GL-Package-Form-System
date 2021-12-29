@extends('master')

@section('title', 'Package Form')

@section('content')
<a href="/login">Log In</a> <br><br>

@if (isset($submit))
    <h2>Form Submitted!</h2>
    <h3>Your Serial number is {{$serial_number}} <br>Please save it</h3>
@endif

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="" method="post">
    @csrf

    <input type="text" name="member_name" id="member_name" placeholder="Full Name"> <br>

    <input type="text" name="member_id" id="member_id" placeholder="Student ID"> <br>

    <div>
        <h3>Package Items:</h3>
        <input type="checkbox" name="package_items[]" value='tshirt' onchange="changeAmount('tshirt')">
        <label for="t-shirt">T-shirt</label> <br>

        <input type="checkbox" name="package_items[]" value='nametag' onchange="changeAmount('nametag')">
        <label for="nametag">Nametag</label> <br>
        
        <input type="checkbox" name="package_items[]" value='bracelet' onchange="changeAmount('bracelet')">
        <label for="bracelet">Bracelet</label> <br>
    </div> <br>
    
    Amount: <span id='amount'>JS to be added</span>  <br><br>
    <button type="submit">Checkout</button>
</form>
@endsection