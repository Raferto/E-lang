<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Repositories\SearchRepositoryInterface;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    private $SearchRepo;

    public function __construct(SearchRepositoryInterface $SearchRepo)
    {
        $this->SearchRepo = $SearchRepo;
    }

    public function index()
    {
        $barangs = Barang::getActiveBarang();

        if (count($barangs) > 4) {
            $barangs_temp = [];

            for ($i = 0; $i < 4; $i++) {
                $barangs_temp[] = $barangs[$i];
            }

            $barangs = $barangs_temp;
        }

        return view('home')
            ->with('barangs', $barangs);
    }
}
