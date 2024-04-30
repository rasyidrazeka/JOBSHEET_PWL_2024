<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];
        $page = (object)[
            'title' => 'Berikut ini merupakan data barang dari sistem informasi inventaris BHP JTI POLINEMA'
        ];
        $activeMenu = 'barang';
        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id', 'barang_nama', 'merk', 'volume', 'satuan'); 
        return DataTables::of($barangs) 
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;Detail</a> '; 
                $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'" class="btn btn-warning btn-sm" style="color: white"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Edit</a> '; 
                $btn .= '<form class="d-inline-block" method="POST" action="'. url('/barang/'.$barang->barang_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');"><i class="fa-solid fa-trash-can"></i>&nbsp;&nbsp;Hapus</button></form>'; 
                return $btn; 
            })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Formulir Data Barang',
            'list' => ['Home', 'Barang', 'Create']
        ];

        $page = (object)[
            'title' => "Tambah data barang baru"
        ];

        $activeMenu = 'barang';

        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|string|min:3|unique:barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'merk' => 'required|string|max:100',
            'spesifikasi' => 'required|string|max:500',
            // 'volume' => 'required|integer',
            'satuan' => 'required|string|max:50',
            'harga_satuan' => 'required|integer',
            // 'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // $gambar = $request->file('gambar');
        // $nama_gambar = time()."_".$gambar->getClientOriginalName();
        // $tujuan_upload = 'img_barang';
		// $gambar -> move($tujuan_upload,$nama_gambar);

        BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'merk' => $request->merk,
            'spesifikasi' => $request->spesifikasi,
            'volume' => 0,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
            // 'gambar' => $nama_gambar
        ]);
        return redirect('/barang')->with('success', 'Data barang berhasil ditambah');
    }

    public function show(string $id){
        $barang = BarangModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' =>['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang';

        return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $barang = BarangModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit barang'
        ];

        $activeMenu = 'barang';

        return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required|string|min:3|unique:barang,barang_kode,'.$id.',barang_id',
            'barang_nama' => 'required|string|max:100',
            'merk' => 'required|string|max:100',
            'spesifikasi' => 'required|string|max:500',
            // 'volume' => 'required|integer',
            'satuan' => 'required|string|max:50',
            'harga_satuan' => 'required|integer',
            // 'gambar' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // $gambar = $request->file('gambar');
        // $nama_gambar = time()."_".$gambar->getClientOriginalName();
        // $tujuan_upload = 'img_barang';
		// $gambar -> move($tujuan_upload,$nama_gambar);

        BarangModel::find($id)->update([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'merk' => $request->merk,
            'spesifikasi' => $request->spesifikasi,
            'volume' => 0,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
            // 'gambar' => $nama_gambar
        ]);
        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = BarangModel::find($id);
        if(!$check){
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }
        try{
            BarangModel::destroy($id);
            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
