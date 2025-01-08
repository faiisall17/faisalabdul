<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index(): View
    {

    //get Data DB
    $siswas = DB::table('siswas')
    ->join('users', 'siswas.id_user', '=', 'users.id')
    ->select(
        'siswas.*',
        'users.name',
        'users.email'
    )
    ->paginate(10);
    if (request('cari')){
        $siswas =$this->search(request('cari'));
    }

    return view('admin.siswa.index', compact('siswas'));
    }

        public function create():view
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request): RedirectRespon
    {
        //validate form
        $validated = $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nis' => 'required|numeric' ,
            'tingkatan' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'hp'  => 'required|numeric',
        ]);
        //upload image
        $image = $request->file('image');
        $image ->storeAs('public/siswas', $image->hashName());
        $id_akun = $this->insertAccount($request->name, $request->email, $request->password);

        //upload image
        $image = $request->file('image');
        $imagePath = $image ->storeAs('public/siswas', $image->hashName(), 'public');

        //jika config privat true dan .env public
       
        $id_akun = $this->insertAccount($request->name, $request->email, $request->password);

        //creat post
        Siswa::create([
            'id_users' => $id_akun,
            'image' => $image ->hashName(),
            'nis' => $request->nis,
            'tingkatan' => $request->tingkatan,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'hp' => $request->hp,
            'status'=> 1

        ]);
        //redirect to index
        return redirect()->route('siswa.index')->with(['success' => 'Data berhasil di simpan']);
    }
    public function insertAccount(string $name, string $email, string $password)
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'usertype' => 'siswa'
        ]);
        $id = DB::table('users')->where('email', $email)->value('id');

        return $id;
    }
    public function show(string $id): view
    {
        //get data DB
        
        $siswa = DB::table('siswas')
        ->join('users', 'siswas.id_user', '=' , 'users.id')
        ->select(
            'siswas.*',
            'users.name',
            'users.email'
        )
        ->where('siswas.id', $id)
        ->frist();



return view('admin,siswa,show', compact('siswa'));

    }
public function search(string $cari)
{
    $siswas = DB::table('siswas')
    ->join('users', 'siswas.id_user', '=', 'users.id')
    ->select(
        'siswas.*',
        'users.name',
        'users.email'
    )->where('users.name', 'like', '%'. $cari. '%')
    ->orWhere('siswas.nis', 'like', '%'. $cari. '%')
    ->orWhere('users.email', 'like', '%'. $cari. '%')
    ->paginate(10);
    return $siswas;
}
//untuk menuju halaman yang akan di edit
public function edit(string $id):view
{
    //get data base
    $siswa = DB::table('siswas')
    ->join('users', 'siswas.id_user', '=', 'users.id')
    ->select(
        'siswas.*',
        'users.name',
        'users.email'
    )
    ->where('siswas.id', $id)
    ->first();
    
    return view('admin.siswa.edit', compact('siswa'));
}

//untuk menambahkan update siswa
public function update(Request $request, $id): RedirectResponse
{
    //validate form
    $validate = $request->validate([
        'name' => 'required|string|max:250',
        'image' => 'required|image|mimes:jpeg,png,jpg',
        'nis' => 'required|numeric' ,
        'tingkatan' => 'required',
        'jurusan' => 'required',
        'kelas' => 'required',
        'hp'  => 'required|numeric',
        'status' => 'required'
    ]);


    //get post by id
$datas = Siswa::findOrfail($id);
//edit akun
$this->editAccount($request->name, $id);
// check if image is uplode

if ($request->hasfile('image')) {
    //uplode new image
    $image = $request->File('image');
    $image-> storeAs('publis/siswas', $image->hasName());
    //hapus poto lama
    Storage ::delete('publis/siswas', $datas->image);
    //update dengan poto baru
    $datas= $update([
        'image' => $image->hasName(),
        'nis' => $request->nis,
        'tingkatan' =>  $request->tingkatan,
        'jurusan' =>  $request->jurusan,
        'kelas' =>  $request->kelas,
        'hp'  =>  $request->hp,
        'status' =>  $request->status
    ]);


} else {
    //update post without image
    $datas= $update([
        'nis' => $request->nis,
        'tingkatan' =>  $request->tingkatan,
        'jurusan' =>  $request->jurusan,
        'kelas' =>  $request->kelas,
        'hp'  =>  $request->hp,
        'status' =>  $request->status
    ]);
}
//redirect to index
return redirect()-> route('siswa.index')->with(['success' =>'Data berhasil di ubah']);

}

public function editAccount(string $name, string $id)
{
    //get id user
    $siswa = DB::table('siswas')->where('id',$id)->value('id_user');
    $user = User::findOrFail($siswa);
    //jika ada password
    $user->update([
        'name'  => $name
    ]);
}
//hapus data

public function destroy($id): RedirectResponse
{
    //dellete pelanggaran
    $this->destroyUser($id);
    //get post by oid
    $post = Siswa::findOrFail($id);
    //dellete image
    Storage::delete('public/siswas/'. $post->image);
    //dellete post
    $post->delete();
    //redirect to index
    return redirect()->route('siswa.index')->with(['success' => 'Data berhasil dihapus!']);
}
public function destroyUser(string $id)
{
    //get user id
    $siswa = DB::table('siswas')->where('id', $id)->value('id_user');
    $user = User::findOrfail($siswa);
    //delete post
    $user->delete();



}




}
