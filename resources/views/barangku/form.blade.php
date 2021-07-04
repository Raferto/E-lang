@extends('layouts.layout')

@section('title', 'Pengajuan Barang baru')

@section('main')
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card-body">
				<form action="{{route('barangku.create')}}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label for="nama">Nama</label><small class="text-danger">*</small>
						<input type="text" name="nama" class="form-control" value="{{ old('nama') }}" />
						@if ($errors->has('nama'))
							<span class="text-danger">{{ $errors->first('nama') }}</span>
						@endif
					</div>

					<div class="form-group">
						<label for="photo">Foto</label><small class="text-danger">*</small> <br>
						<input type="file" name="photo" value=" {{ old('photo') }} "/>
						@if ($errors->has('photo'))
							<br><span class="text-danger">{{ $errors->first('photo') }}</span>
						@endif
					</div>

					<div class="form-group">
						<label for="harga_awal">Harga Awal</label><small class="text-danger">*</small>
						<input type="number" name="harga_awal" class="form-control" value="{{ old('harga_awal') }}"/>
						@if ($errors->has('harga_awal'))
							<br><span class="text-danger">{{ $errors->first('harga_awal') }}</span>
						@endif
					</div>

					<div class="form-group">
						<label for="deskripsi">Deskripsi</label><small class="text-danger">*</small>
						<input type="text" name="deskripsi" class="form-control" value="{{ old('deskripsi') }}"/>
						@if ($errors->has('deskripsi'))
							<br><span class="text-danger">{{ $errors->first('deskripsi') }}</span>
						@endif
					</div>

					<div class="form-group">
						<label for="kategori" style="margin-bottom:0">Kategori</label><br>
						<small style="margin:0">*seperated by "," without the "</small>
						<input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}"/>
					</div>

					<div class="form-group">
						<label for="lelang_start">Mulai Lelang</label><small class="text-danger">*</small>
						<input type="datetime-local" name="lelang_start" class="form-control" value="{{old('lelang_start')}}"/>
						@if ($errors->has('lelang_start'))
							<br><span class="text-danger">{{ $errors->first('lelang_start') }}</span>
						@endif
					</div>

					<div class="form-group">
						<label for="lelang_finished">Selesai Lelang</label><small class="text-danger">*</small>
						<input type="datetime-local" name="lelang_finished" class="form-control"/>
						@if ($errors->has('lelang_finished'))
							<br><span class="text-danger">{{ $errors->first('lelang_finished') }}</span>
						@endif

					</div>

					<button type="submit" class="btn btn-primary btn-block">
						Ajukan
					</button>
			</div>
		</div>
	</div>
</div>

@endsection
