@extends('layouts.layout')

@section('title', 'Barangku')

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
            <p>
                <!-- Page {{ $barang->currentPage() }} of {{ $barang->lastPage() }} -->
                {!! $barang->links() !!}
            </p>
            <ul class="list-group">
                @foreach ($barang as $b)
                    <a href="{{route('barangku.show', ['id' => $b->id])}}" >
                    <li class="list-group-item"  >
                        <div class="row">
                            <div  class="col-3 d-flex p-2 align-items-left">
                                <img src="{{$b->photo}}" class="img img-fluid" style="max-width:10vw;max-height:5vw; display:inline;"/>
                            </div>
                            <div  class="col-3 d-flex p-2 align-items-left">
                                <div> {{ $b->nama }} </div>
                            </div>
                        </div>
                    </li>
                    <a>
                @endforeach
                    @if (count($barang) < 1) <div class="d-flex justify-content-between align-items-center sc-link">
                        <div>
                            <p class="tx-montserrat tx-semibold mg-b-0 tx-color-02">Tidak Ada Barang</p>
                        </div>
                        @endif
            </ul>
        </div>
    </div>
@endsection

@section('js')
<script>
console.log("{{ $barang->links() }}");
</script>
@endsection
