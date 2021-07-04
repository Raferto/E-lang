@extends('layouts.layout')

{{-- @section('title', 'Home') --}}

@section('css')
<link rel="stylesheet" href="{{asset('css')}}/home.css">
<style>
    #img-container {
        background: url("{{asset('asset/wallpaper.png')}}");
        background-size: cover;
    }
</style>
@endsection

@section('main')
<div class="overflow-hidden" id="img-container">
    <div class="centered h3 font-w800 mb-10" >Lelang lebih mudah <br> dengan E-Lang</div>
</div>
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6 h2">
                Barang Dilelang
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="row row-deck items-push ml-1 mr-1">
    @foreach ($barangs as $barang)
    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column p-1">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-7">
                        <h2 class="lead"><b>{{$barang->nama}}</b></h2>
                        <p class="text-muted text-sm"><b>Mulai Lelang: </b> {{date( "d/m/Y h:i:s", strtotime($barang->lelang_start))}} </p>
                        <p class="text-muted text-sm"><b>Selesai Lelang: </b> {{date( "d/m/Y h:i:s", strtotime($barang->lelang_finished))}} </p>
                        <p class="text-muted text-sm"><b>Lelang Tertinggi: </b> {{$barang->harga_awal_rupiah()}} </p>
                    </div>
                    <div class="col-5 text-center">
                        <img src="{{$barang->photo}}" alt="user-avatar" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <a href="{{route('lelang.show', ['id' => $barang->id])}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-money-check"></i> Lihat Barang
                    </a>
                </div>
            </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
