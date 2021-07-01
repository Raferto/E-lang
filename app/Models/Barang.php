<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public static function getActiveBarang() {
        $now = Carbon::now();

        return Barang::where('lelang_start', '<', $now)
        ->where('lelang_finished', '>', $now)
        ->where('status', 'verified')
        ->get();
    }

}
