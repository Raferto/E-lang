<?php
namespace App\Repositories;

use App\Http\Requests\StoreBid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\PenawaranBarang;
use Carbon\Carbon;

class BidRepository implements BidRepositoryInterface
{
    public function getAll() {
        return PenawaranBarang::paginate(5);
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
    }
}
