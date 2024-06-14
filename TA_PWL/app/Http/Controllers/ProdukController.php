<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use App\Models\ProdukModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Produk',
            'list' => ['Home', 'Produk']
        ];
        $page = (object)[
            'title' => 'Berikut ini merupakan data produk yang tersedia di toko'
        ];
        $activeMenu = 'produk';
        $kategori = KategoriModel::all();
        return view('produk.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
    }

    public function list(Request $request)
    {
        $produks = ProdukModel::with('kategori')->select('produk_id', 'nama_produk', 'kategori_id', 'deskripsi', 'harga', 'stok'); 
        if($request->kategori_id) {
            $produks->where('kategori_id', $request->kategori_id);
        }
        return DataTables::of($produks)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($produk) { // menambahkan kolom aksi  
                $btn = '<a href="'.url('/produk/' . $produk->produk_id).'" class="btn btn-info btn-sm" id="btn-detail"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;Detail</a> '; 
                $btn .= '<a href="'.url('/produk/' . $produk->produk_id . '/edit').'" class="btn btn-warning btn-sm" style="color: white" id="btn-edit"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Edit</a> '; 
                $btn .= '<form class="d-inline-block" id="btn-hapus" method="POST" action="'. url('/produk/'.$produk->produk_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');"><i class="fa-solid fa-trash-can"></i>&nbsp;&nbsp;Hapus</button></form>'; 
            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Form Data Produk',
            'list' => ['Home', 'Produk', 'Tambah']
        ];

        $page = (object)[
            'title' => "Tambah data produk baru"
        ];

        $kategori = KategoriModel::all();

        $activeMenu = 'administrasi';

        return view('produk.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|min:3|unique:produk,nama_produk',
            'kategori_id' => 'required|integer',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        ProdukModel::create([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => 0
        ]);

        Alert::toast('Data produk berhasil ditambahkan', 'success');
        return redirect('/produk');
    }

    public function show(string $id){
        $produk = ProdukModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Produk',
            'list' =>['Home', 'Produk', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail produk yang dipilih'
        ];

        $activeMenu = 'produk';

        return view('produk.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'produk' => $produk, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $produk = ProdukModel::find($id);

        $kategori = KategoriModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Produk',
            'list' => ['Home', 'Produk', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit produk'
        ];

        $activeMenu = 'produk';

        return view('produk.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'produk' => $produk, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|min:3|unique:produk,nama_produk,'.$id.',produk_id',
            'kategori_id' => 'required|integer',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric'
        ]);

        ProdukModel::find($id)->update([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga
        ]);
        Alert::toast('Data produk berhasil diubah', 'success');
        return redirect('/produk');
    }

    public function destroy(string $id)
    {
        $check = ProdukModel::find($id);
        if(!$check){
            Alert::toast('Data produk tidak ditemukan', 'error');
            return redirect('/produk');
        }
        try{
            ProdukModel::destroy($id);
            Alert::toast('Data produk berhasil dihapus', 'success');
            return redirect('/produk');
        }catch(\Illuminate\Database\QueryException $e){
            Alert::toast('Data produk gagal dihapus', 'error');
            return redirect('/produk');
        }
    }
}
