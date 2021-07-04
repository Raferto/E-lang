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
use App\Repositories\KlaimRepositoryInterface;

use App\Models\Pembayaran;

class BarangkuController extends Controller
{
    private $barangRepository;
    private $bidRepository;
    private $klaimRepository;

    public function __construct(QRCodeInterface $qrcode_service, BarangRepositoryInterface $barangRepository, BidRepositoryInterface $bidRepository, KlaimRepositoryInterface $klaimRepository) {
        $this->barangRepository = $barangRepository;
        $this->qrcode_service = $qrcode_service;
        $this->bidRepository = $bidRepository;
        $this->klaimRepository = $klaimRepository;
    }

    public function index(){
        $barang = $this->barangRepository->getAllBarangku();

        return view('barangku.index')
        ->with('barang', $barang);
    }

    public function show(Request $request, $id){
        $array = $this->barangRepository->getBarangku($id);
        $barang = $array[0];
        
        $qrcode = $this->qrcode_service->createQRCode(
            $barang->nama . '|' . $barang->deskripsi . '|' . $barang->harga_awal . '|' . $barang->lelang_start . $barang->lelang_finished . '|' . $barang->status
        );

        
        $now = Carbon::now();
        if( !($barang->status == "verified" && $barang->lelang_start <= $now) )
        return view('barangku.show')
            ->with('kategori', $array[1])
            ->with('barang', $barang)
            ->with('qrcode', $qrcode)
            ->with('pembayaran', false);
        
        $penawaranBarang = $this->bidRepository->getByBarang($id);

        if( $barang->lelang_finished > $now || \count($penawaranBarang) == 0)
        return view('barangku.show')
        ->with('barang', $barang)
        ->with('kategori', $array[1])
        ->with('penawaranBarang', $penawaranBarang)
        ->with('pembayaran', false)
        ->with('qrcode', $qrcode);
        
        if( $this->klaimRepository->getPembayaran( $penawaranBarang[0]->id )->status == "sudah dibayar" )
            return view('barangku.show')
                ->with('barang', $barang)
                ->with('kategori', $array[1])
                ->with('penawaranBarang', $penawaranBarang)
                ->with('qrcode', $qrcode)
                ->with('pembayaran', true);
        else
            return view('barangku.show')
            ->with('barang', $barang)
            ->with('kategori', $array[1])
            ->with('penawaranBarang', $penawaranBarang)
            ->with('qrcode', $qrcode)
            ->with('pembayaran', false);

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
