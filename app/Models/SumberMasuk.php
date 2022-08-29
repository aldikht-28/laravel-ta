<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberMasuk extends Model
{
    use HasFactory;

    protected $table = 'sumbermasuk';
    protected $fillable = ['nama', 'id_user'];

    public function kasmasuk()
    {
        return $this->hasMany(Kasmasuk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
