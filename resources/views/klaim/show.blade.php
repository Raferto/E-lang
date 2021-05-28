@extends('layouts.layout')

@section('title', 'Klaim ' . $penawaran->nama)

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style type="text/css">
    .pagination li {
        float: left;
        list-style-type: none;
        margin: 5px;
    }

</style>
@endsection

@section('main')
<div class="card card-solid">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none">{{$penawaran->nama}}</h3>
                <div class="col-12">
                    <img src="{{ $penawaran->photo }}" class="product-image" alt="Product Image">
                </div>
                <div class="col-12 product-image-thumbs">
                    <div class="product-image-thumb active"><img src="{{ $penawaran->photo }}" alt="Product Image">
                    </div>
                    <div class="product-image-thumb"><img src="{{ $penawaran->photo }}" alt="Product Image"></div>
                    <div class="product-image-thumb"><img src="{{ $penawaran->photo }}" alt="Product Image"></div>
                    <div class="product-image-thumb"><img src="{{ $penawaran->photo }}" alt="Product Image"></div>
                    <div class="product-image-thumb"><img src="{{ $penawaran->photo }}" alt="Product Image"></div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-3">{{$penawaran->nama}}</h3>
                <p>{{$penawaran->deskripsi}}</p>
                <p>Lelang selesai pada: {{$penawaran->lelang_finished}}</p>
                <p>Status pembayaran:
                    @if($pembayaran == null)
                    <span class="badge badge-secondary">Belum dibayar</span>
                    @elseif($pembayaran->status == 'menunggu verifikasi')
                    <span class="badge badge-primary">Sudah dibayar - Menunggu verifikasi</span>
                    @elseif($pembayaran->status == 'sudah dibayar')
                    <span class="badge badge-success">Pembayaran telah diterima</span>
                    @elseif($pembayaran->status == 'ditolak')
                    <span class="badge badge-danger">Pembayaran ditolak</span>
                    @endif
                </p>

                <hr>
                <div class="bg-primary py-2 px-3 mt-4">
                    <h2 class="mb-0">
                        Harga akhir : Rp {{ number_format($penawaran->harga, 0, ',', '.') }}
                    </h2>
                </div>

                @if($pembayaran == null ||$pembayaran->status == 'ditolak' )

                <div class="mt-4">
                    <form class="" action="{{route('klaim.create')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" name="penawaran_id" value="{{$penawaran->id}}">
                                <div class="input-group" style="min-width: 100px">
                                    {{-- <div class="input-group-prepend">
                                        <button type="button" id="input_file_bukti"><i class="fas fa-cloud-upload-alt"
                                                aria-hidden="true"></i>
                                        </button>
                                    </div> --}}
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="bukti_pembayaran" id="bukti_pembayaran"
                                            aria-describedby="input_file_bukti">
                                        <label class="custom-file-label" for="bukti_pembayaran">Bukti Pembayaran</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mt-3">
                                <button type="submit" class="btn btn-primary btn-md btn-flat">
                                    Bayar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection

@section('js')
<script type="application/javascript">
	$('#bukti_pembayaran').change(function(e){
		var fileName = e.target.files[0].name;
		$('.custom-file-label').html(fileName);
	});
</script>
@endsection
