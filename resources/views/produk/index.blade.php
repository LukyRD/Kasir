@extends('layouts.app')
@section('content-title', 'Produk')
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
                <button id="tambah" type="button" class="btn btn-dark btn-xs mb-3 p-1 " onclick="addForm('{{route('produk.store')}}')">
                    <i class="fa-regular fa-circle-plus mr-1"></i> Tambah</button>
                <div class="table-responsive">
                    <table id="" class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Produk</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Merk</th>
                                <th class="text-center">Harga Jual</th>
                                <th class="text-center">Harga Beli</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">Stok Min</th>
                                <th class="text-center">Aktif</th>
                                <th class="text-center"><i class="fa-solid fa-gear"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $produk)
                            @php
                                $id = $produk['id'];
                            @endphp
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$produk['nama_produk']}}</td>
                                <td class="text-center">{{$produk->kategori['nama_kategori'] ?? ''}}</td>
                                <td class="text-center">{{$produk['merk']}}</td>
                                <td class="text-center">Rp. {{number_format($produk['harga_jual'])}}</td>
                                <td class="text-center">Rp. {{number_format($produk['harga_beli'])}}</td>
                                <td class="text-center">{{number_format($produk['stok'])}}</td>
                                <td class="text-center">{{number_format($produk['stok_minimal'])}}</td>
                                <td class="text-center">
                                    <p class="badge {{$produk['is_active'] ? 'badge-success' : 'badge-danger'}}">
                                        {{$produk['is_active'] ? 'Aktif' : 'Tidak Aktif'}}
                                    </p>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-xs"
                                        onclick="updateForm('{{$url}}/{{$produk['id']}}','{{$produk}}')" type="button"
                                        data-toggle="modal" data-target="#modal"><i
                                            class="fa fa-pen-to-square"></i></button>
                                    <form action="/produk/{{$produk['id']}}" class="d-inline"
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

@include('produk.form')

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
      responsive: false,
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
    $("#modal-form .modal-title").text("Tambah Produk");

    $("#modal-form form")[0].reset();
    $("#modal-form form").attr("action", url);
    $("#modal-form [name=_method]").val("post");
    $("modal-form [name=nama_produk]").focus();
}

function updateForm(url, data) {
    $produk = JSON.parse(data);
    $("#modal-form").modal("show");
    $("#modal-form .modal-title").text("Edit Produk");

    $("#modal-form form")[0].reset();
    $("#modal-form form").attr("action", url);
    $("#modal-form [name=_method]").val("put");
    $("modal-form [name=id_produk]").focus();

    $("#modal-form [name=nama_produk]").val($produk.nama_produk);
    // $("#modal-form select[name=id_kategori]").val($produk.id_kategori);
    $("#modal-form select[name=id_kategori]").val($produk.id_kategori).trigger('change');
    $("#modal-form [name=merk]").val($produk.merk);
    $("#modal-form [name=harga_jual]").val($produk.harga_jual);
    $("#modal-form [name=harga_beli]").val($produk.harga_beli);
    $("#modal-form [name=stok]").val($produk.stok);
    $("#modal-form [name=stok_minimal]").val($produk.stok_minimal);
    // $("#modal-form [name=is_active]").val($produk.nama_produk);

}
</script>
@endpush