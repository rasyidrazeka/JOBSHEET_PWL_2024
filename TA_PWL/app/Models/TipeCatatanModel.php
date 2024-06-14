<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeCatatanModel extends Model
{
    use HasFactory;
    protected $table = 'tipe_catatan';
    protected $primaryKey = 'tipe_catatan_id';

    protected $fillable = ['nama_tipe'];
}
