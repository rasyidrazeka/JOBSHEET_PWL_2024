<?php

namespace App\Http\Controllers;

use App\Models\CatatanInventarisModel;
use App\Models\CustomerModel;
use App\Models\DetailPenjualanModel;
use App\Models\MetodePembayaranModel;
use App\Models\PenjualanModel;
use App\Models\ProdukModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PenjualanController extends Controller
{
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Form Transaksi Penjualan',
            'list' => ['Home', 'Transaksi', 'Tambah']
        ];

        $page = (object)[
            'title' => "Tambah data transaksi penjualan"
        ];

        $user = UserModel::all();

        $customer = CustomerModel::all();

        $metode_pembayaran = MetodePembayaranModel::all();

        $produks = ProdukModel::all();

        $activeMenu = 'penjualan';

        return view('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'customer' => $customer, 'metode_pembayaran' => $metode_pembayaran, 'produks' => $produks, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $penjualan = PenjualanModel::create([
            'user_id' => $request->user_id,
            'customer_id' => $request->customer_id,
            'jumlah_total' => 0,
            'metode_pembayaran_id' => $request->metode_pembayaran_id
        ]);

        $jumlah_total = 0;

        foreach($request->produks as $produkData){
            $produk = ProdukModel::find($produkData['produk_id']);
            $jumlah = $produkData['jumlah'];

            if ($jumlah == 0) {
                continue;
            }
    
            $harga = $produk->harga * $jumlah;

            $detailPenjualan = DetailPenjualanModel::create([
                'penjualan_id' => $penjualan->penjualan_id,
                'produk_id' => $produk->produk_id,
                'jumlah' => $jumlah,
                'harga' => $harga
            ]);

            $jumlah_total += $harga;
            $produk->decrement('stok', $jumlah);

            $catatan_inventaris = CatatanInventarisModel::create([
                'produk_id' => $produk->produk_id,
                'perubahan_jumlah' => $jumlah,
                'tipe_catatan_id' => 2,
                'user_id' => $request->user_id
            ]);
        }

        $penjualan->update(['jumlah_total' => $jumlah_total]);

        Alert::toast('Data transaksi penjualan berhasil ditambahkan', 'success');
        return redirect('/riwayatPenjualan');
    }
}
