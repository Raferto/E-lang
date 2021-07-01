<?php

namespace App\Repositories;

use App\Http\Requests\StoreBid;
use Illuminate\Http\Request;

interface KeluhanRepositoryInterface
{
    public function showForm();

    public function create(Request $request);
}
