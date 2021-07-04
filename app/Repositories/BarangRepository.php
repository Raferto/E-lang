<?php
namespace App\Repositories;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\BarangLog;
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

        $kategori = DB::table('kategori')
                    ->select('nama')
                    ->join('termasuk', 'termasuk.kategori_id', '=', 'kategori.id')
                    ->where('termasuk.barang_id',$id)
                    ->get();

        return array( $barang, $this->arrayToString($kategori) );
    }

    public function arrayToString(object $a ){
        $size = count($a);
        
        if($size == 0)
            return "";

        if($size == 1)
            return $a[0]->nama;
            
        $string = "";
        foreach(  $a as $item){
            $string = $string . $item->nama . ", ";
        }
        
        return substr($string, 0, -2);

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

            if( $request->kategori != null)
                $this->kategoriInsertHelper($request->kategori, $barang->id);

            return $barang;

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function kategoriInsertHelper(String $kategoriString, int $barang_id){
        $list = explode(',', $kategoriString);
        foreach( $list as $i ){
            $nama = trim($i);
            if($nama == "")
                continue;

            $kategori = Kategori::updateOrCreate( [ 'nama' => $nama]);
            
            DB::table('termasuk')
                ->insert([ 'barang_id'=> $barang_id, 'kategori_id' => $kategori->id]);
        }
    }

    public function logVerifikasiBarang($id, $action)
    {
        $admin_id = Auth::user()->id;
        
        // $barang = DB::table('Barang')
        //     ->update(['admin_id' => $admin_id])
        //     ->where('id', $id)
        //     ->first();

        BarangLog::create([
            'barang_id' => $id,
            'admin_id' => $admin_id,
            'aksi'  => $action
        ]);
    }

    public function getLogVerifikasiBarang()
    {

        return BarangLog::orderBy('created_at', 'desc')->paginate(15);
    }

}
