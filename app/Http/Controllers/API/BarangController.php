<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBarang;
use App\Repositories\BarangRepositoryInterface;
use Illuminate\Support\Facades\DB;

use App\Interfaces\QRCodeInterface;

class BarangController extends BaseController
{
    private $barangRepository;

    public function __construct(BarangRepositoryInterface $barangRepository) {
        $this->barangRepository = $barangRepository;
    }

    public function index(Request $request){
        $barang = $this->barangRepository->getAllBarangku($request->user_id);

        return $this->sendResponse(
            $barang,
            'success'
        );
    }

    public function show(Request $request){
        $barang = $this->barangRepository->getBarangku($request->id);
        
        return response()
        ->json([
            'success' => true,
            'data' => $barang
        ], 200);
    }

    public function create(StoreBarang $request) {
        try {
            DB::beginTransaction();
            $barang = $this->barangRepository->create($request);

            DB::commit();

            return response()
                ->json([
                    'success' => true,
                    'data' => $barang
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
