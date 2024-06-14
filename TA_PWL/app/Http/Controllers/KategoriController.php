<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];
        $page = (object)[
            'title' => 'Berikut ini merupakan data kategori yang tersedia di toko'
        ];
        $activeMenu = 'kategori';
        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list()
    {
        $kategoris = KategoriModel::select('kategori_id', 'nama_kategori'); 

        return DataTables::of($kategoris)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($kategori) { // menambahkan kolom aksi  
                $btn = '<a href="'.url('/kategori/' . $kategori->kategori_id . '/edit').'" class="btn btn-warning btn-sm" style="color: white" id="btn-edit"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Edit</a> '; 
                $btn .= '<form class="d-inline-block" id="btn-hapus" method="POST" action="'. url('/kategori/'.$kategori->kategori_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');"><i class="fa-solid fa-trash-can"></i>&nbsp;&nbsp;Hapus</button></form>'; 
            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Form Data Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object)[
            'title' => "Tambah data kategori baru"
        ];

        $activeMenu = 'kategori';

        return view('kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|unique:kategori,nama_kategori',
        ]);

        KategoriModel::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        Alert::toast('Data kategori berhasil ditambahkan', 'success');
        return redirect('/kategori');
    }

    public function edit(string $id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit kategori yang dipilih'
        ];

        $activeMenu = 'kategori';

        return view('kategori.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|unique:kategori,nama_kategori,'.$id.',kategori_id',
        ]);

        KategoriModel::find($id)->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
        Alert::toast('Data kategori berhasil diubah', 'success');
        return redirect('/kategori');
    }

    public function destroy(string $id)
    {
        $check = KategoriModel::find($id);
        if(!$check){
            Alert::toast('Data produk tidak ditemukan', 'error');
            return redirect('/kategori');
        }
        try{
            KategoriModel::destroy($id);
            Alert::toast('Data kategori berhasil dihapus', 'success');
            return redirect('/kategori');
        }catch(\Illuminate\Database\QueryException $e){
            Alert::toast('Data kategori gagal dihapus', 'error');
            return redirect('/kategori');
        }
    }
}
