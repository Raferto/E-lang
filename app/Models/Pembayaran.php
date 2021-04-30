<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = "pembayaran";

    protected $fillable = [
        'user_id',
        'penawaran_id',
        'status',
        'bukti_pembayaran',
        'deadline_pembayaran'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
