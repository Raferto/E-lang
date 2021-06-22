<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\PenawaranBarang;
use App\Http\Requests\StoreBid;
use Carbon\Carbon;

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
        $barang = DB::table('barang')
        ->find($barang_id);

        if ((!$penawaran_barang && $harga >= $barang->harga_awal) || $penawaran_barang->harga < $harga) return true;

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
            ->update([
                'harga_awal' => $request->harga,
                'penawaran_id' => $penawaran_barang->id
            ]);

            return redirect()
            ->route('bid.index');
        } catch (\Exception $e) {
            return \redirect()
            ->back()
            ->withErrors(['msg' => $e->getMessage()]);;
        }
    }
}
