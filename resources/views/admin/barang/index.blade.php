@extends('layouts.layout')

@section('title', 'Barang Perlu Verifikasi')

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
                @foreach ($barangs as $b)
                    <a href="{{route('verif-barang.show', ['id' => $b->id])}}" >
                    <li class="list-group-item d-flex justify-content-between"  >
                        <div>
                            <img src="{{$b->photo}}" class="img img-fluid" style="width:10vw; display:inline;"/> {{ $b->nama }}
                        </div>
                    </li>
                    <a>
                @endforeach
            </ul>
            <p>
                {!! $barangs->links() !!}
            </p>
        </div>
    </div>
@endsection

@section('js')
<script>
</script>
@endsection
