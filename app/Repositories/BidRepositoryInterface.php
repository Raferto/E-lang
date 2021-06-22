<?php

namespace App\Repositories;

use App\Http\Requests\StoreBid;

interface BidRepositoryInterface
{
    public function getAll();

    public function create(StoreBid $request);
}
