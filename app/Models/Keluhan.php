<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasFactory;

    protected $table = 'keluhan';

    protected $fillable = [
        'user_id', 'admin_id', 'subjek', 'isi_keluhan', 'status'
    ];
}
