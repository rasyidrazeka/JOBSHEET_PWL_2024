<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Authenticatable
{
    use HasFactory;
    protected $table = 'user';
    protected $primaryKey = 'user_id';

    protected $fillable = ['username', 'password', 'nama_lengkap', 'email', 'no_hp', 'level_id'];

    public function level():BelongsTo{
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}
