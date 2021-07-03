<?php

namespace App\Repositories;

use App\Http\Requests\Search;
use Illuminate\Http\Request;

interface SearchRepositoryInterface
{
    public function index();

    public function kategory();

    public function search(Search $request);

    public function show(Request $request, $id);

    public function showAPI(Request $request);

    public function logVerifikasiAccount($id, $action);

    public function getLogVerifikasiAccount();
}
