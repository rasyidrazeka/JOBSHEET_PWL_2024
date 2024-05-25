<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\TransaksiKeluarModel;
use App\Models\TransaksiMasukModel;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Pelaporan Bulanan',
            'list' => ['Home', 'Pelaporan Bulanan']
        ];

        $page = (object)[
            'title' => 'Berikut ini merupakan data pelaporan bulanan dari sistem informasi inventaris BHP JTI POLINEMA'
        ];

        $activeMenu = 'pelaporan';

        $notifBarang = BarangModel::all();

        $stokKurang = BarangModel::where('volume', '<=', 5)->get();

        return view('pelaporan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'notifBarang' => $notifBarang, 'stokKurang' => $stokKurang, 'activeMenu' => $activeMenu]);
    }

    public function filter(Request $request){
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $transaksiMasuk = TransaksiMasukModel::whereYear('tanggal_diterima', $tahun)
            ->whereMonth('tanggal_diterima', $bulan)
            ->with('barang')
            ->get();

        $transaksiKeluar = TransaksiKeluarModel::whereYear('tanggal_keluar', $tahun)
            ->whereMonth('tanggal_keluar', $bulan)
            ->with('barang')
            ->get();

        $barang = BarangModel::all();

        $laporan = [];

        foreach ($barang as $item) {
            $masuk = $transaksiMasuk->where('barang_id', $item->barang_id)->sum('qty');
            $keluar = $transaksiKeluar->where('barang_id', $item->barang_id)->sum('qty');
            $sisa = $item->volume;
            $totalHarga = ($masuk + $keluar + $sisa) * $item->harga_satuan;

            $laporan[] = [
                'nama_barang' => $item->barang_nama,
                'barang_masuk' => $masuk,
                'barang_keluar' => $keluar,
                'sisa_barang' => $sisa,
                'total_harga' => $totalHarga,
            ];
        }
        return response()->json([
            'data' => $laporan,
            'recordsTotal' => count($laporan),
            'recordsFiltered' => count($laporan),
        ]);
    }
}
