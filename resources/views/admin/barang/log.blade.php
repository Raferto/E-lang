@extends('layouts.layout')

@section('title', 'History Barang Verification')

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

<div class="row justify-content-center vh-100">
    <div class="col-md-8">
        <p>
            {!! $logs->links() !!}
        </p>
        <div class="card mt-5">
            @if (count($logs) < 1) <h4 class="py-3" style="text-align: center">Tidak ada riwayat verifikasi account.</h4>
            @else
                <table class="table table-hover table-sm">
                    <thead>
                        <th scope="col">Id Barang</th>
                        <th scope="col">Id Admin</th>
                        <th scope="col">Aksi</th>
                        <th scope="col">Tanggal</th>
                    </thead>
                    <tbody>
                        @foreach ($logs as $item)
                        <tr>
                            <td style="vertical-align: middle;">{{ $item->barang_id }}</td>
                            <td style="vertical-align: middle;">{{ $item->admin_id }}</td>
                            <td style="vertical-align: middle;">
                                @if ($item->aksi == 'accepted')
                                <span class="badge badge-success">Verifikasi account diterima</span>
                                @else
                                <span class="badge badge-danger">Verifikasi account ditolak</span>
                                @endif
                            </td>
                            <td style="vertical-align: middle;">{{ $item->created_at }}</td>
                            <td style="vertical-align: middle;">
                            <a href="{{route('verif-barang.show', ['id' => $item->barang_id])}}" >
                                <input type="button" class="btn btn-primary btn-block" value="View" readonly/>
                            </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

        </div>
    </div>
</div>
<div class="d-flex justify-content-center" style="width:100%;">
    <p>
    </p>
</div>
@endsection

@section('js')
@endsection