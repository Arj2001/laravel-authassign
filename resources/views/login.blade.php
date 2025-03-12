@extends('layouts.landing')
@section('content')
<form class="guest" action="/login" method="post">
    @csrf
    <div class="ms-5">
        <h1 class="text-3xl ">
            Login
        </h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-red-700">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <label for="email">Enter your email</label>

    <input class="" type="email" name="email" id="email" required>

    <label for="password">Enter your password</label>

    <input class="" type="password" name="password" id="password" required>
    <div class="text-center">
        <button class="bg-blue-700 rounded-lg p-2 hover:bg-blue-800" type="submit">Login</button>
    </div>
</form>
@endsection
