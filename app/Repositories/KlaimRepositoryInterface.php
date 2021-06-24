<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface KlaimRepositoryInterface
{
    public function index();

    public function getPenawaran($id);

    public function getPembayaran($id);

    public function create(Request $request);
}
