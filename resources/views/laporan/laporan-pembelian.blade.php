@extends('layouts.app')
@section('content-title', 'Laporan Pembelian')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="" class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr class="text-center">
                            <th  width='8%'>No</th>
                            <th>No Penerimaan</th>
                            <th>No Faktur</th>
                            <th>Supplier</th>
                            <th>Kasir</th>
                            <th>Tanggal Masuk</th>
                            <th width='8%'><i class="fa-solid fa-gear"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$item['no_penerimaan']}}</td>
                            <td class="text-center">{{$item['no_faktur']}}</td>
                            <td class="text-center">{{$item['supplier']}}</td>
                            <td class="text-center">{{$item['kasir']}}</td>
                            <td class="text-center">{{$item['tanggal_penerimaan']}}</td>
                            <td class="text-center">
                                <a class="btn btn-success btn-xs"
                                    href="{{route('laporan-pembelian.detail', $item['no_penerimaan'])}}"><i class="fa-solid fa-eye"></i></a>
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