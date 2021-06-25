<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Interfaces\QRCodeInterface;

use App\Repositories\KlaimRepositoryInterface;

class KlaimAPIController extends Controller
{
    private $KlaimRepo;

    public function __construct(QRCodeInterface $qrcode_service, KlaimRepositoryInterface $KlaimRepo) {
        $this->qrcode_service = $qrcode_service;
        $this->KlaimRepo = $KlaimRepo;
    }

    public function index(Request $request) {

        // ambil data menggunakan repository
        $penawaran_menang = $this->KlaimRepo->indexAPI($request);

        // dd($penawaran_menang);

        return response()
        ->json([
            'success' => true,
            'data' => $penawaran_menang
        ], 200);

    }

    public function show(Request $request) {

        // dapetin penawaran menggunakan repository
        $penawaran = $this->KlaimRepo->getPenawaran($request->id);

        $pembayaran = $this->KlaimRepo->getPembayaran($request->id);

        // * gak perlu qrcode
        // $qrcode = "";

        // if ($pembayaran)
        //     $qrcode = $this->qrcode_service->createQRCode(
        //         $pembayaran->bukti_pembayaran
        //     );

        return response()
            ->json([
                'success' => true,
                'data' => $pembayaran
            ], 200);
    }

    public function create(Request $request) {

        // menggunakan repository
        try {
            DB::beginTransaction();

            $newBayar = $this->KlaimRepo->createAPI($request);

            DB::commit();

            return response()
                ->json([
                    'success' => true,
                    'data' => $newBayar
                ], 200);

        } catch(\Illuminate\Database\QueryException $e) {

            $errorCode = $e->errorInfo[1];
            $errorMsg = $e->errorInfo[2];
            if ($errorCode == 1062) {
                return response()
                    ->json([
                        'success' => false,
                        'error' => $errorCode,
                        'message' => $errorMsg
                    ], 500);
            }

            return response()
                    ->json([
                        'success' => false,
                        'error' => $errorCode,
                        'message' => $errorMsg
                    ], 500);


        } catch (\Exception $e) {

            return response()
                    ->json([
                        'success' => false,
                        'error' => '500',
                        'message' => $e
                    ], 500);
        }
    }
}
