@extends('layout.layout')

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
        Hai
    </div>
</div>
@endsection

@section('js')
@endsection
