<?php

namespace App\Http\Controllers;

use App\Models\TransaksiMasukModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransaksiMasukController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Transaksi Masuk',
            'list' => ['Home', 'Transaksi Masuk']
        ];
        $page = (object)[
            'title' => 'Berikut ini merupakan data transaksi masuk dari sistem informasi inventaris BHP JTI POLINEMA'
        ];
        $activeMenu = 'transaksiMasuk';
        $barang = BarangModel::all();
        return view('transaksiMasuk.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $transaksiMasuks = TransaksiMasukModel::select('transaksiMasuk_id', 'barang_id', 'qty', 'tanggal_diterima')->with('barang'); 
        if($request->barang_id) {
            $transaksiMasuks->where('barang_id', $request->barang_id);
        }
        return DataTables::of($transaksiMasuks) 
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($transaksi_masuk) { // menambahkan kolom aksi  
                $btn = '<a href="'.url('/transaksiMasuk/' . $transaksi_masuk->transaksiMasuk_id).'" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;Detail</a> '; 
                $btn .= '<a href="'.url('/transaksiMasuk/' . $transaksi_masuk->transaksiMasuk_id . '/edit').'" class="btn btn-warning btn-sm" style="color: white"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Edit</a> '; 
                $btn .= '<form class="d-inline-block" method="POST" action="'. url('/transaksiMasuk/'.$transaksi_masuk->transaksiMasuk_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');"><i class="fa-solid fa-trash-can"></i>&nbsp;&nbsp;Hapus</button></form>'; 
            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Formulir Data Transaksi Masuk',
            'list' => ['Home', 'Transaksi Masuk', 'Create']
        ];

        $page = (object)[
            'title' => "Tambah data transaksi masuk baru"
        ];

        $barang = BarangModel::all();

        $activeMenu = 'transaksiMasuk';

        return view('transaksiMasuk.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksiMasuk' => 'required|string|min:3|unique:transaksi_masuk,kode_transaksiMasuk',
            'barang_id' => 'required|integer',
            'qty' => 'required|integer',
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_diterima' => 'required'
        ]);

        $gambar = $request->file('gambar');
        $nama_gambar = time()."_".$gambar->getClientOriginalName();
        $tujuan_upload = 'img_barang';
		$gambar -> move($tujuan_upload,$nama_gambar);

        $volume = $request->qty;
        $id_barang = $request->barang_id;
        $vol_old = BarangModel::find($id_barang)->volume;
        // $volume_old = $request->barang->volume;

        TransaksiMasukModel::create([
            'kode_transaksiMasuk' => 312321312,
            'barang_id' => $id_barang,
            'qty' => $volume,
            'gambar' => $nama_gambar,
            'tanggal_diterima' => $request->tanggal_diterima
        ]);

        BarangModel::find($id_barang)->update([
            'volume' => $vol_old+$volume
        ]);
        return redirect('/transaksiMasuk')->with('success', 'Data transaksi masuk berhasil ditambah');
    }

    public function show(string $id){
        $transaksiMasuk = TransaksiMasukModel::with('barang')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' =>['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'transaksiMasuk';

        return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'transaksiMasuk' => $transaksiMasuk, 'activeMenu' => $activeMenu]);
    }
}
