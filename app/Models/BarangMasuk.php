<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaksi',
        'tanggal',
        'qty',
        'total',
        'barang_id',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}