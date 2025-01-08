<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
</head>
<body>
    <h1>Data siswa</h1>
    <a href="{{ route('admin/dashboard') }}">Menu utama</a><br>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">logout</a>
    <br><br>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
    <br><br>
    <form action="" method="get">
        <label>Cari :</label>
        <input type="text" name="cari">
        <input type="submit" value="cari">
    </form>
    <br><br>
    <form action="" method="get">
        <label>Cari :</label>
        <input type="text" name="cari">
        <input type="text" value="Cari">
    </form>
    <br><br>
    <a href="{{ route('siswa.create') }}">Tambah Siswa</a>
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert" >
        {{ Session::get('success')}}
    </div>
    @endif
    <table class="tabel">
        <tr>
            <th>Foto</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Kelas</th>
            <th>No Hp</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @forelse ($siswas as $siswa)
        <tr>
            <td>
                <img src="{{ asset('storage/siswas/'.$siswa->image) }}" width=:"120px" hight="120px" alt="">
            </td>
            <td>{{ $siswa->nis }}</td>
            <td>{{ $siswa->name }}</td>
            <td>{{ $siswa->email }}</td>
            <td>{{ $siswa->tingkatan }} {{ $siswa->jurusan }} {{ $siswa-kelas }}</td>
            <td>{{ $siswa->hp }}</td>
            @if ($siswa->status ==1) :
                <td>Aktip</td>
                @else
                <td>Tidak aktip</td>
                @endif
                <td>
                    <form onsumbit="return confrim('apakah anda yakin');" action=" {{ route('siswa.destroy', $siswa->id) }}" method="POST">
                        <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-sm btn-dark">Show</a>
                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-sm btn-primery">Edit</a>
                        @csrf
                        @method('delete')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
        </tr>
        @empty
        <tr>
            <td>
                <p>data tidak di temukan</p>
            </td>
            <td>
                <a href="{{ route('siswa.index') }}">Kembali</a>
            </td>
        </tr>
        @endforelse
    </table>
    {{ $siswas->links()}}
</body>
</html>