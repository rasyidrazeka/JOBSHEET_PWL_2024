<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatatanInventarisModel extends Model
{
    use HasFactory;
    protected $table = 'catatan_inventaris';
    protected $primaryKey = 'catatan_id';

    protected $fillable = ['produk_id', 'perubahan_jumlah', 'tipe_catatan_id', 'user_id'];

    public function produk():BelongsTo{
        return $this->belongsTo(ProdukModel::class, 'produk_id', 'produk_id');
    }
    public function tipe_catatan():BelongsTo{
        return $this->belongsTo(TipeCatatanModel::class, 'tipe_catatan_id', 'tipe_catatan_id');
    }
    public function user():BelongsTo{
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}
