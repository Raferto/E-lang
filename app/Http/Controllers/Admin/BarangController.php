<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\VerifBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BarangController extends Controller
{
    public function index() {
        $barangs = DB::table('barang')
        ->where('status', 'new')
        ->paginate(5);

        return view('admin.barang.index')
        ->with('barangs', $barangs);
    }

    public function show(Request $request, $id){
        $barang = DB::table('barang')
        ->where('id', $id)
        ->first();

        return view('admin.barang.show')
        ->with('barang', $barang);
    }

    public function accept($id) {
        DB::table('barang')
            ->where('id', $id)
            ->update([
                'status' => 'verified',
                'admin_id' => Auth::guard('admin')->id()
            ]);

        $barang = DB::table('barang')
        ->where('id', $id)
        ->first();

        $user = DB::table('users')
        ->where('id', $barang->user_id)
        ->first();

        $to_email = $user->email;

        Mail::to($to_email)->send(new VerifBarang($user, $barang));

        return redirect()
        ->route('verif-barang.index');
    }

    public function decline($id) {
        DB::table('barang')
            ->where('id', $id)
            ->update([
                'status' => 'declined',
                'admin_id' => Auth::guard('admin')->id()
            ]);

        $barang = DB::table('barang')
        ->where('id', $id)
        ->first();

        $user = DB::table('users')
        ->where('id', $barang->user_id)
        ->first();

        $to_email = $user->email;

        Mail::to($to_email)->send(new VerifBarang($user, $barang));

        return redirect()
        ->route('verif-barang.index');
    }
}
