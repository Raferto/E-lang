<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBarang;

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

        public function create(StoreBarang $request){
        try {
            $user_id = Auth::user()->id;
            
            $input = $request->all();

            $barang = new Barang;

            $barang->nama = $request->nama;
            $barang->harga_awal = $request->harga_awal;
            $barang->deskripsi = $request->deskripsi;
            $barang->lelang_start = $request->lelang_start;
            $barang->lelang_finished = $request->lelang_finished;
            $barang->user_id = $user_id;

            // photo process
            $photo = $request->file('photo');
            $photo_ext = $photo->getClientOriginalExtension();
            $target_name = 'barang_' . $user_id . '_' . ((string) Str::uuid()) . '.' . $photo_ext;
            $photo->move('data_files/photo_barang', $target_name);

            $barang->photo = $target_name;
            $barang->save();

            return redirect()
            ->route('barangku.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
