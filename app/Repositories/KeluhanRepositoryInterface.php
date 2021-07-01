<?php

namespace App\Repositories;

use App\Http\Requests\StoreBid;
use Illuminate\Http\Request;

interface KeluhanRepositoryInterface
{
    public function create(Request $request);

    public function sendMailAck($keluhan);
}
