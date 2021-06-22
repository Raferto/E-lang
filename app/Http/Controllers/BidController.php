<?php

namespace App\Http\Controllers;

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

        return view('bid.index')
        ->with('penawaran_barangs', $penawaran_barangs);
    }

    public function create(StoreBid $request) {
        try {
            DB::beginTransaction();
            $this->repository->create($request);

            DB::commit();
            return redirect()
            ->route('bid.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return \redirect()
            ->back()
            ->withErrors(['msg' => $e->getMessage()]);;
        }
    }
}
