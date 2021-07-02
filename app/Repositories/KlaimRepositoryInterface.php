<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface KlaimRepositoryInterface
{
    public function index();

    public function indexAPI(Request $request);

    public function getPenawaran($id);

    public function getPembayaran($id);

    public function createAPI(Request $request);

    public function create(Request $request);

    public function getPembayaranBaru();

    public function logVerifikasiPebayaran($id, $action);
}
