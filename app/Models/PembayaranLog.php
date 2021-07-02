<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranLog extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_log';

    protected $fillable = [
        'nama_user', 'nama_admin', 'nama_barang', 'aksi'
    ];
}
