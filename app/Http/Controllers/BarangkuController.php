<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;

class BarangkuController extends Controller
{
    public function index(){
        $barang = barang::paginate(5);

        return view('barangku.index')
        ->with('barang', $barang);
    }

    public function show(Request $request, $id){
        $barang = DB::table('barang')
        ->where('id', $id)
        ->first();

        return view('barangku.show')
        ->with('barang', $barang);
    }

    public function form(){
        return view('barangku.form');
    }

    // public function create(Request $request, $user_id){
        public function create(Request $request){
            // dd($request->all());
        try {
            $barang = new Barang;

            $barang->nama = $request->nama;
            $barang->harga_awal = $request->harga_awal;
            $barang->deskripsi = $request->deskripsi;
            $barang->lelang_start = $request->lelang_start;
            $barang->lelang_finished = $request->lelang_finished;
            $barang->user_id = 1;
            $barang->status = "new";

            $photo = $request->file('photo');
            $photo_ext = $photo->getClientOriginalExtension();
            $target_name = 'photo_barang' . '[user_id]_' . '[barang_id].'. $photo_ext; // ganti sesuai dibutuhin
            $target_path = 'data_files/photo_barang';
            $photo->move($target_path, $target_name);

            $barang->photo = $target_name;
            
            $barang->save();

            return redirect()
            ->route('barangku.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
