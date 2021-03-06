<?php

namespace App\Http\Controllers;

use App\Http\Requests\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\SearchRepositoryInterface;
use Carbon\Carbon;

class PelelanganController extends Controller
{
    private $SearchRepo;

    public function __construct(SearchRepositoryInterface $SearchRepo)
    {
        $this->SearchRepo = $SearchRepo;
    }
    public function index()
    {
        $barangs = $this->SearchRepo->index();
        $kategoris = $this->SearchRepo->kategory();
        // dd($barangs);
        return view('lelang.index')
            ->with('barangs', $barangs)
            ->with('kategoris', $kategoris);
    }

    public function search(Search $request)
    {
        $keyword = $request->search;
        // dump($keyword);
        // dump($request);
        $barangs = $this->SearchRepo->search($request);
        $kategoris = $this->SearchRepo->kategory();


        return view('lelang.index')
            ->with('barangs', $barangs)
            ->with('keyword', $keyword)
            ->with('kategoris', $kategoris);;
    }

    public function show(Request $request, $id)
    {
        $barang = $this->SearchRepo->show($request, $id);

        return view('lelang.show')
            ->with('barang', $barang);
    }
}
