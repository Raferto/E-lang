@extends('layout.layout')

@section('title', 'Klaim Penawaran')

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
        <p>Page {{ $penawarans->currentPage() }} of {{ $penawarans->lastPage() }}</p>
        <ul class="list-group">
            @foreach ($penawarans as $p)
            <li class="list-group-item d-flex justify-content-between">
                <div>
                    <img src="{{$p->photo}}" class="img img-fluid" style="width:10%;margin-right:5%;" />
                    {{ $p->nama }}
                </div>
                <a href="{{route('klaim.show', ['id' => $p->id])}}" class="btn btn-primary">
                Show
                </a>
            </li>
            @endforeach
        </ul>
        <p>
            {!! $penawarans->links() !!}
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
    console.log("{{ $penawarans->links() }}");

</script>
@endsection
