<h3>Halo, {{ $user->nama }} !</h3>

@if ($barang->status=="verified")
<p>Selamat barang Anda dengan nama {{$barang->nama}} telah terverifikasi </p>
@else
<p>Mohon maaf, kami tidak bisa melelangkan barang Anda dengan nama {{$barang->nama}}</p>
@endif
