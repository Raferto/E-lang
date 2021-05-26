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
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <img src="{{$penawaran_barang->barang->photo}}" class="img img-fluid" style="width:10%;margin-right:5%;"/>
                            {{ $penawaran_barang->barang->nama }}
                        </div>
                        {{ $penawaran_barang->harga }}
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
