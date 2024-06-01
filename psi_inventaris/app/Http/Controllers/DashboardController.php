<?php

namespace App\Http\Controllers;

use App\Charts\AdministrasiChart;
use App\Charts\BarangChart;
use App\Charts\TransaksiKeluarChart;
use App\Charts\TransaksiMasukChart;
use App\Models\AdministrasiModel;
use App\Models\BarangModel;
use App\Models\TransaksiKeluarModel;
use App\Models\TransaksiMasukModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class DashboardController extends Controller
{
    public function index(BarangChart $barangChart, AdministrasiChart $administrasiChart, TransaksiMasukChart $transaksiMasukChart, TransaksiKeluarChart $transaksiKeluarChart){
        $user = AdministrasiModel::with('level');
        $barang = BarangModel::all();
        $transaksi_masuk = TransaksiMasukModel::with('barang');
        $transaksi_keluar = TransaksiKeluarModel::with('barang');
        $breadcrumb = (object)[
            'title' => 'Dashboard Inventaris',
            'list' => ['Home', 'Dashboard']
        ];
        $activeMenu = 'dashboard';
        $notifBarang = BarangModel::all();
        $stokKurang = BarangModel::where('volume', '<=', 1)->get();
        return view('dashboard.index', ['breadcrumb' => $breadcrumb, 'notifBarang' => $notifBarang, 'transaksi_masuk'=>$transaksi_masuk, 'transaksi_keluar'=>$transaksi_keluar, 'barang' => $barang, 'user' => $user, 'barangChart' => $barangChart->build(), 'administrasiChart' => $administrasiChart->build(), 'transaksiMasukChart' => $transaksiMasukChart->build(), 'transaksiKeluarChart' => $transaksiKeluarChart->build(), 'stokKurang' => $stokKurang, 'activeMenu' => $activeMenu]);
    }
}
