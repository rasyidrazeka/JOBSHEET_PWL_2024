<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Transaksi Penjualan',
            'list' => ['Home', 'Transaksi']
        ];

        $page = (object)[
            'title' => 'Daftar transaksi penjualan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'transaksi';

        return view('transaksi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request) 
    { 
        $transaksis = TransaksiModel::select('detail_id', 'penjualan_id', 'barang_id', 'jumlah') ->with('penjualan', 'barang'); 
        return DataTables::of($transaksis) 
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
        ->addColumn('aksi', function ($transaksi) { // menambahkan kolom aksi 
            $btn = '<a href="'.url('/transaksi/' . $transaksi->detail_id).'" class="btn btn-info btn-sm">Detail</a> '; 
            $btn .= '<a href="'.url('/transaksi/' . $transaksi->detail_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> '; 
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/transaksi/'.$transaksi->detail_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>'; 
            return $btn; 
        }) 
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true); 
    }

    public function create(){
        $breadcrumb = (object) [
            'title' => 'Tambah Transaksi',
            'list' =>['Home', 'Transaksi', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah transaksi baru'
        ];

        $penjualan = PenjualanModel::all();

        $barang = BarangModel::all();

        $activeMenu = 'transaksi';

        return view('transaksi.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data user baru
    public function store(Request $request){
        $request->validate([
            'penjualan_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'jumlah' => 'required|integer'
        ]);

        TransaksiModel::create([
            'penjualan_id' => $request->penjualan_id,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah
        ]);

        return redirect('/transaksi')->with('success', 'Data transaksi berhasil disimpan');
    }
}
