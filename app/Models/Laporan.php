<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMasuk extends Model
{
    use HasFactory;

    protected $table = ['kasmasuk'];
}
class LaporanKeluar extends Model
{
    use HasFactory;

    protected $table = ['kaskeluar'];
}
