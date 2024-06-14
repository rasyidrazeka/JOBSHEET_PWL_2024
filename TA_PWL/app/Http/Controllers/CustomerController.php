<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Pelanggan',
            'list' => ['Home', 'Pelanggan']
        ];
        $page = (object)[
            'title' => 'Berikut ini merupakan data pelanggan yang tersedia di toko'
        ];
        $activeMenu = 'customer';
        return view('customer.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list()
    {
        $customers = CustomerModel::select('customer_id', 'nama_lengkap', 'email', 'no_hp', 'alamat'); 
        // if($request->kategori_id) {
        //     $produks->where('kategori_id', $request->kategori_id);
        // }
        return DataTables::of($customers)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($customer) { // menambahkan kolom aksi  
                $btn = '<a href="'.url('/customer/' . $customer->customer_id . '/edit').'" class="btn btn-warning btn-sm" style="color: white" id="btn-edit"><i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Edit</a> '; 
                $btn .= '<form class="d-inline-block" id="btn-hapus" method="POST" action="'. url('/customer/'.$customer->customer_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');"><i class="fa-solid fa-trash-can"></i>&nbsp;&nbsp;Hapus</button></form>'; 
            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Form Data Pelanggan',
            'list' => ['Home', 'Pelanggan', 'Tambah']
        ];

        $page = (object)[
            'title' => "Tambah data pelanggan baru"
        ];

        $activeMenu = 'customer';

        return view('customer.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|unique:customer,nama_lengkap',
            'email' => 'required|email|unique:customer,email',
            'no_hp' => 'required|string|min:11',
            'alamat' => 'required|string'
        ]);

        CustomerModel::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);

        Alert::toast('Data pelanggan berhasil ditambahkan', 'success');
        return redirect('/customer');
    }

    public function edit(string $id)
    {
        $customer = CustomerModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Data Pelanggan',
            'list' => ['Home', 'Pelanggan', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit data pelanggan'
        ];

        $activeMenu = 'customer';

        return view('customer.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'customer' => $customer, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|unique:customer,nama_lengkap,'.$id.',customer_id',
            'email' => 'required|email|unique:customer,email,'.$id.',customer_id',
            'no_hp' => 'required|string|min:11',
            'alamat' => 'required|string'
        ]);

        CustomerModel::find($id)->update([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);
        Alert::toast('Data pelanggan berhasil diubah', 'success');
        return redirect('/customer');
    }

    public function destroy(string $id)
    {
        $check = CustomerModel::find($id);
        if(!$check){
            Alert::toast('Data pelanggan tidak ditemukan', 'error');
            return redirect('/customer');
        }
        try{
            CustomerModel::destroy($id);
            Alert::toast('Data pelanggan berhasil dihapus', 'success');
            return redirect('/customer');
        }catch(\Illuminate\Database\QueryException $e){
            Alert::toast('Data pelanggan gagal dihapus', 'error');
            return redirect('/customer');
        }
    }
}
