@extends('layouts.layout')

@section('title', 'Barang Ditawar')

@section('css')
<style type="text/css">
    .pagination li{
        float: left;
        list-style-type: none;
        margin:5px;
    }
</style>
@endsection

@section('main')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>Page {{ $penawaran_barangs->currentPage() }} of {{ $penawaran_barangs->lastPage() }}</p>
            <ul class="list-group">
                @foreach ($penawaran_barangs as $penawaran_barang)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{$penawaran_barang->barang->photo}}" class="img img-fluid" style="width: 10vw; margin-right:5%;"/>
                            </div>
                            <div class="col-4 d-flex align-items-center">
                                {{ $penawaran_barang->barang->nama }}
                            </div>
                            <div class="col-5 pt-2">
                                <div class="row">
                                    <div class="col">
                                        <p>Penawaran Anda : {{ $penawaran_barang->harga_rupiah() }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        @if ($penawaran_barang->harga == $penawaran_barang->barang->harga_awal) 
                                        <p>Status Penawaran : <span style="color: green;">Tertinggi</span></p>
                                        @else
                                        <p>Status Penawaran : <span style="color: red;">Bukan Tertinggi</span></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <a href="{{route('lelang.show', ['id' => $penawaran_barang->barang->id])}}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-money-check"></i> Lihat Barang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <p>
                {!! $penawaran_barangs->links() !!}
            </p>
        </div>
    </div>
<div class="d-flex justify-content-center" style="width:100%;">
    <p>
    </p>
</div>
@endsection

@section('js')
<script>
console.log("{{ $penawaran_barangs->links() }}");
</script>
@endsection
