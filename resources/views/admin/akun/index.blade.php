<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Data user</title>
</head>
<body>
  <h1>Data user</h1>
  <a href="{{ route('admin/dashboard') }}">Menu utama</a>
  <a href="{{ rote('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
  <br><br>
  <form action=""method="get">
    <label>Cari :</label>
    <input type="text" name="cari">
    <input type="submit" value="cari">
  </form>
  <br><br>
  <a href="">Tambah User</a>
  @if(Session::has('succes'))
  <div class="alert alert-success" role="alert">
    {{  Session::get('success') }}
  </div>
  @endif
  <table class="table">
    <tr>
      <th>Nama</th>
      <th>Email</th>
      <th>Role</th>
      <th>Aksi</th>
    </tr>
    @forelse ($users as $user)
    <tr>
      <td>{{  $user->name }}</td>
      <td>{{  $user->email }}</td>
      <td>{{  $user->usertype }}</td>


      <td>
        <a href="{{  $user->id }}" class="btn btn-sm btn-primary">Edit</a>
      </td>
    </tr>
    @empty
<tr>
  <td>
    <p>Data tidak ditemukan</p>
  </td>
  <td>
    <a href="{{ route('akun.index') }}">kembali</a>
  </td>
</tr>
@endforelse
  </table>
  {{  $users->links() }}
</body>
</html>