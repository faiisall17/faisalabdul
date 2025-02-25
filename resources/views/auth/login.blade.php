@extends('auth.layouts')

@section('content')
<h1>login</h1>
<a href="{{ route('register') }}">daftar</a>
<br><br>
<form action="{{ route('authenticate') }}" method="POST">
    @csrf
    <label>Email Address</label><br>
    <input type="email" id="email" name="email" value="{{ old('email') }}"><br><br>
    <label>Password</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>
@endsection