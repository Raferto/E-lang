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

<div class="row justify-content-center vh-100">
    <div class="col-md-8">
        <div class="card mt-5">
            @if (count($logs) < 1)
                <h4 class="py-3" style="text-align: center">Tidak ada riwayat verifikasi pembayaran.</h4>
            @else

            <table class="table table-hover table-sm">
                <thead>
                    <th scope="col">User</th>
                    <th scope="col">Barang</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Tanggal</th>
                </thead>
                <tbody>
                    @foreach ($logs as $item)
                    <tr>
                        <td>{{ $item->nama_user }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->nama_admin }}</td>
                        <td>
                            @if ($item->aksi == 'accept')
                            <span class="badge badge-success">Pembayaran diterima</span>
                            @else
                            <span class="badge badge-danger">Pembayaran ditolak</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p>
                {!! $logs->links() !!}
            </p>
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
