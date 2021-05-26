@extends('layouts.layout')

@section('title', 'Barang Dilelang')

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
            <p>Page {{ $barangs->currentPage() }} of {{ $barangs->lastPage() }}</p>
            <ul class="list-group">
                @foreach ($barangs as $barang)
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <img src="data_files/photo_barang/{{$barang->photo}}" class="img img-fluid" style="width:10%;margin-right:5%;"/>
                            {{ $barang->nama }}
                        </div>
                        <a href="{{route('lelang.show', ['id' => $barang->id])}}" class="btn btn-primary">
                            Show
                        </a>
                    </li>
                @endforeach
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
