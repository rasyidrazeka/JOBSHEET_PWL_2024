<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'barang_id';

    protected $fillable = ['barang_kode', 'barang_nama', 'merk', 'spesifikasi', 'volume', 'satuan','harga_satuan'];
}
