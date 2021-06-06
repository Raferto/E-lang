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
			<input type="text" name="nama" class="form-control" value="{{$barang->nama}}" />
		</div>

		<div class="form-group">
			<label for="photo">Photo</label> <br>
			<div class="product-image" ><img src="{{$barang->photo}}" alt="Product Image"></div><br>
			<input type="file" name="photo" />
		</div>

		<div class="form-group">
			<label for="harga_awal">Harga Awal</label>
			<input type="number" name="harga_awal" class="form-control" value="{{$barang->harga_awal}}"/>
		</div>

		<div class="form-group">
			<label for="deskripsi">Deskripsi</label>
			<input type="text" name="deskripsi" class="form-control" value="{{$barang->deskripsi}}"/>
		</div>

		<div class="form-group">
			<label for="lelang_start">Mulai Lelang</label>
			<input type="datetime-local" name="lelang_start" class="form-control" value="{{$barang->lelang_start}}"/>
		</div>

		<div class="form-group">
			<label for="lelang_finished">Selesai Lelang</label>
			<input type="datetime-local" name="lelang_finished" class="form-control" value="{{$barang->lelang_finished}}"/>
		</div>

        <!-- /.card-body -->
      </div>
      <!-- /.card -->
@endsection

@section('js')
@endsection
