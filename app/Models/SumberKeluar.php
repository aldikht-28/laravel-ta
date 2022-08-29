<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberKeluar extends Model
{
    use HasFactory;

    protected $table = 'sumberkeluar';
    protected $guarded = ['id'];

    public function kaskeluar()
    {
        return $this->hasMany(Kaskeluar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
