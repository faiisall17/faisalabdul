<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tambah akun</title>
</head>
<body>
  <h1>Register</h1>
  <br><br>
  <a href="{{ route('akun.index') }}">kembali</a><br><br>
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
   <form action="{{ route('akun.store') }}" method="post">
@csrf
<label>Nama lengkap</label><br>
<input type="text" id="name" name="name" value="{{ old('name') }}"><br>

<br>
<label>Email Address</label><br>
<input type="text" id="email" name="email" value="{{ old('email') }}"><br>
<br>
<label>Password</label><br>
<input type="text" id="password" name="password"><br>
<br>
<label for="password_confirmation" class="col-md4 col-form-label text-md-end text-start">Confrim password</label>
<div class="col-md-6">
  <input type="password" name="password_cofirmation" id="password_cofirmation" class="form-control">
</div>
<label>Hak akses</label>
<select name="usertype" required>
  <option value="">Pilih Hak Akses</option>
  <option value="admin">admin</option>
  <option value="ptk">ptk</option>
</select><br><br>
<input type="submit" value="Register">
   </form>
</body>
</html>