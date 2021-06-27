<?php

namespace App\Http\Controllers\API;

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

    public function index() {
        $barang = $this->repository->getAllBarangku();

        return $this->sendResponse(
            $barang,
            'success'
        );
    }

    public function show(Request $request, $id){
        $barang = $this->barangRepository->getBarangku($id);
        
        return response()
        ->json([
            'success' => true,
            'data' => $barang
        ], 200);
    }

    public function create(StoreBarang $request) {
        try {
            DB::beginTransaction();
            $this->barangRepository->create($request);

            DB::commit();

            return $this->sendResponse(
                [],
                'success'
            );
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->sendError(
                $e->getMessage(),
                $code = 500
            );
        }
    }
}
