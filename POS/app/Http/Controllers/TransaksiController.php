<?php

namespace App\Http\Controllers;

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
}
