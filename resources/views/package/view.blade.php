@extends('../master')

@section('title', 'Package Details')

@section('content')
<a href="/logout">Logout</a>

@if (isset($package))

    <h1>{{explode(' ',$package->member_name)[0]}}'s Package Details:</h1>

    <h3>Full name: {{$package->member_name}}</h3>
    <h3>Student ID: {{$package->member_id}}</h3>
    <h3>Serial Number: {{$package->serial_number}}</h3>
    <div>
        <h3>Package Items:</h3>
        <ul>
            @if ($package->tshirt)
                <li>T-shirt</li>
            @endif
            @if ($package->bracelet)
                <li>Bracelet</li>
            @endif
            @if ($package->nametag)
                <li>Nametag</li>
            @endif
        </ul>
    </div>
    <h3>Amount: {{$package->amount}} EGP</h3>

    <div>
        @if ($package->verified_at)
            <h3>Verified by {{$package->username}} at {{date('d-m-Y h:i A',strtotime($package->verified_at))}}</h3>
            <form action="" method="post">
                @csrf
                <input type="hidden" name="serial_number" value="{{$package->serial_number}}">
                <button type="submit" name="unverify">Unverify Payment</button>
            </form>
        @else
            <h3>Package not verified yet.</h3>
            <form action="" method="post">
                @csrf
                <input type="hidden" name="serial_number" value="{{$package->serial_number}}">
                <button type="submit" name="verify">Verify Payment</button>
            </form>
    @endif
</div>
@else

    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <form action="" method="post">
        @csrf
        <input type="text" name="serial_number" placeholder="Serial Number">
        <button type="submit">Find</button>
    </form>
@endif
    
@endsection