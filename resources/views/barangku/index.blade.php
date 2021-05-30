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
            <a href="{{route('barangku.form')}}" class="btn btn-primary" style="position: absolute; right: 0;">Create</a>
            <p>Page {{ $barang->currentPage() }} of {{ $barang->lastPage() }}</p>
            <ul class="list-group">
                @foreach ($barang as $b)
                    <a href="{{route('barangku.show', ['id' => $b->id])}}" >
                    <li class="list-group-item d-flex justify-content-between"  >
                        <div>
                            <img src="{{$b->photo}}" class="img img-fluid" style="width:10vw; display:inline;"/> {{ $b->nama }}
                        </div>
                    </li>
                    <a>
                @endforeach
            </ul>
            <p>
                {!! $barang->links() !!}
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
console.log("{{ $barang->links() }}");
</script>
@endsection
