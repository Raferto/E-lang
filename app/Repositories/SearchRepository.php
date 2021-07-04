<?php

namespace App\Repositories;

use App\Http\Requests\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Pembayaran;
use App\Models\Barang;
use App\Models\AccountLog;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class SearchRepository implements SearchRepositoryInterface
{
    public function index()
    {

        //get barang lelang yg tersedia
        $barangs = DB::table('barang')
            ->where('lelang_start', '<', Carbon::now())
            ->where('lelang_finished', '>', Carbon::now())
            ->where('status', 'verified')
            ->leftJoin('termasuk', 'barang.id', '=', 'termasuk.barang_id')
            ->leftJoin('kategori', 'kategori.id', '=', 'termasuk.barang_id')
            ->select('barang.*', 'kategori.nama as kategori')
            ->paginate(5);

        // dd($penawaran_menang);
        // dd($barangs);
        return $barangs;
    }

    public function kategory()
    {

        //get barang lelang yg tersedia
        $kategoris = DB::table('kategori')
            ->get();

        // dd($penawaran_menang);

        return $kategoris;
    }

    public function search(Search $request)
    {

        // dd($request->search, $request->kategori, count($request->kategori));

        $kategori = $request->kategori;

        // dd($kategori);
        if ($kategori == null) {
            $barangs = DB::table('barang')
                ->where('barang.nama', 'like', "%" . $request->search . "%")
                ->where('lelang_start', '<', Carbon::now())
                ->where('lelang_finished', '>', Carbon::now())
                ->paginate(5);
        } else {
            $barangs = DB::table('barang')
                ->where('barang.nama', 'like', "%" . $request->search . "%")
                ->where('lelang_start', '<', Carbon::now())
                ->where('lelang_finished', '>', Carbon::now())
                ->join('termasuk', 'barang.id', '=', 'termasuk.barang_id')
                ->join('kategori', 'kategori.id', '=', 'termasuk.barang_id')
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('termasuk')
                        ->from('kategori')
                        ->whereRaw('barang.id = termasuk.barang_id')
                        ->whereRaw('kategori.id = termasuk.barang_id');
                })
                ->whereIn('kategori.nama', $kategori)
                ->select('barang.*', 'kategori.nama as kategori')
                // ->wherein('kategori', $kategori)
                ->paginate(5);
        }

        // dd($barangs);
        return $barangs;
    }

    public function show(Request $request, $id)
    {

        // dapetin barang sesuai
        $barang = Barang::where('id', $id)
            ->first();

        return $barang;
    }

    public function showAPI(Request $request)
    {

        // dapetin barang sesuai
        $barang = DB::table('barang')
            ->where('id', $request->id)
            ->first();

        return $barang;
    }

    public function logVerifikasiAccount($id, $action)
    {

        $pembayaran = DB::table('users as u')
            ->join('admin as a', 'a.id', '=', 'u.admin_id')
            ->where('u.id', $id)
            ->select('a.nama as nama_admin', 'u.nama as nama_user')
            ->first();

        AccountLog::create([
            'nama_user' => $pembayaran->nama_user,
            'nama_admin' => $pembayaran->nama_admin,
            'aksi'  => $action
        ]);
    }

    public function getLogVerifikasiAccount()
    {

        return AccountLog::orderBy('created_at', 'desc')->paginate(15);
    }
}
