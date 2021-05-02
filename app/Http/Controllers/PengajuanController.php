<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class PengajuanController extends Controller
{
    public function index(){
        $barang = barang::paginate(5);

        return view('barang.index')
        ->with('barang', $barang);
    }

    public function create(Request $request, $user_id){
        try {
            $barang = new Barang;

            $barang->nama = $request->barang_nama;
            $barang->harga_awal = $request->harga_awal;
            $barang->photo = $request->photo;
            $barang->deskripsi = $request->deskripsi;
            $barang->lelang_start = $request->lelang_start;
            $barang->lelang_finish = $request->lelang_finish;
            $barang->user_id = $user_id;
            $barang->save();

            return redirect()
            ->route('bid.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function show(Request $request, $id){
        $barang = DB::table('barang')
        ->where('id', $id)
        ->first();

        return view('barang.show')
        ->with('barang', $barang);
    }

}
