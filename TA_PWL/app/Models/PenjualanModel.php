<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenjualanModel extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $primaryKey = 'penjualan_id';

    protected $fillable = ['user_id', 'customer_id', 'jumlah_total', 'metode_pembayaran_id'];

    public function user():BelongsTo{
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
    public function customer():BelongsTo{
        return $this->belongsTo(CustomerModel::class, 'customer_id', 'customer_id');
    }
    public function metode_pembayaran():BelongsTo{
        return $this->belongsTo(MetodePembayaranModel::class, 'metode_pembayaran_id', 'metode_pembayaran_id');
    }
}
