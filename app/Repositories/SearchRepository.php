<?php

namespace App\Repositories;

use App\Http\Requests\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Pembayaran;
use App\Models\Barang;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class SearchRepository implements SearchRepositoryInterface
{
    public function index()
    {

        //get barang lelang yg tersedia
        $barangs = DB::table('barang')
            ->where('lelang_start', '<', Carbon::now())
            ->where('lelang_finished', '>', Carbon::now())
            ->paginate(5);

        // dd($penawaran_menang);

        return $barangs;
    }

    public function search(Search $request)
    {

        // dd($keyword);
        $barangs = DB::table('barang')
            ->where('nama', 'like', "%" . $request->search . "%")
            // ->where('lelang_finished', '>', $now)
            ->paginate(5);

        return $barangs;
    }

    public function show(Request $request, $id)
    {

        // dapetin barang sesuai
        $barang = Barang::
            where('id', $id)
            ->first();

        return $barang;
    }

    public function showAPI(Request $request)
    {

        // dapetin barang sesuai
        $barang = DB::table('barang')
            ->where('id', $request->id)
            ->first();

        return $barang;
    }
}
