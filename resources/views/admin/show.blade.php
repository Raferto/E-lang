@extends('layouts.layout')

@section('title', $user->nama)

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
<div class="card card-solid">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none">{{$user->nama}}</h3>
                <div class="col-12">
                    <img src="{{$user->photo}}" class="user-image" alt="User Image">
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-3">{{$user->nama}}</h3>
                <p>Email : {{$user->email}}</p>
                <p>Nomor Telepon : {{$user->nomor_telpon}}</p>
                <p>Alamat : {{$user->alamat}}</p>

                <hr>
                <div class="bg-gray py-2 px-3 mt-4" style="max-width: 29%;">
                    <h2 class="mb-1">
                        <a style="margin-right: 5px;" href="{{route('user-verification.send', ['id' => $user->id])}}" class="btn btn-primary">
                            Accept
                        </a>
                        <a href="{{route('user-verification.decl', ['id' => $user->id])}}" class="btn btn-danger">
                            Decline
                        </a>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection

@section('js')
@endsection