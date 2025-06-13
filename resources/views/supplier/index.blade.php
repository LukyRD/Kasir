@extends('layouts.app')
@section('content-title', 'Supplier')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger d-flex flex-column">
                        @foreach ($errors->all() as $error)
                            <li class="text-white my-2">{{$error}}</li>
                        @endforeach
                    </div>
                @endif
                <button id="tambah" type="button" class="btn btn-dark btn-sm mb-3" onclick="addForm('{{route('supplier.store')}}')">
                    <i class="fa-regular fa-circle-plus mr-1"></i> Tambah</button>
                <div class="table-responsive">
                    <table id="" class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th class="text-center" width='10%'>No</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">No Telepon</th>
                                <th class="text-center" width='15%'><i class="fa-solid fa-gear"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $supplier)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$supplier['nama']}}</td>
                                <td class="text-center">{{$supplier['alamat']}}</td>
                                <td class="text-center">{{$supplier['telepon']}}</td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-xs"
                                        onclick="updateForm('{{$url}}/{{$supplier['id']}}', '{{$supplier}}')" type="button"
                                        data-toggle="modal" data-target="#modal"><i
                                            class="fa fa-pen-to-square"></i></button>
                                    <form action="/supplier/{{$supplier['id']}}" class="d-inline"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"
                                                onclick="return confirm('Yakin?')"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

@include('supplier.form')

@endsection
@push('script')
<script>
    let table;

$(function () {
    $(".table").DataTable({
        paging: true,
      lengthChange: true,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
    });

    $("#modal-form").on("submit"),
        function () {
            $.ajax({
                url: $("#modal-form form").attr("action"),
                type: "post",
                data: $("#modal-form form").serialize(),
            });

            $("#modal-form").modal("hide");
            table.ajax.reload();
        };
});

function addForm(url) {
    $("#modal-form").modal("show");
    $("#modal-form .modal-title").text("Tambah Supplier");

    $("#modal-form form")[0].reset();
    $("#modal-form form").attr("action", url);
    $("#modal-form [name=_method]").val("post");
    $("modal-form [name=nama]").focus();
}

function updateForm(url, data) {
    $supplier = JSON.parse(data);
    $("#modal-form").modal("show");
    $("#modal-form .modal-title").text("Edit Supplier");

    $("#modal-form form")[0].reset();
    $("#modal-form form").attr("action", url);
    $("#modal-form [name=_method]").val("put");
    $("modal-form [name=nama]").focus();
    $("#modal-form [name=nama]").val($supplier.nama);
    $("#modal-form [name=alamat]").val($supplier.alamat);
    $("#modal-form [name=telepon]").val($supplier.telepon);
}
</script>
@endpush