<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Pembayaran;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class KlaimController extends Controller
{
    public function index() {

        // dapetin user id yang sekarang lagi aktif
        $user_id_cari = Auth::user()->id;

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

        // query baru
        $penawaran_menang = DB::table('barang')
                            ->join('penawaran_barang', 'barang.penawaran_id', '=', 'penawaran_barang.id')
                            ->where('penawaran_barang.user_id', '=', $user_id_cari)
                            ->paginate(5);

        // dd($penawaran_menang);

        return view('klaim.index')
                ->with('penawarans', $penawaran_menang);

    }

    public function show(Request $request, $id) {

        // dapetin penawaran sesuai request
        $penawaran = DB::table('penawaran_barang')
                        ->select('penawaran_barang.id as id', 'penawaran_barang.barang_id', 'penawaran_barang.user_id', 'penawaran_barang.harga', 'barang.nama', 'barang.photo','barang.deskripsi', 'barang.status', 'barang.lelang_start', 'barang.lelang_finished')
                        ->join('barang', 'penawaran_barang.barang_id', '=', 'barang.id')
                        ->where('penawaran_barang.id', $id)
                        ->first();

        $pembayaran = DB::table('pembayaran')
                        ->where('penawaran_id', $id)
                        ->first();

        // dd($penawaran);
        return view('klaim.show')
                ->with('penawaran', $penawaran)
                ->with('pembayaran', $pembayaran);
    }

    public function create(Request $request) {


        $user_id = Auth::user()->id;

        //validasi data pembayaran
        $this->validate($request, [
            'bukti_pembayaran' => 'required',
            'penawaran_id' => 'required'
        ]);

        //proses gambar
        $bukti = $request->file('bukti_pembayaran');
        $bukti_ext = $bukti->getClientOriginalExtension();
        $target_name = 'bukti-bayar_' . '[user_id]_' . '[barang_id]_' . 'tanggal_.' . $bukti_ext; // ganti sesuai dibutuhin
        $target_path = 'data_files/bukti_pembayaran';
        $bukti->move($target_path, $target_name);

        //buat row baru


        // ! status
        // belum dibayar
        // menunggu verifikasi
        // sudah dibayar
        // ditolak

        try {
            Pembayaran::create([
                'user_id' => $user_id, // ambil dari session
                'penawaran_id' => '1', // ambil dari request
                'status' => 'menunggu verifikasi', // isi status yang bener
                'bukti_pembayaran' => $target_name,
                'deadline' => Carbon::now()->addDays(7)->toDateTimeString(),
            ]);

            return redirect()->back();


        }catch(\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            if ($errorCode == 1062) {
                return redirect('/');
            }

            dd($errorMsg);
        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }
}
