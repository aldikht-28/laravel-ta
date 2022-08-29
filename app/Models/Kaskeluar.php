<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Kaskeluar extends Model
{
    use HasFactory;

    protected $table = 'kaskeluar';
    protected $guarded = ['id'];

    public function sumberkeluar()
    {
        return $this->belongsTo(SumberKeluar::class, 'id_sumberkeluar');
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
