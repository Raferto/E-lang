<?php

namespace App\Http\Controllers;

use App\Http\Requests\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PelelanganController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $barangs = DB::table('barang')
            ->where('lelang_start', '<', $now)
            ->where('lelang_finished', '>', $now)
            ->paginate(5);

        return view('lelang.index')
            ->with('barangs', $barangs);
    }

    public function search(Search $request)
    {
        $search = $request->search;
        $now = Carbon::now();
        $barangs = DB::table('barang')
            ->where('nama', 'like', "%" . $search . "%")
            // ->where('lelang_finished', '>', $now)
            ->paginate(5);

        return view('lelang.index')
            ->with('barangs', $barangs)
            ->with('katkun', $search);
    }

    public function show(Request $request, $id)
    {
        $barang = DB::table('barang')
            ->where('id', $id)
            ->first();

        return view('lelang.show')
            ->with('barang', $barang);
    }
}
