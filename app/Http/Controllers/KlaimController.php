<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KlaimController extends Controller
{
    public function index() {
        
        // TODO: dapetin user id yang sekarang lagi aktif
        $userID = '1';

        // TODO: dapetin penarawan meanng untuk user id, di paginate
        
        
        $penawaran_menang = DB::table('penawaran_barang');
    }

    public function show(Request $request, $id) {
        
        // TODO: dapetin penawaran sesuai request
    }

    public function create() {

        // TODO: terima pemayaran baru dari show penawaran
    }
}
