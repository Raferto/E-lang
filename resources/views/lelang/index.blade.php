@extends('layouts.layout')

@section('title', 'Barang Dilelang')

@section('css')
<style type="text/css">
    .pagination li {
        float: left;
        list-style-type: none;
        margin: 5px;
    }
</style>
@endsection

@section('main')

<div class="row justify-content-center">
    <div class="col-md-8">
        <p>Page {{ $barangs->currentPage() }} of {{ $barangs->lastPage() }}</p>
        <ul class="list-group">
            @foreach ($barangs as $barang)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-3">
                        <img src="{{$barang->photo}}" class="img img-fluid" style="width: 10vw; margin-right:5%;" />
                    </div>
                    <div class="col-7 d-flex align-items-center">
                        {{ $barang->nama }}
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <a href="{{route('lelang.show', ['id' => $barang->id])}}" class="btn btn-primary">
                            Show
                        </a>
                    </div>
                </div>
            </li>
            @endforeach
            @if (count($barangs) < 1) <div class="d-flex justify-content-between align-items-center sc-link">
                <div>
                    <p class="tx-montserrat tx-semibold mg-b-0 tx-color-02">Tidak Ada Barang Yang Sesuai Dengan Kata Kunci {{'"'.$keyword.'"'}}</p>
                </div>
                @endif
        </ul>
        <p>
            {!! $barangs->links() !!}
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
    console.log("{{ $barangs->links() }}");
</script>
@endsection