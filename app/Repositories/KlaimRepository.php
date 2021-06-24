<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Pembayaran;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class KlaimRepository implements KlaimRepositoryInterface
{
    public function index() {

        // query lama
        // $win_penararan = DB::table('penawaran_barang')
        //                     ->select('barang_id', 'user_id', DB::raw('max(harga) as max_harga'))
        //                     ->groupBy('barang_id');

        // $penawaran_menang = DB::table('penawaran_barang')->select('penawaran_barang.id as id', 'penawaran_barang.barang_id', 'penawaran_barang.user_id', 'penawaran_barang.harga', 'barang.nama', 'barang.photo','barang.deskripsi', 'barang.status', 'barang.lelang_start', 'barang.lelang_finished')
        //                 ->joinSub($win_penararan, 'tmp', function($join) {
        //                     $join->on('penawaran_barang.barang_id', '=', 'tmp.barang_id');
        //                     $join->on('penawaran_barang.harga', '=', 'tmp.max_harga');
        //                 })
        //                 ->join('barang', 'penawaran_barang.barang_id', '=', 'barang.id')
        //                 ->where('penawaran_barang.user_id', '=', $user_id_cari)
        //                 ->get();

        // dapetin user id yang sekarang lagi aktif
        $user_id_cari = Auth::user()->id;

        $penawaran_menang = DB::table('barang')
                            ->join('penawaran_barang', 'barang.penawaran_id', '=', 'penawaran_barang.id')
                            ->where('penawaran_barang.user_id', '=', $user_id_cari)
                            ->where('barang.lelang_finished', '<', Carbon::now())
                            ->paginate(5);

        // dd($penawaran_menang);

        return $penawaran_menang;
    }

    public function getPenawaran($id) {

        // dapetin penawaran sesuai request
        $penawaran = DB::table('penawaran_barang')
                        ->select('penawaran_barang.id as id', 'penawaran_barang.barang_id', 'penawaran_barang.user_id', 'penawaran_barang.harga', 'barang.nama', 'barang.photo','barang.deskripsi', 'barang.status', 'barang.lelang_start', 'barang.lelang_finished')
                        ->join('barang', 'penawaran_barang.barang_id', '=', 'barang.id')
                        ->where('penawaran_barang.id', $id)
                        ->first();

        return $penawaran;
    }

    public function getPembayaran($id) {

        // dapetin pembayaran sesuai id
        $pembayaran = DB::table('pembayaran')
                        ->where('penawaran_id', $id)
                        ->first();

        return $pembayaran;
    }

    public function create(Request $request) {
        $user_id = Auth::user()->id;

        //validasi data pembayaran
        $validated = $request->validate([
            'bukti_pembayaran' => 'required',
            'penawaran_id' => 'required'
        ]);

        // photo process
        $photo = $request->file('bukti_pembayaran');
        $content = file_get_contents($photo->getRealPath());
        $photo_ext = $photo->getClientOriginalExtension();
        $file_name = Auth::id() . ((string) Str::uuid()) . '.' . $photo_ext;
        Storage::put('public/bukti_pembayaran/' . $file_name, $content);

        //buat row baru


        // ! status
        // belum dibayar
        // menunggu verifikasi
        // sudah dibayar
        // ditolak

        Pembayaran::create([
            'user_id' => $user_id, // ambil dari session
            'penawaran_id' => '1', // ambil dari validated
            'status' => 'menunggu verifikasi', // isi status yang bener
            'bukti_pembayaran' => asset('storage/bukti_pembayaran/' . $file_name),
            'deadline' => Carbon::now()->addDays(7)->toDateTimeString(),
        ]);

    }
}