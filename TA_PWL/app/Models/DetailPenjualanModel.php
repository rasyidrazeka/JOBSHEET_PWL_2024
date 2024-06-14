<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPenjualanModel extends Model
{
    use HasFactory;
    protected $table = 'detail_penjualan';
    protected $primaryKey = 'detail_penjualan_id';

    protected $fillable = ['penjualan_id', 'produk_id', 'jumlah', 'harga'];

    public function penjualan():BelongsTo{
        return $this->belongsTo(PenjualanModel::class, 'penjualan_id', 'penjualan_id');
    }
    public function produk():BelongsTo{
        return $this->belongsTo(ProdukModel::class, 'produk_id', 'produk_id');
    }
}
