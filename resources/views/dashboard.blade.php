@extends('layouts.app')
@section('content-title', 'Dashboard')
@section('content')
<!-- Info boxes -->
<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-pink elevation-1"><i class="fa fa-cubes"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Produk</span>
        <span class="info-box-text">
          <strong>{{$produk}}</strong>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-primary elevation-1"><i class="fa-solid fa-wallet"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Penjualan</span>
        <span class="info-box-text"><strong>{{$penjualan}}</strong></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-sack-dollar"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Pendapatan</span>
        <span class="info-box-text"><strong>Rp. {{$pendapatan}}</strong></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Pengeluaran</span>
        <span class="info-box-text"><strong>Rp. {{$pengeluaran}}</strong></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

</div>
<!-- /.row -->
<!-- End of Info Boxes -->

<div class="row">
  <div class="col-12 col-md-6">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Produk Terlaris</h5>
      </div>
      <div class="card-body">
        <table class="table table-sm table-bordered">
          <thead>
            <tr class="text-center">
              <th>No</th>
              <th>Nama Produk</th>
              <th>Total Terjual</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($produkTerlaris as $item)
            <tr>
              <td class="text-center">{{$loop->iteration}}</td>
              <td>{{$item['nama_produk']}}</td>
              <td class="text-center">{{$item['total_terjual']}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <small>Menampilkan 5 produk terlaris bulan ini</small>
      </div>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->

  <div class="col-12 col-md-6">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-exclamation-triangle"></i> Produk Hampir Habis</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0" style="max-height: 300px;">
        <table class="table table-sm table-bordered">
          <thead>
            <tr class="text-center">
              <th width="10%">No</th>
              <th>Nama Produk</th>
              <th>Stok</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($produkStokMin as $item)
            <tr>
              <td class="text-center">{{$loop->iteration}}</td>
              <td>{{ $item->nama_produk}}</td>
              <td class="text-center"><span class="badge badge-danger text-md">{{ $item->stok }}</span></td>
            </tr>
            @empty
            <tr>
              <td colspan="3" class="text-center text-muted">Semua stok aman</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

@endsection