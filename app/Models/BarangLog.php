<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangLog extends Model
{
    use HasFactory;

    protected $table = 'barang_log';

    protected $fillable = [
        'admin_id', 'barang_id', 'aksi'
    ];
}
