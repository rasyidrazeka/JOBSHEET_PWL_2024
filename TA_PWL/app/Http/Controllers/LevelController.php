<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Role',
            'list' => ['Home', 'Role']
        ];
        $page = (object)[
            'title' => 'Berikut ini merupakan data role yang tersedia di toko'
        ];
        $activeMenu = 'role';
        return view('role.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_nama'); 
        // if($request->kategori_id) {
        //     $produks->where('kategori_id', $request->kategori_id);
        // }
        return DataTables::of($levels)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($level) { // menambahkan kolom aksi  
                $btn = '<a href="'.url('/role/' . $level->level_id . '/edit').'" class="btn btn-warning btn-sm" style="color: white" id="btn-edit"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Edit</a> '; 
                $btn .= '<form class="d-inline-block" id="btn-hapus" method="POST" action="'. url('/role/'.$level->level_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');"><i class="fa-solid fa-trash-can"></i>&nbsp;&nbsp;Hapus</button></form>'; 
            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Form Data Role',
            'list' => ['Home', 'Role', 'Tambah']
        ];

        $page = (object)[
            'title' => "Tambah data role baru"
        ];

        $activeMenu = 'role';

        return view('role.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_nama' => 'required|string|min:3|unique:level,level_nama'
        ]);

        LevelModel::create([
            'level_nama' => $request->level_nama
        ]);

        Alert::toast('Data role berhasil ditambahkan', 'success');
        return redirect('/role');
    }

    public function edit(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Role',
            'list' => ['Home', 'Role', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit role yang sudah terdaftar di sistem'
        ];

        $activeMenu = 'role';

        return view('role.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_nama' => 'required|string|min:3|unique:level,level_nama,'.$id.',level_id'
        ]);

        LevelModel::find($id)->update([
            'level_nama' => $request->level_nama,
        ]);
        Alert::toast('Data level berhasil diubah', 'success');
        return redirect('/role');
    }

    public function destroy(string $id)
    {
        $check = LevelModel::find($id);
        if(!$check){
            Alert::toast('Data role tidak ditemukan', 'error');
            return redirect('/role');
        }
        try{
            LevelModel::destroy($id);
            Alert::toast('Data role berhasil dihapus', 'success');
            return redirect('/role');
        }catch(\Illuminate\Database\QueryException $e){
            Alert::toast('Data role gagal dihapus', 'error');
            return redirect('/role.');
        }
    }
}
