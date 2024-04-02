<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        // $data = ['kategori_kode' => 'SMK', 'kategori_nama' => 'Snack/Makanan Ringan', 'created_at' => now()];
        // DB::table('m_kategori')->insert($data);
        // return 'Insert data baru berhasil';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SMK')->update(['kategori_nama' => 'Camilan']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' Baris';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SMK')->delete();
        // return 'Delete data berhasil. Jumlah data yang dihapus ' . $row . ' baris';

        // $data = DB::table('m_kategori')->get();
        // return view('kategori', ['data'=>$data]);

        return $dataTable->render('kategori.index');
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request){
        KategoriModel::create(['kategori_kode'=>$request->kodeKategori, 'kategori_nama'=>$request->namaKategori]);
        return redirect('/kategori');
    }

    public function edit($id){
        $data = KategoriModel::find($id);
        return view('kategori.edit', ['data'=>$data]);
    }
}
