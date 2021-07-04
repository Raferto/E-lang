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
	</div>
@endsection

@section('js')
@endsection
