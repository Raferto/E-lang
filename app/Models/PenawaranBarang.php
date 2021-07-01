<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranBarang extends Model
{
    use HasFactory;
    protected $table = 'penawaran_barang';

    public function barang() {
        return $this->hasOne(Barang::class, 'id', 'barang_id');
    }

    public function harga_rupiah() {
        return "Rp " . number_format($this->harga,2,',','.');
    }
}
