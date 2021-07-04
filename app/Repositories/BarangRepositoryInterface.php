<?php

namespace App\Repositories;

use App\Http\Requests\StoreBarang;

interface BarangRepositoryInterface
{
    public function getAllBarangku();

    public function getBarangku($id);

    public function create(StoreBarang $request);

    public function logVerifikasiBarang($id, $action);

    public function getLogVerifikasiBarang();
}
