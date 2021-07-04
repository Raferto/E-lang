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
            <div style="margin:2vh 2vh 5vh 2vh">
                @if ( auth()->user()->verified )
                    <a href="{{route('barangku.form')}}" class="btn btn-primary" style="position: absolute; right: 1vh;">Create</a>
                @endif
                Page {{ $barang->currentPage() }} of {{ $barang->lastPage() }}
            </div>
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
                    {!! $barang->links() !!}
            </ul>
        </div>
    </div>
@endsection

@section('js')
<script>
console.log("{{ $barang->links() }}");
</script>
@endsection
