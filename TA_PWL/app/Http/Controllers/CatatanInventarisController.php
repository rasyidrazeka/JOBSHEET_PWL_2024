<?php

namespace App\Http\Controllers;

use App\Models\CatatanInventarisModel;
use App\Models\ProdukModel;
use App\Models\TipeCatatanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class CatatanInventarisController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Inventaris',
            'list' => ['Home', 'Inventaris']
        ];
        $page = (object)[
            'title' => 'Berikut ini merupakan data inventaris yang tersedia di toko'
        ];
        $activeMenu = 'stok';
        $produk=ProdukModel::all();
        return view('stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'produk' => $produk]);
    }

    public function list(Request $request)
    {
        $stoks = CatatanInventarisModel::with('produk', 'tipe_catatan', 'user')->select('catatan_id', 'produk_id', 'perubahan_jumlah', 'tipe_catatan_id', 'user_id'); 
        if($request->produk_id) {
            $stoks->where('produk_id', $request->produk_id);
        }
        return DataTables::of($stoks)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($stok) { // menambahkan kolom aksi  
                $btn = '<form class="d-inline-block" id="btn-hapus" method="POST" action="'. url('/stok/'.$stok->catatan_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');"><i class="fa-solid fa-trash-can"></i>&nbsp;&nbsp;Hapus</button></form>'; 
            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Form Data Inventaris',
            'list' => ['Home', 'Inventaris', 'Tambah']
        ];

        $page = (object)[
            'title' => "Tambah data inventaris baru"
        ];

        $produk = ProdukModel::all();
        $tipe_catatan = TipeCatatanModel::all();
        $user = UserModel::all();
        $stok = CatatanInventarisModel::all();

        $activeMenu = 'stok';

        return view('stok.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'produk' => $produk, 'tipe_catatan' => $tipe_catatan, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|integer',
            'perubahan_jumlah' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        $stok_old = ProdukModel::find($request->produk_id)->stok;
        
        if ($request->perubahan_jumlah > 0) {
            CatatanInventarisModel::create([
                'produk_id' => $request->produk_id,
                'perubahan_jumlah' => $request->perubahan_jumlah,
                'tipe_catatan_id' => 1,
                'user_id' => $request->user_id,
            ]);

            ProdukModel::find($request->produk_id)->update([
                'stok' => $stok_old + $request->perubahan_jumlah
            ]);
    
            Alert::toast('Data produk berhasil ditambahkan', 'success');
            return redirect('/stok'); 
        }else {
            Alert::toast('Data jumlah perubahan harus lebih dari 0', 'error');
            return redirect('/stok/create'); 
        }
    }

    public function destroy(string $id)
    {
        $check = CatatanInventarisModel::find($id);
        if(!$check){
            Alert::toast('Data inventaris tidak ditemukan', 'error');
            return redirect('/stok');
        }
        try{
            $catatan_inventaris = CatatanInventarisModel::find($id);
            $id_produk = $catatan_inventaris->produk_id;
            $vol_old = ProdukModel::find($id_produk)->stok;
            ProdukModel::find($id_produk)->update([
                'stok' => $vol_old - $catatan_inventaris->perubahan_jumlah
            ]);
            CatatanInventarisModel::destroy($id);
            Alert::toast('Data inventaris berhasil dihapus', 'success');
            return redirect('/stok');
        }catch(\Illuminate\Database\QueryException $e){
            Alert::toast('Data inventaris gagal dihapus', 'error');
            return redirect('/stok');
        }
    }
}
