<?php
namespace App\Repositories;

use App\Http\Requests\StoreBid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\PenawaranBarang;
use App\Models\User;
use Carbon\Carbon;

class BidRepository implements BidRepositoryInterface
{
    public function getAll() {
        return PenawaranBarang::where('user_id', Auth::id())
        ->paginate(5);
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

        $penawaran_barang = new PenawaranBarang;
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


        $user = Auth::user();
        $barang = DB::table('barang')->where('id', $request->barang_id)->first();

        // dd($user->email, $barang->nama, $penawaran_barang->harga);
        \Mail::to($user->email)->send(new \App\Mail\BidMail($user, $barang, $penawaran_barang));
    }

    public function getByBarang($barang_id) {
        return PenawaranBarang::where('barang_id', $barang_id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
    }

}
