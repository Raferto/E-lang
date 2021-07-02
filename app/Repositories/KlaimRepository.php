<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Pembayaran;
use App\Models\PembayaranLog;

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

    public function indexAPI(Request $request) {

        $user_id_cari = $request->user();

        $penawaran_menang = DB::table('barang')
                            ->join('penawaran_barang', 'barang.penawaran_id', '=', 'penawaran_barang.id')
                            ->where('penawaran_barang.user_id', '=', $user_id_cari->id)
                            ->where('barang.lelang_finished', '<', Carbon::now())
                            ->get();

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

    public function createAPI(Request $request) {
        $user_id = $request->user()->id;

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

        $newBayar = Pembayaran::create([
            'user_id' => $user_id, // ambil dari session
            'penawaran_id' => $request->penawaran_id, // ambil dari request
            'status' => 'menunggu verifikasi', // isi status yang bener
            'bukti_pembayaran' => asset('storage/bukti_pembayaran/' . $file_name),
            'deadline' => Carbon::now()->addDays(7)->toDateTimeString(),
        ]);

        return $newBayar;

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
            'penawaran_id' => $request->penawaran_id, // ambil dari request
            'status' => 'menunggu verifikasi', // isi status yang bener
            // 'bukti_pembayaran' => asset('storage/bukti_pembayaran/' . $file_name),
            'bukti_pembayaran' => $file_name,
            'deadline' => Carbon::now()->addDays(7)->toDateTimeString(),
        ]);

    }

    public function getPembayaranBaru() {

        $pembayaran = DB::table('pembayaran as p')
                        ->join('penawaran_barang as pb', 'p.penawaran_id', '=', 'pb.id')
                        ->join('barang as b', 'pb.barang_id', '=', 'b.id')
                        ->join('users as u', 'p.user_id', '=', 'u.id')
                        ->where('p.status', 'menunggu verifikasi')
                        ->select('p.id as pembayaran_id', 'u.nama as nama_user', 'b.nama as nama_barang', 'pb.harga as harga', 'p.created_at as tgl_submit', 'p.bukti_pembayaran')
                        ->paginate(10);

        return $pembayaran;
    }

    public function logVerifikasiPebayaran($id, $action) {

        $pembayaran = DB::table('pembayaran as p')
                        ->join('penawaran_barang as pb', 'p.penawaran_id', '=', 'pb.id')
                        ->join('barang as b', 'pb.barang_id', '=', 'b.id')
                        ->join('users as u', 'p.user_id', '=', 'u.id')
                        ->join('admin as a', 'a.id', '=', 'p.admin_id')
                        ->where('p.id', $id)
                        ->select('a.nama as nama_admin', 'u.nama as nama_user', 'b.nama as nama_barang')
                        ->first();

        PembayaranLog::create([
            'nama_user' => $pembayaran->nama_user,
            'nama_admin' => $pembayaran->nama_admin,
            'nama_barang' => $pembayaran->nama_barang,
            'aksi'  => $action
        ]);
    }
}
