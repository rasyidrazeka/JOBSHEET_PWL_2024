<?php

namespace App\Http\Controllers;

use App\Models\TransaksiMasukModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
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

        $notifBarang = BarangModel::all();

        $barang = BarangModel::all();

        $stokKurang = BarangModel::where('volume', '<=', 5)->get();

        return view('transaksiMasuk.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stokKurang' => $stokKurang, 'notifBarang' => $notifBarang, 'barang' => $barang, 'activeMenu' => $activeMenu]);
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
                if (auth()->user()->level_id==1) {
                    $btn = '<a href="'.url('/transaksiMasuk/' . $transaksi_masuk->transaksiMasuk_id).'" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;Detail</a> '; 
                    $btn .= '<a href="'.url('/transaksiMasuk/' . $transaksi_masuk->transaksiMasuk_id . '/edit').'" class="btn btn-warning btn-sm" style="color: white"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Edit</a> '; 
                    $btn .= '<form class="d-inline-block" method="POST" action="'. url('/transaksiMasuk/'.$transaksi_masuk->transaksiMasuk_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');"><i class="fa-solid fa-trash-can"></i>&nbsp;&nbsp;Hapus</button></form>'; 
                }elseif (auth()->user()->level_id==2) {
                    $btn = '<a href="'.url('/transaksiMasuk/' . $transaksi_masuk->transaksiMasuk_id).'" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;Detail</a> '; 
                }
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
            'title' => "Tambah data transaksi masuk dari sistem informasi inventaris BHP JTI POLINEMA"
        ];

        $notifBarang = BarangModel::all();

        $barang = BarangModel::all();

        $stokKurang = BarangModel::where('volume', '<=', 5)->get();

        $activeMenu = 'transaksiMasuk';

        return view('transaksiMasuk.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stokKurang' => $stokKurang, 'notifBarang' => $notifBarang, 'barang' => $barang, 'activeMenu' => $activeMenu]);
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

        if($request->file('gambar')){
            $upGambar['gambar'] = $request->file('gambar')->store('img_barang');
        }
        
        $volume = $request->qty;
        $id_barang = $request->barang_id;
        $vol_old = BarangModel::find($id_barang)->volume;
        // $volume_old = $request->barang->volume;

        TransaksiMasukModel::create([
            'kode_transaksiMasuk' => $request->kode_transaksiMasuk,
            'barang_id' => $id_barang,
            'qty' => $volume,
            'gambar' => $upGambar['gambar'],
            'tanggal_diterima' => $request->tanggal_diterima
        ]);

        BarangModel::find($id_barang)->update([
            'volume' => $vol_old+$volume
        ]);
        Alert::toast('Data transaksi masuk berhasil ditambahkan', 'success');
        return redirect('/transaksiMasuk');
    }

    public function show(string $id){
        $transaksi_masuk = TransaksiMasukModel::with('barang')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Transaksi Masuk',
            'list' =>['Home', 'Transaksi Masuk', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail transaksi masuk'
        ];

        $activeMenu = 'transaksiMasuk';

        $notifBarang = BarangModel::all();

        $stokKurang = BarangModel::where('volume', '<=', 5)->get();

        return view('transaksiMasuk.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stokKurang' => $stokKurang, 'transaksi_masuk' => $transaksi_masuk, 'notifBarang' => $notifBarang, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $transaksi_masuk = TransaksiMasukModel::find($id);

        $notifBarang = BarangModel::all();

        $barang = BarangModel::all();

        $stokKurang = BarangModel::where('volume', '<=', 5)->get();

        $breadcrumb = (object)[
            'title' => 'Edit Transaksi Masuk',
            'list' => ['Home', 'Transaksi Masuk', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit transaksi masuk'
        ];

        $activeMenu = 'transaksiMasuk';

        return view('transaksiMasuk.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stokKurang' => $stokKurang, 'transaksi_masuk' => $transaksi_masuk, 'notifBarang' => $notifBarang, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_transaksiMasuk' => 'required|string|min:3|unique:transaksi_masuk,kode_transaksiMasuk,'.$id.',transaksiMasuk_id',
            'barang_id' => 'required|integer',
            'qty' => 'required|integer',
            'gambar' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_diterima' => 'required'
        ]);
        $transaksi_masuk = TransaksiMasukModel::find($id);

        $volume = $request->qty;
        $id_barang = $request->barang_id;
        $vol_old = BarangModel::find($id_barang)->volume;
        $vol_old_transaksi = TransaksiMasukModel::find($id)->qty;

        if ($request->file('gambar') == "") {
            $transaksi_masuk->update([
                'kode_transaksiMasuk' => $request->kode_transaksiMasuk,
                'barang_id' => $id_barang,
                'qty' => $volume,
                'tanggal_diterima' => $request->tanggal_diterima
            ]);

            if ($vol_old_transaksi<$volume) {
                BarangModel::find($id_barang)->update([
                    $sisa_volume = $vol_old_transaksi-$volume,
                    'volume' => $vol_old-$sisa_volume
                ]);
            }elseif ($vol_old_transaksi>$volume) {
                BarangModel::find($id_barang)->update([
                    $sisa_volume = $volume-$vol_old_transaksi,
                    'volume' => $vol_old+$sisa_volume
                ]);
            }
        }else {
            Storage::delete($request->oldImage);
            if($request->file('gambar')){
                $upGambar['gambar'] = $request->file('gambar')->store('img_barang');
            }

            $transaksi_masuk->update([
                'kode_transaksiMasuk' => $request->kode_transaksiMasuk,
                'barang_id' => $request->barang_id,
                'qty' => $request->qty,
                'gambar' => $upGambar['gambar'],
                'tanggal_diterima' => $request->tanggal_diterima
            ]);

            if ($vol_old_transaksi<$volume) {
                BarangModel::find($id_barang)->update([
                    $sisa_volume = $vol_old_transaksi-$volume,
                    'volume' => $vol_old-$sisa_volume
                ]);
            }elseif ($vol_old_transaksi>$volume) {
                BarangModel::find($id_barang)->update([
                    $sisa_volume = $volume-$vol_old_transaksi,
                    'volume' => $vol_old+$sisa_volume
                ]);
            }
        }

        if ($transaksi_masuk) {
            Alert::toast('Data transaksi masuk berhasil diubah', 'success');
            return redirect('/transaksiMasuk');
        }else {
            Alert::toast('Data transaksi masuk gagal diubah', 'error');
            return redirect('/transaksiMasuk');
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

    public function destroy($id)
    {
        $check = TransaksiMasukModel::find($id);
        if (!$check) {
            Alert::toast('Data transaksi masuk tidak ditemukan', 'error');
            return redirect('/transaksiMasuk');
        }
        try{
            $masuk = TransaksiMasukModel::find($id);
            $id_barang = $masuk->barang_id;
            $vol_old = BarangModel::find($id_barang)->volume;
            // dd($masuk);
            BarangModel::find($id_barang)->update([
                'volume' => $vol_old - $masuk->qty
            ]);
            Storage::delete($masuk->gambar);
            TransaksiMasukModel::destroy($id);
            Alert::toast('Data transaksi masuk berhasil dihapus', 'success');
            return redirect('/transaksiMasuk');
        }catch(\Illuminate\Database\QueryException $e){
            Alert::toast('Data transaksi masuk gagal dihapus', 'error');
            return redirect('/transaksiMasuk');
        }
        // $check = TransaksiMasukModel::find($id);
        // if(!$check){
        //     Alert::toast('Data transaksi masuk tidak ditemukan', 'error');
        //     return redirect('/transaksiMasuk');
        // }
        // try{
            
        // }catch(\Illuminate\Database\QueryException $e){
        //     Alert::toast('Data transaksi masuk gagal dihapus', 'error');
        //     return redirect('/transaksiMasuk');
        // }
    }
}
