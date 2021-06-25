<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreBid;
use App\Repositories\BidRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BidController extends BaseController
{
    private $repository;

    public function __construct(BidRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index() {
        $penawaran_barangs = $this->repository->getAll();

        return $this->sendResponse(
            $penawaran_barangs,
            'success'
        );
    }

    public function create(StoreBid $request) {
        try {
            DB::beginTransaction();
            $this->repository->create($request);

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
