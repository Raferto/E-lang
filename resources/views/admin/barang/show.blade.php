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
			<div class="form-group">
				<label for="nama">Status</label>
				<input type="text" name="status" class="form-control" value="{{$barang->status}}" readonly />
			</div>

			<div class="form-group">
				<label for="nama">Name</label>
				<input type="text" name="nama" class="form-control" value="{{$barang->nama}}" readonly/>
			</div>

			<div class="form-group">
				<label for="photo">Photo</label> <br>
				<div class="product-image" ><img src="{{$barang->photo}}" alt="Product Image"></div><br>
			</div>

			<div class="form-group">
				<label for="harga_awal">Harga Awal</label>
				<input type="string" name="harga_awal" class="form-control" value="{{$barang->harga_awal_rupiah()}}" readonly/>
			</div>

			@if( $kategori != "" )
				<div class="form-group">
					<label for="kategori" style="margin-bottom:0">Kategori</label>
					<input type="text" name="deskripsi" class="form-control" value="{{$kategori}}" readonly/>
				</div>
			@endif

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

			<div class="row justify-content-center">
				<div class="form-group">
					<div  class="col-2 d-flex p-2 align-items-left">
						<a href="{{route('verif-barang.decline', ['id' => $barang->id])}}">
							<input type="button" class="btn btn-danger" value="Decline" readonly/>
						</a>
					</div>
				</div>
				<div  class="col-2 d-flex p-2 align-items-left">
					<div class="form-group ">
						<a href="{{route('verif-barang.accept', ['id' => $barang->id])}}">
							<input type="button" class="btn btn-success" value="Accept" readonly/>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
@endsection
