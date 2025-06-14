@extends('layouts.app')
@section('content-title', 'Kategori')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger d-flex flex-column">
                        @foreach ($errors->all() as $error)
                            <li class="text-white my-2">{{$error}}</li>
                        @endforeach
                    </div>
                @endif
                <button id="tambah" type="button" class="btn btn-dark btn-sm mb-3" onclick="addForm('{{route('kategori.store')}}')">
                    <i class="fa-regular fa-circle-plus mr-1"></i> Tambah</button>
                <div class="table-responsive">
                    <table id="" class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th class="text-center" width='10%'>No</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center" width='15%'><i class="fa-solid fa-gear"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $kategori)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$kategori['nama_kategori']}}</td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-xs"
                                        onclick="updateForm('{{$url}}/{{$kategori['id']}}', '{{$kategori}}')" type="button"
                                        data-toggle="modal" data-target="#modal"><i
                                            class="fa fa-pen-to-square"></i></button>
                                    <form action="/kategori/{{$kategori['id']}}" class="d-inline"
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

@include('kategori.form')

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
    $("#modal-form .modal-title").text("Tambah Kategori");

    $("#modal-form form")[0].reset();
    $("#modal-form form").attr("action", url);
    $("#modal-form [name=_method]").val("post");
    $("modal-form [name=nama_kategori]").focus();
}

function updateForm(url, data) {
    $kategori = JSON.parse(data);
    $("#modal-form").modal("show");
    $("#modal-form .modal-title").text("Edit Kategori");

    $("#modal-form form")[0].reset();
    $("#modal-form form").attr("action", url);
    $("#modal-form [name=_method]").val("put");
    $("modal-form [name=nama_kategori]").focus();
    $("#modal-form [name=nama_kategori]").val($kategori.nama_kategori);
}
</script>
@endpush