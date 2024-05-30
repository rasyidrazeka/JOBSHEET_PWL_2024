<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
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

        $barang = BarangModel::all();

        $notifBarang = BarangModel::all();

        $stokKurang = BarangModel::where('volume', '<=', 5)->get();
        
        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stokKurang' => $stokKurang, 'barang' => $barang, 'notifBarang' => $notifBarang, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id', 'barang_nama', 'merk', 'volume', 'satuan'); 
        return DataTables::of($barangs) 
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
                if (auth()->user()->level_id==1) {
                    $btn = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info" id="btn-detail"></i>&nbsp;&nbsp;Detail</a> '; 
                    $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'" class="btn btn-warning btn-sm" style="color: white" id="btn-edit"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Edit</a> '; 
                    $btn .= '<form class="d-inline-block" id="btn-hapus" method="POST" action="'. url('/barang/'.$barang->barang_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');"><i class="fa-solid fa-trash-can"></i>&nbsp;&nbsp;Hapus</button></form>'; 
                }elseif (auth()->user()->level_id==2) {
                    $btn = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;Detail</a> '; 
                }
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

        $notifBarang = BarangModel::all();

        $stokKurang = BarangModel::where('volume', '<=', 5)->get();

        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stokKurang' => $stokKurang, 'notifBarang' => $notifBarang, 'activeMenu' => $activeMenu]);
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
        Alert::toast('Data barang berhasil ditambahkan', 'success');
        return redirect('/barang');
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

        $notifBarang = BarangModel::all();

        $stokKurang = BarangModel::where('volume', '<=', 5)->get();

        return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stokKurang' => $stokKurang, 'barang' => $barang, 'notifBarang' => $notifBarang, 'activeMenu' => $activeMenu]);
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

        $notifBarang = BarangModel::all();

        $stokKurang = BarangModel::where('volume', '<=', 5)->get();

        return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stokKurang' => $stokKurang, 'barang' => $barang, 'notifBarang' => $notifBarang, 'activeMenu' => $activeMenu]);
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
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
            // 'gambar' => $nama_gambar
        ]);
        Alert::toast('Data barang berhasil diubah', 'success');
        return redirect('/barang');
    }

    public function destroy(string $id)
    {
        $check = BarangModel::find($id);
        if(!$check){
            Alert::toast('Data barang tidak ditemukan', 'error');
            return redirect('/barang');
        }
        try{
            BarangModel::destroy($id);
            Alert::toast('Data barang berhasil dihapus', 'success');
            return redirect('/barang');
        }catch(\Illuminate\Database\QueryException $e){
            Alert::toast('Data barang gagal dihapus', 'error');
            return redirect('/barang');
        }
    }
}
