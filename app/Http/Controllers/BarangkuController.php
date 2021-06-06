<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBarang;

use App\Interfaces\QRCodeInterface;

use Carbon\Carbon;

class BarangkuController extends Controller
{
    public function __construct(QRCodeInterface $qrcode_service) {
        $this->qrcode_service = $qrcode_service;
    }

    public function index(){
        $barang = barang::paginate(5);

        return view('barangku.index')
        ->with('barang', $barang);
    }

    public function show(Request $request, $id){
        $barang = DB::table('barang')
        ->where('id', $id)
        ->first();
        

        $qrcode = $this->qrcode_service->createQRCode(
            $barang->nama . '|' . $barang->deskripsi . '|' . $barang->harga_awal . '|' . $barang->lelang_start . $barang->lelang_finished . '|' . $barang->status
        );

        return view('barangku.show')
        ->with('barang', $barang)
        ->with('qrcode', $qrcode);
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
            $content = file_get_contents($photo->getRealPath());
            $photo_ext = $photo->getClientOriginalExtension();
            $file_name = Auth::id() . ((string) Str::uuid()) . '.' . $photo_ext;
            Storage::put('public/barangku/' . $file_name, $content);

            $barang->photo = asset('storage/barangku/' . $file_name);
            $barang->save();

            return redirect()
            ->route('barangku.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
