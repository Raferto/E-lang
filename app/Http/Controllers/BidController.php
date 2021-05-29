<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\PenawaranBarang;
use App\Http\Requests\StoreBid;

class BidController extends Controller
{
    public function index() {
        $penawaran_barangs = PenawaranBarang::paginate(5);

        return view('bid.index')
        ->with('penawaran_barangs', $penawaran_barangs);
    }

    private function checkIfBidIsBigger($barang_id, $harga) {
        $penawaran_barang = PenawaranBarang::where('barang_id', $barang_id)
        ->orderBy('harga', 'DESC')
        ->first();

        if (!$penawaran_barang || $penawaran_barang->harga < $harga) return true;

        return false;
    }

    public function create(StoreBid $request) {
        try {
            if (!$this->checkIfBidIsBigger($request->barang_id, $request->harga))
                throw new \Exception("Harga Lebih Rendah atau Sama dari Penawaran Sebelumnya", 1);

            $penawaran_barang = PenawaranBarang::where('barang_id', $request->barang_id)
            ->where('user_id', Auth::id())
            ->first();

            if (!$penawaran_barang) $penawaran_barang = new PenawaranBarang;

            $penawaran_barang->barang_id = $request->barang_id;
            $penawaran_barang->harga = $request->harga;
            $penawaran_barang->user_id = Auth::id();
            $penawaran_barang->save();

            DB::table('barang')
            ->where('id', $request->barang_id)
            ->update(['harga_awal' => $request->harga]);

            return redirect()
            ->route('bid.index');
        } catch (\Exception $e) {
            return \redirect()
            ->back()
            ->withErrors(['msg' => $e->getMessage()]);;
        }
    }
}
