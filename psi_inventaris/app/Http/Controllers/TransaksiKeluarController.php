<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\TransaksiKeluarModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class TransaksiKeluarController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Transaksi Keluar',
            'list' => ['Home', 'Transaksi Keluar']
        ];
        $page = (object)[
            'title' => 'Berikut ini merupakan data transaksi keluar dari sistem informasi inventaris BHP JTI POLINEMA'
        ];
        $activeMenu = 'transaksiKeluar';
        $barang = BarangModel::all();
        return view('transaksiKeluar.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $transaksiKeluars = TransaksiKeluarModel::select('transaksiKeluar_id', 'barang_id', 'qty', 'tanggal_keluar')->with('barang'); 
        if($request->barang_id) {
            $transaksiKeluars->where('barang_id', $request->barang_id);
        }
        return DataTables::of($transaksiKeluars) 
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($transaksi_keluar) { // menambahkan kolom aksi  
                if (auth()->user()->level_id==1) {
                    $btn = '<a href="'.url('/transaksiKeluar/' . $transaksi_keluar->transaksiKeluar_id).'" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;Detail</a> '; 
                    $btn .= '<a href="'.url('/transaksiKeluar/' . $transaksi_keluar->transaksiKeluar_id . '/edit').'" class="btn btn-warning btn-sm" style="color: white"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Edit</a> '; 
                    $btn .= '<form class="d-inline-block" method="POST" action="'. url('/transaksiKeluar/'.$transaksi_keluar->transaksiKeluar_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');"><i class="fa-solid fa-trash-can"></i>&nbsp;&nbsp;Hapus</button></form>'; 
                }elseif (auth()->user()->level_id==2) {
                    $btn = '<a href="'.url('/transaksiKeluar/' . $transaksi_keluar->transaksiKeluar_id).'" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;Detail</a> '; 
                }
            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Formulir Data Transaksi Keluar',
            'list' => ['Home', 'Transaksi Keluar', 'Create']
        ];

        $page = (object)[
            'title' => "Tambah data transaksi masuk dari sistem informasi inventaris BHP JTI POLINEMA"
        ];

        $barang = BarangModel::all();

        $activeMenu = 'transaksiKeluar';

        return view('transaksiKeluar.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksiKeluar' => 'required|string|min:3|unique:transaksi_keluar,kode_transaksiKeluar',
            'barang_id' => 'required|integer',
            'qty' => 'required|integer',
            'tanggal_keluar' => 'required'
        ]);
        
        $volume = $request->qty;
        $id_barang = $request->barang_id;
        $vol_old = BarangModel::find($id_barang)->volume;
        // $volume_old = $request->barang->volume;

        if (BarangModel::find($id_barang)->volume<$volume) {
            Alert::toast('Data transaksi keluar gagal ditambahkan karena stok kurang', 'error');
            return redirect('/transaksiKeluar')->with('error', 'Data transaksi keluar gagal ditambah dikarenakan stok barang kurang');
        }
        else {
            TransaksiKeluarModel::create([
                'kode_transaksiKeluar' => $request->kode_transaksiKeluar,
                'barang_id' => $id_barang,
                'qty' => $volume,
                'tanggal_keluar' => $request->tanggal_keluar
            ]);
    
            BarangModel::find($id_barang)->update([
                'volume' => $vol_old-$volume
            ]);
            Alert::toast('Data transaksi keluar berhasil ditambahkan', 'success');
            return redirect('/transaksiKeluar');
        }
    }

    public function show(string $id){
        $transaksi_keluar = TransaksiKeluarModel::with('barang')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Transaksi Keluar',
            'list' =>['Home', 'Transaksi Keluar', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail transaksi keluar'
        ];

        $activeMenu = 'transaksiKeluar';

        return view('transaksiKeluar.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'transaksi_keluar' => $transaksi_keluar, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $transaksi_keluar = TransaksiKeluarModel::find($id);

        $barang = BarangModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Transaksi Keluar',
            'list' => ['Home', 'Transaksi Keluar', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit transaksi keluar'
        ];

        $activeMenu = 'transaksiKeluar';

        return view('transaksiKeluar.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'transaksi_keluar' => $transaksi_keluar, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_transaksiKeluar' => 'required|string|min:3|unique:transaksi_keluar,kode_transaksiKeluar,'.$id.',transaksiKeluar_id',
            'barang_id' => 'required|integer',
            'qty' => 'required|integer',
            'tanggal_keluar' => 'required'
        ]);
        $transaksi_keluar = TransaksiKeluarModel::find($id);

        $volume = $request->qty;
        $id_barang = $request->barang_id;
        $vol_old = BarangModel::find($id_barang)->volume;
        $vol_old_transaksi = TransaksiKeluarModel::find($id)->qty;
        $total_volume = $vol_old_transaksi+$vol_old;

        if ($total_volume >= $volume ) {
            $transaksi_keluar->update([
                'kode_transaksiKeluar' => $request->kode_transaksiKeluar,
                'barang_id' => $id_barang,
                'qty' => $volume,
                'tanggal_keluar' => $request->tanggal_keluar
            ]);

            if ($vol_old_transaksi<$volume) {
                BarangModel::find($id_barang)->update([
                    $sisa_volume = $vol_old_transaksi-$volume,
                    'volume' => $vol_old+$sisa_volume
                ]);
            }elseif ($vol_old_transaksi>$volume) {
                BarangModel::find($id_barang)->update([
                    $sisa_volume = $total_volume-$volume,
                    'volume' => $total_volume-$sisa_volume
                ]);
            }
            Alert::toast('Data transaksi keluar berhasil diubah', 'success');
            return redirect('/transaksiKeluar');
        }else {
            Alert::toast('Data transaksi keluar gagal diubah dikarenakan stok barang kurang', 'error');
            return redirect('/transaksiKeluar');
        }

        // TransaksiMasukModel::find($id)->update([
        //     'username' => $request->username,
        //     'nama' => $request->nama,
        //     'nik' => $request->nik,
        //     'jabatan' => $request->jabatan,
        //     'password' => $request->password ? bcrypt($request->password) : AdministrasiModel::find($id)->password,
        //     'level_id' => $request->level_id
        // ]);

        // return redirect('/administrasi')->with('success', 'Data administrasi berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = TransaksiKeluarModel::find($id);
        if(!$check){
            Alert::toast('Data transaksi keluar tidak ditemukan', 'error');
            return redirect('/transaksiKeluar');
        }
        try{
            $volume = TransaksiKeluarModel::find($id)->qty;
            $id_barang = TransaksiKeluarModel::find($id)->barang_id;
            $vol_old = BarangModel::find($id_barang)->volume;
            BarangModel::find($id_barang)->update([
                'volume' => $vol_old+$volume
            ]);
            TransaksiKeluarModel::destroy($id);
            Alert::toast('Data transaksi keluar berhasil dihapus', 'success');
            return redirect('/transaksiKeluar');
        }catch(\Illuminate\Database\QueryException $e){
            Alert::toast('Data transaksi keluar gagal dihapus', 'error');
            return redirect('/transaksiKeluar');
        }
    }
}
