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
            @if (count($pembayaran) < 1)
                <h4 class="py-3" style="text-align: center">Tidak ada pembayaran baru.</h4>
            @else

            <table class="table table-hover">
                <thead>
                    <th scope="col">Nama</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Bukti Pembayaran</th>
                    <th scope="col">Tanggal submit</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody>
                    @foreach ($pembayaran as $item)
                    <tr>
                        <td>{{ $item->nama_user }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>
                            <form method="POST" action="{{ route('klaim-admin.buktiBayar')}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $item->pembayaran_id }}">
                                <button class="btn btn-primary"type="submit">Download</button>
                            </form>
                        </td>
                        <td>{{ $item->tgl_submit }}</td>
                        <td>
                            <form method="POST" action="{{ route('klaim-admin.accept')}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $item->pembayaran_id }}">
                                <button class="btn btn-success"type="submit">Accept</button>
                            </form>
                            <form method="POST" action="{{ route('klaim-admin.decline')}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $item->pembayaran_id }}">
                                <button class="btn btn-danger"type="submit">Decline</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>


            </table>
            <p>
                {!! $pembayaran->links() !!}
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
