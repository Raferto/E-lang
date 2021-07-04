@extends('layouts.layout')

@section('title', $barang->nama)

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
			@if( $pembayaran )
				<h4 class="py-3" style="text-align: center">Silahkan Claim uang anda dengan menghubungi 081234567890</h4>
			@endif


			<label for="nama">QR Code</label>
			<div class="visible-print text-center">
			{{$qrcode}}
			</div> <br>

			<div class="form-group">
				<label for="nama">Status</label>
				<input type="text" name="status" class="form-control" value="{{$barang->status}}" readonly />
			</div>

			<div class="form-group">
				<label for="nama">Name</label>
				<input type="text" name="nama" class="form-control" value="{{$barang->nama}}"  readonly/>
			</div>

			<div class="form-group">
				<label for="photo">Photo</label> <br>
				<div class="product-image" ><img src="{{$barang->photo}}" alt="Product Image" readonly></div><br>
			</div>

			<div class="form-group">
				<label for="harga_awal">Harga Awal</label>
				<input type="string" name="harga_awal" class="form-control" value="{{$barang->harga_awal_rupiah()}}" readonly/>
			</div>

			<div class="form-group">
				<label for="deskripsi">Deskripsi</label>
				<input type="text" name="deskripsi" class="form-control" value="{{$barang->deskripsi}}" readonly/>
			</div>

			<div class="form-group">
				<label for="lelang_start">Mulai Lelang</label>
				<input type="datetime" name="lelang_start" class="form-control" value="{{$barang->lelang_start}}" readonly/>
			</div>

			<div class="form-group">
				<label for="lelang_finished">Selesai Lelang</label>
				<input type="datetime" name="lelang_finished" class="form-control" value="{{$barang->lelang_finished}}" readonly/>
			</div>
		</div>
      </div>

		@if( isset($penawaranBarang) )
			<div class="row justify-content-center vh-10">
				<div class="col-md-8">
					<label>Penawaran</label>
					<div class="card mt-2">
						<table class="table table-hover table-sm">
							<thead>
								<th scope="col">Harga Tawar</th>
								<th scope="col">Waktu</th>
							</thead>
							<tbody>
								@foreach ($penawaranBarang as $item)
									<tr>
										<td style="vertical-align: middle;">{{ $item->harga }}</td>
										<td style="vertical-align: middle;">{{ $item->created_at }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<p>
							{!! $penawaranBarang->links() !!}
						</p>
					</div>
				</div>
			</div>
		@endif
	</div>

@endsection

@section('js')
@endsection
