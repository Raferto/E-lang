<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $barangs = Barang::getActiveBarang(); 
        
        if (count($barangs) > 4) {
            $barangs_temp = [];

            for ($i=0; $i < 4; $i++) { 
                $barangs_temp[] = $barangs[$i];
            }

            $barangs = $barangs_temp;
        }

        return view('home')
        ->with('barangs', $barangs);
    }
}
