<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBid;
use App\Repositories\BidRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{
    private $repository;

    public function __construct(BidRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index() {
        $penawaran_barangs = $this->repository->getAll();

        return response()
        ->json([
            'success' => true,
            'data' => $penawaran_barangs
        ], 200);
    }

    public function create(StoreBid $request) {
        try {
            DB::beginTransaction();
            $this->repository->create($request);

            DB::commit();

            return response()
            ->json([
                'success' => true,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()
            ->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 200);
        }
    }
}
