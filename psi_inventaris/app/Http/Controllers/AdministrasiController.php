<?php

namespace App\Http\Controllers;

use App\Models\AdministrasiModel;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdministrasiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Administrasi',
            'list' => ['Home', 'Administrasi']
        ];
        $page = (object)[
            'title' => 'Daftar Administrasi yang terdaftar dalam sistem'
        ];
        $activeMenu = 'administrasi';
        $level = LevelModel::all();
        return view('administrasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $users = AdministrasiModel::select('user_id', 'username', 'nama', 'level_id') ->with('level'); 
        if($request->level_id) {
            $users->where('level_id', $request->level_id);
        }
        return DataTables::of($users) 
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi 
            $btn = '<a href="'.url('/administrasi/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> '; 
            $btn .= '<a href="'.url('/administrasi/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> '; 
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/administrasi/'.$user->user_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>'; 
            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true);
    }
}
