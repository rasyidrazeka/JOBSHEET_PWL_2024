<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiMasukModel extends Model
{
    use HasFactory;

    protected $table = 'transaksi_masuk';
    protected $primaryKey = 'transaksiMasuk_id';

    protected $fillable = ['kode_transaksiMasuk', 'barang_id', 'qty', 'gambar', 'tanggal_diterima'];

    public function barang():BelongsTo{
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }
}
