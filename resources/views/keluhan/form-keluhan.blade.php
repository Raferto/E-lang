@extends('layouts.layout')

@section('title', 'Barangku')

@section('css')
@endsection

@section('main')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h1 class="mt-5 mb-4">Lapor Keluhan</h1>
        <form method="POST" action="/keluhan">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <div class="form-group">
                <label for="label_subjek">Subjek Laporan</label>
                <input type="text" class="form-control" id="label_subjek" name="subjek">
            </div>
            <div class="form-group">
                <label for="label_isi">Deskripsi Keluhan</label>
                <textarea class="form-control" id="label_isi" rows="5" name="isi"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Kirim Keluhan</button>
        </form>
    </div>
</div>
<div class="d-flex justify-content-center" style="width:100%;">
    <p>
    </p>
</div>
@endsection

@section('js')
@endsection
