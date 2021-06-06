@extends('layouts.layout')

@section('title', 'User')

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
        <p>Page {{ $users->currentPage() }} of {{ $users->lastPage() }}</p>
        <ul class="list-group">
            @foreach ($users as $user)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-2 d-flex p-2 align-items-left">
                        <div>{{ $user->nama }}</div>
                    </div>
                    <div class="col-4 d-flex p-2 align-items-left">
                        <div style="margin-left:10px;">{{ $user->email }}</div>
                    </div>
                    <div class="col-3 d-flex p-2 align-items-left">
                        <div style="margin-left:10px;">{{ $user->nomor_telpon }}</div>
                    </div>
                    <div class="col-2 d-flex align-items-right">
                        <a style="margin-right: 10px;" href="{{route('lelang.show', ['id' => $user->id])}}" class="btn btn-primary">
                            Accept
                        </a>
                        <a href="{{route('lelang.show', ['id' => $user->id])}}" class="btn btn-primary">
                            Decline
                        </a>
                    </div>
                </div>
            </li>
            @endforeach
            @if (count($users) < 1) <div class="d-flex justify-content-between align-items-center sc-link">
                <div>
                    <p class="tx-montserrat tx-semibold mg-b-0 tx-color-02">Tidak Ada User</p>
                </div>
                @endif
        </ul>
        <p>
            {!! $users->links() !!}
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
    console.log("{{ $users->links() }}");
</script>
@endsection