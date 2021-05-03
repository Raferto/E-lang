<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PenawaranBarang;

class BidController extends Controller
{
    public function index() {
        $penawaran_barangs = PenawaranBarang::paginate(5);

        return view('bid.index')
        ->with('penawaran_barangs', $penawaran_barangs);
    }

    public function create(Request $request) {
        try {
            $penawaran_barang = new PenawaranBarang;

            $penawaran_barang->barang_id = $request->barang_id;
            $penawaran_barang->harga = $request->harga;
            $penawaran_barang->user_id = 1;
            $penawaran_barang->save();

            DB::table('barang')
            ->where('id', $request->barang_id)
            ->update(['harga_tertinggi' => $request->harga]);

            return redirect()
            ->route('bid.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
