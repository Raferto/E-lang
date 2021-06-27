<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Repositories\SearchRepositoryInterface;

class SearchAPIController extends Controller
{
    private $SearchRepo;

    public function __construct(SearchRepositoryInterface $SearchRepo)
    {
        $this->SearchRepo = $SearchRepo;
    }

    public function index(Request $request)
    {

        // dd($request);
        // ambil data menggunakan repository
        $barangs = $this->SearchRepo->index();

        // dd($penawaran_menang);

        return response()
            ->json([
                'success' => true,
                'data' => $barangs
            ], 200);
    }

    public function show(Request $request)
    {

        // dapetin barang menggunakan repository
        $barang = $this->SearchRepo->showAPI($request);

        return response()
            ->json([
                'success' => true,
                'data' => $barang
            ], 200);
    }

    public function search(Search $request)
    {

        // dapetin barang menggunakan repository
        $barangs = $this->SearchRepo->search($request);
        // dd($barangs);
        return response()
            ->json([
                'success' => true,
                'data' => $barangs
            ], 200);
    }
}
