<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Kasmasuk extends Model
{
    use HasFactory;

    protected $table = 'kasmasuk';
    // protected $fillable = ['jumlah', 'tanggal', 'deskripsi', 'id_sumbermasuk'];
    protected $guarded = ['id'];

    public function sumbermasuk()
    {
        return $this->belongsTo(SumberMasuk::class, 'id_sumbermasuk');
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function scopeSearch($query, $name)
    {
        return $query->where('name', 'LIKE', "%{$name}%");
    }
}
