<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah siswa</title>
</head>
<body>
    <h1>Tambah siswa</h1>
    <a href="{{ route('siswa.index') }}">Kembali</a><br><br>
    @if ($errors->any())
    <div class="alert alert->danger">
        <ul>
            @foreach ($errors ->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- {{ csrf_field() }} -->
        <h2>Akun Siswa</h2>
        <label>Nama Lengkap</label><br>
        <input type="text" name="name" id="name" value="{{ old('name') }}"><br><br>
        <label>EmailAddress</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
        <label>Password</label>
        <input type="password" name="password" id="password" value="{{ old('password') }}"><br><br>
        <label for="password_comfirmation" class="col-md-4 col-form-label text-md-end text-start">Confrim password</label>
        <div class="col-md-6">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div><br><br>
        <h2>Data Siswa</h2>
        <label>Foto siswa</label><br>
        <input type="file" name="image" accept="image/*" required>
        <br><br>
        
        <label>NIS Siswa</label><br>
        <input type="text" name="nis" value="{{ old('nis') }}" required>
        <br><br>
         <label>Tingkatan</label>
         <select name="tingkatan" required>
            <option value="">pilih tingkatan</option>
            <option value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>    
         </select>
         <br><br>
         <label>Tingkatan</label>
         <select name="jurusan" required>
            <option value="">pilih jurusan</option>
            <option value="TBSM">TBSM</option>
            <option value="TJKT">TJKT</option>
            <option value="PPLG">PPLG</option>
            <option value="DKV">DKV</option>
            <option value="TOI">TOI</option>
         </select>
         <br><br>
         <select name="kelas" required>
            <option value="">pilih kelas</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
         </select>
         <br><br>
         <label>No Hp</label>
         <input type="text" name="hp" value="{{ old('hp') }}" required>
         <br><br>
         <button type="submit">SIMPAN DATA</button>
         <button type="reset">RESET FROM</button>
    </form>
</body>
</html>