<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdukModel extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'produk_id';

    protected $fillable = ['nama_produk', 'kategori_id', 'deskripsi', 'harga', 'stok'];

    public function kategori():BelongsTo{
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }
}
