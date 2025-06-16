@extends('layouts.app')
@section('content-title', 'Laporan Transaksi')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr class="text-center">
                            <th  width='8%'>No</th>
                            <th>No kwitansi</th>
                            <th>Tanggal Transaksi</th>
                            <th>Kasir</th>
                            <th>Total</th>
                            <th>Bayar</th>
                            <th>Kembalian</th>
                            <th width='8%'><i class="fa-solid fa-gear"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$item['no_kwitansi']}}</td>
                            <td class="text-center">{{$item['tanggal_penerimaan']}}</td>
                            <td class="text-center">{{ucwords($item['kasir'])}}</td>
                            <td class="text-center">Rp. {{number_format($item['total'])}}</td>
                            <td class="text-center">Rp. {{number_format($item['bayar'])}}</td>
                            <td class="text-center">Rp. {{number_format($item['kembalian'])}}</td>
                            <td class="text-center">
                                <a class="btn btn-success btn-xs"
                                    href="{{route('laporan-penjualan.detail', $item['no_kwitansi'])}}"><i class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
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