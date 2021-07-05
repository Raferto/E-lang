<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\VerifBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Repositories\BarangRepositoryInterface;

class BarangController extends Controller
{
    private $barangRepo;

    public function __construct(BarangRepositoryInterface $barangRepo)
    {
        $this->barangRepo = $barangRepo;
    }

    public function index() {
        $barangs = DB::table('barang')
        ->where('status', 'new')
        ->paginate(5);

        return view('admin.barang.index')
        ->with('barangs', $barangs);
    }

    public function show(Request $request, $id){
        $array = $this->barangRepo->getBarangku($id);

        return view('admin.barang.show')
        ->with('barang', $array[0])
        ->with('kategori', $array[1]);
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

        $this->barangRepo->LogVerifikasiBarang($id, 'verified');

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
        
        $this->barangRepo->LogVerifikasiBarang($id, 'declined');

        Mail::to($to_email)->send(new VerifBarang($user, $barang));

        return redirect()
        ->route('verif-barang.index');
    }

    public function logIndex()
    {
        $log = $this->barangRepo->getLogVerifikasiBarang();

        return view('admin.barang.log')->with('logs', $log);
    }
}
