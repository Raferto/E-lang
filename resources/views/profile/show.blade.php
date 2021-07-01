@extends('layouts.layout')

@section('title', 'Profile')

@section('main')
<div class="card my-4">
	<div class="card-body">
		<form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label for="status">Status Verifikasi</label>
                @if ($user->verified) 
				<input type="text" name="status" class="form-control" value="Verified" style="color: green;" disabled/>
                @elseif($user->admin_id)
				<input type="text" name="status" class="form-control" value="Rejected" style="color: red;" disabled/>
                @else
				<input type="text" name="status" class="form-control" value="Will be Verified" style="color: blue;" disabled/>
                @endif
			</div>

			<div class="form-group">
				<label for="nama">Nama</label><small class="text-danger">*</small>
				<input type="text" name="nama" class="form-control" value="{{ $user->nama }}" />
				@if ($errors->has('nama'))
                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                @endif
			</div>

			<div class="form-group">
				<label for="phone">Nomor Telepon</label><small class="text-danger">*</small>
				<input type="text" name="phone" class="form-control" value="{{ $user->nomor_telpon }}"/>
				@if ($errors->has('phone'))
					<br><span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
			</div>

			<div class="form-group">
				<label for="deskripsi">Alamat</label><small class="text-danger">*</small>
				<input type="text" name="alamat" class="form-control" value="{{ $user->alamat }}"/>
				@if ($errors->has('alamat'))
					<br><span class="text-danger">{{ $errors->first('alamat') }}</span>
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
                @if ($user->photo)
                <img src="{{$user->photo}}" width="250" alt="" srcset="">
                @endif
			</div>

			<button type="submit" class="btn btn-primary btn-block">
				Update
			</button>
	</div>
</div>

@endsection
