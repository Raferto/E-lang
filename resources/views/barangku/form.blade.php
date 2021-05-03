@extends('layout.layout')

@section('title', 'Pengajuan Barang baru')

@section('main')
<div class="card my-4">
	<div class="card-body">
		<form action="{{route('barangku.create')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label for="nama">Name</label>
				<input type="text" name="nama" class="form-control" />
			</div>

			<div class="form-group">
				<label for="photo">Photo</label> <br>
				<input type="file" name="photo"/>
			</div>

			<div class="form-group">
				<label for="harga_awal">Harga Awal</label>
				<input type="number" name="harga_awal" class="form-control" />
			</div>

			<div class="form-group">
				<label for="deskripsi">Deskripsi</label>
				<input type="text" name="deskripsi" class="form-control" />
			</div>

			<div class="form-group">
				<label for="lelang_start">Mulai Lelang</label>
				<input type="datetime-local" name="lelang_start" class="form-control" />
			</div>

			<div class="form-group">
				<label for="lelang_finish">Selesai Lelang</label>
				<input type="datetime-local" name="lelang_finish" class="form-control" />
			</div>

			<button type="submit" class="btn btn-primary btn-block">
				Ajukan
			</button>
	</div>
</div>

@endsection