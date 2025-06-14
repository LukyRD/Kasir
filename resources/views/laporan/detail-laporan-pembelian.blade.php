@extends('layouts.app')
@section('content-title', 'Detail Laporan Pembelian')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center p-3">
                <div>
                    <h3>{{config('app.name')}}</h3>
                    <h5>Laporan Barang Masuk</h5>
                </div>
                <div>
                    <small>{{$data['tanggal_penerimaan']}}</small>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="d-flex align-content-center">
                            <h6 class="text-bold w-50">Supplier</h6>
                            <p>{{$data['supplier']}}</p>
                        </div>
                        <div class="d-flex align-content-center">
                            <h6 class="text-bold w-50">Nomor Faktur</h6>
                            <p>{{$data['no_faktur']}}</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex align-content-center">
                            <h6 class="text-bold w-50">Petugas Penerima</h6>
                            <p>{{$data['kasir']}}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">NO</th>
                                <th >Nama Produk</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th >Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->items as $item)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$item['nama_produk']}}</td>
                                    <td class="text-center">{{number_format($item['qty'])}} pcs</td>
                                    <td>Rp. {{number_format($item['harga_beli'])}}</td>
                                    <td>Rp. {{number_format($item['total'])}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-bold text-center">Sub Total</td>
                                <td class="text-bold">Rp. {{number_format($data['subTotal'])}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@push('script')
<script>
    $(document).ready(function () {
            $(".table").DataTable({
        paging: true,
      lengthChange: true,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
    });
        });
</script>
@endpush