@extends('layouts.app')
@section('content-title', 'Detail Laporan Transaksi')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div>
                <p class="m-0">Tanggal : <strong> {{$data['tanggal_penerimaan']}}</strong></p>
                <p class="m-0">Kasir : <strong>{{ucwords($data['kasir'])}}</strong></p>
                <p class="m-0">SubTotal : <strong>Rp. {{number_format($data['total'])}}</strong></p>
                <p class="m-0">Bayar : <strong>Rp. {{number_format($data['bayar'])}}</strong></p>
                <p class="m-0">Kembalian : <strong>Rp. {{number_format($data['kembalian'])}}</strong></p>
            </div>
                <div class="mt-3">
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
                                    <td>Rp. {{number_format($item['harga_jual'])}}</td>
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