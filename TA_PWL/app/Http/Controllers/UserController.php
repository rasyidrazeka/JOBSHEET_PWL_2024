<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];
        $page = (object)[
            'title' => 'Berikut ini merupakan data user yang tersedia di toko'
        ];
        $activeMenu = 'user';
        $level = LevelModel::all();
        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'level' => $level]);
    }

    public function list(Request $request)
    {
        $users = UserModel::with('level')->select('user_id', 'nama_lengkap', 'email', 'no_hp', 'level_id'); 
        if($request->level_id) {
            $users->where('level_id', $request->level_id);
        }
        return DataTables::of($users)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi  
                $btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm" id="btn-detail"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;Detail</a> '; 
                $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm" style="color: white" id="btn-edit"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Edit</a> '; 
                $btn .= '<form class="d-inline-block" id="btn-hapus" method="POST" action="'. url('/user/'.$user->user_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');"><i class="fa-solid fa-trash-can"></i>&nbsp;&nbsp;Hapus</button></form>'; 
            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Form Data User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object)[
            'title' => "Tambah data user baru"
        ];

        $level = LevelModel::all();

        $activeMenu = 'user';

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:user,username',
            'nama_lengkap' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|string',
            'level_id' => 'required|integer',
            'password' => 'required|min:5'
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'level_id' => $request->level_id,
            'password' => bcrypt($request->password)
        ]);

        Alert::toast('Data user berhasil ditambahkan', 'success');
        return redirect('/user');
    }

    public function show(string $id){
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail user',
            'list' =>['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail user yang dipilih'
        ];

        $activeMenu = 'user';

        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $user= UserModel::find($id);

        $level = LevelModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit user yang sudah terdaftar'
        ];

        $activeMenu = 'user';

        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:user,username,'.$id.',user_id',
            'nama_lengkap' => 'required|string',
            'email' => 'required|email:dns',
            'no_hp' => 'required|string',
            'level_id' => 'required|integer',
            'password' => 'nullable|min:5'
        ]);

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'level_id' => $request->level_id,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password
        ]);
        Alert::toast('Data user berhasil diubah', 'success');
        return redirect('/user');
    }

    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if(!$check){
            Alert::toast('Data user tidak ditemukan', 'error');
            return redirect('/user');
        }
        try{
            UserModel::destroy($id);
            Alert::toast('Data user berhasil dihapus', 'success');
            return redirect('/user');
        }catch(\Illuminate\Database\QueryException $e){
            Alert::toast('Data user gagal dihapus', 'error');
            return redirect('/user');
        }
    }
}
