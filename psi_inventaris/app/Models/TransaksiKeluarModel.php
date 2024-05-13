<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiKeluarModel extends Model
{
    use HasFactory;

    protected $table = 'transaksi_keluar';
    protected $primaryKey = 'transaksiKeluar_id';

    protected $fillable = ['kode_transaksiKeluar', 'barang_id', 'qty', 'tanggal_keluar'];

    public function barang():BelongsTo{
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }
}
