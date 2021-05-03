<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = "barang";

    protected $fillable = [
        'id',
        'nama',
        'harga_awal',
        'photo',
        'deskripsi',
        'lelang_start',
        'lelang_finished',
        'user_id',
        'admin_id',
        'status'
    ];

    public function barang() {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }

}
