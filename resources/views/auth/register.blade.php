@extends('auth.layouts')

@section('content')
<h1>Register</h1>
<a href="{{ route('login') }}">Login</a>
<br><br>
<form action="{{ route('store') }}" method="post">
    @csrf
    <label>Nama Lengkap</label><br>
    <input type="text" name="name" id="name" value="{{ old('name') }}"><br>

    @if ($errors->has('name'))
    <span class="text-danger">{{ $errors->first('name') }}</span>
    @endif

    <br>
    <label>Email Address</label><br>
    <input type="email" name="email" id="email" value="{{ old('email') }}"><br>

    @if ($errors->has('email'))
    <span class="text-danger">{{ $errors->first('email') }}</span>
    @endif
    
    <br>
    <label>Password</label><br>
    <input type="password" name="password" id="password"><br>
    @if ($errors->has('password'))
    <span class="text-danger">{{ $errors->first('password') }}</span>
    @endif
    <br>
    <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Confrim Password</label>
    <div>
        <input type="password" name="password_confirmation" id="password_confirmation" class="from-control">
    </div>
    <input type="submit" value="Register">
</form>
@endsection