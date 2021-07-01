<?php
namespace App\Repositories;

use App\Models\Barang;
use App\Http\Requests\StoreBarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class BarangRepository implements BarangRepositoryInterface
{
    public function getAllBarangku() {
        $user_id = Auth::user()->id;

        $barang = DB::table('barang')
                    ->where('user_id', $user_id)
                    ->paginate(5);
        return $barang;
    }

    public function getBarangku($id){
        $barang = Barang::where('id', $id)
                    ->first();
        
        return $barang;
    }

    public function create(StoreBarang $request){
        try {
            $user_id = Auth::user()->id;
            
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
            $file_name = $user_id . ((string) Str::uuid()) . '.' . $photo_ext;
            Storage::put('public/barangku/' . $file_name, $content);

            $barang->photo = asset('storage/barangku/' . $file_name);
            $barang->save();

            return $barang;

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
