<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Interfaces\QRCodeInterface;

use App\Models\Barang;
use App\Http\Requests\StoreBarang;
use App\Repositories\BarangRepositoryInterface;
use App\Repositories\BidRepositoryInterface;

class BarangkuController extends Controller
{
    private $barangRepository;
    private $bidRepository;

    public function __construct(QRCodeInterface $qrcode_service, BarangRepositoryInterface $barangRepository, BidRepositoryInterface $bidRepository) {
        $this->barangRepository = $barangRepository;
        $this->qrcode_service = $qrcode_service;
        $this->bidRepository = $bidRepository;
    }

    public function index(){
        $barang = $this->barangRepository->getAllBarangku();

        return view('barangku.index')
        ->with('barang', $barang);
    }

    public function show(Request $request, $id){
        $barang = $this->barangRepository->getBarangku($id);
        
        $qrcode = $this->qrcode_service->createQRCode(
            $barang->nama . '|' . $barang->deskripsi . '|' . $barang->harga_awal . '|' . $barang->lelang_start . $barang->lelang_finished . '|' . $barang->status
        );

        if( $barang->status = "verified" && $barang->lelang_start <= Carbon::now() ){
            $penawaranBarang = $this->bidRepository->getByBarang($id);
            return view('barangku.show')
                ->with('barang', $barang)
                ->with('penawaranBarang', $penawaranBarang)
                ->with('qrcode', $qrcode);
        }
        else
            return view('barangku.show')
            ->with('barang', $barang)
            ->with('qrcode', $qrcode);

    }

    public function form(){
        return view('barangku.form');
    }

    public function create(StoreBarang $request){
        try {
            DB::beginTransaction();

            $this->barangRepository->create($request);

            DB::commit();

            
            return redirect()
            ->route('barangku.index');
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
