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
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">{{$barang->nama}}</h3>
              <div class="col-12">
                <img src="{{asset($barang->photo) }}" class="product-image" alt="Product Image">
              </div>
              <!-- <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="{{ $barang->photo }}" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="{{ $barang->photo }}" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="{{ $barang->photo }}" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="{{ $barang->photo }}" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="{{ $barang->photo }}" alt="Product Image"></div>
              </div> -->
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">{{$barang->nama}}</h3>
              <p>{{$barang->deskripsi}}</p>

              <hr>
              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  Penawaran Tetinggi : {{$barang->harga_tertinggi}}
                </h2>
              </div>

              <div class="mt-4">
                <form class="" action="{{route('bid.create')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <input type="hidden" name="barang_id" value="{{$barang->id}}">
                            <input type="number" name="harga" class="form-control" placeholder="Jumlah Tawaran"/>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-default btn-lg btn-flat">
                                <i class="fas fa-money-bill"></i>
                                Tawar
                            </button>
                        </div>
                    </div>
                </form>
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
