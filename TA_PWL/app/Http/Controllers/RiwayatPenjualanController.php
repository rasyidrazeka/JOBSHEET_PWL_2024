<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\DetailPenjualanModel;
use App\Models\MetodePembayaranModel;
use App\Models\PenjualanModel;
use App\Models\ProdukModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RiwayatPenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Riwayat Penjualan',
            'list' => ['Home', 'Riwayat Penjualan']
        ];
        $page = (object)[
            'title' => 'Berikut ini merupakan data riwayat penjualan yang tersedia di toko'
        ];
        $activeMenu = 'riwayatPenjualan';
        $user = UserModel::all();
        $customer = CustomerModel::all();
        $metode_pembayaran = MetodePembayaranModel::all();
        return view('riwayatPenjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'user' => $user, 'customer' => $customer, 'metode_pembayaran' => $metode_pembayaran]);
    }

    public function list(Request $request)
    {
        $penjualans = PenjualanModel::with('user', 'customer', 'metode_pembayaran')->select('penjualan_id' ,'user_id', 'customer_id', 'jumlah_total', 'metode_pembayaran_id', 'created_at'); 
        // if($request->kategori_id) {
        //     $produks->where('kategori_id', $request->kategori_id);
        // }
        return DataTables::of($penjualans)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($penjualan) { // menambahkan kolom aksi  
                $btn = '<a href="'.url('/riwayatPenjualan/' . $penjualan->penjualan_id).'" class="btn btn-info btn-sm" id="btn-detail"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;Detail</a> '; 
            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true);
    }

    public function show(string $id){
        $penjualan = PenjualanModel::with('user', 'customer', 'metode_pembayaran')->find($id);
        // $id_penjualan = $penjualan == DetailPenjualanModel::find('penjualan_id');
        // $detail_penjualan = DetailPenjualanModel::with('penjualan', 'produk')->find($id_penjualan);

        $breadcrumb = (object) [
            'title' => 'Detail Riwayat Penjualan',
            'list' =>['Home', 'Riwayat Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail riwayat penjualan yang dipilih'
        ];

        $activeMenu = 'riwayatPenjualan';

        // 'detailPenjualan' => $detailPenjualan,

        return view('riwayatPenjualan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'penjualan' => $penjualan]);
    }
}
