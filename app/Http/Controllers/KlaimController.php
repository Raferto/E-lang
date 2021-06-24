<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Pembayaran;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Interfaces\QRCodeInterface;

use App\Repositories\KlaimRepositoryInterface;

class KlaimController extends Controller
{
    private $KlaimRepo;

    public function __construct(QRCodeInterface $qrcode_service, KlaimRepositoryInterface $KlaimRepo) {
        $this->qrcode_service = $qrcode_service;
        $this->KlaimRepo = $KlaimRepo;
    }

    public function index() {

        // ambil data menggunakan repository
        $penawaran_menang = $this->KlaimRepo->index();

        // dd($penawaran_menang);

        return view('klaim.index')
                ->with('penawarans', $penawaran_menang);

    }

    public function show(Request $request, $id) {

        // dapetin penawaran menggunakan repository
        $penawaran = $this->KlaimRepo->getPenawaran($id);

        $pembayaran = $this->KlaimRepo->getPembayaran($id);

        $qrcode = "";

        if ($pembayaran)
            $qrcode = $this->qrcode_service->createQRCode(
                $pembayaran->bukti_pembayaran
            );

        // dd($penawaran);
        return view('klaim.show')
                ->with('penawaran', $penawaran)
                ->with('pembayaran', $pembayaran)
                ->with('qrcode', $qrcode);
    }

    public function create(Request $request) {

        // menggunakan repository
        try {
            DB::beginTransaction();

            $this->KlaimRepo->create($request);

            DB::commit();
            return redirect()->back();

        } catch(\Illuminate\Database\QueryException $e) {

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
