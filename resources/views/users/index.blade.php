@extends('layouts.app')
@section('content-title', 'User')
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
                <button id="tambah" type="button" class="btn btn-dark btn-sm mb-3"
                    onclick="addForm('{{route('users.store')}}')">
                    <i class="fa-regular fa-circle-plus mr-1"></i> Tambah</button>
                <div class="table-responsive">
                    <table id="" class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr class="text-center">
                                <th width='10%'>No</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th width='15%'><i class="fa-solid fa-gear"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $user)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$user['name']}}</td>
                                <td class="text-center">{{$user['email']}}</td>
                                <td class="text-center">
                                    <p class="badge {{$user['level'] ? 'badge-warning' : 'badge-info'}}">
                                        {{$user['level'] ? 'Kasir' : 'Admin'}}
                                    </p>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-xs"
                                        onclick="resetPass('{{$url}}/{{$user['id']}}', '{{$user['id']}}')"
                                        type="button"><i class="fa fa-unlock"></i></button>
                                    <button class="btn btn-success btn-xs"
                                        onclick="updateForm('{{$url}}/{{$user['id']}}', '{{$user}}')" type="button"><i
                                            class="fa fa-pen-to-square"></i></button>
                                    <form action="/users/{{$user['id']}}" class="d-inline" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-xs" type="submit"
                                            onclick="return confirm('Yakin?')"><i class="fa fa-trash"></i></button>
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

@include('users.form')
@include('users.reset-password')

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
    $("#modal-form .modal-title").text("Tambah User");

    $("#modal-form form")[0].reset();
    $("#modal-form form").attr("action", url);
    $("#modal-form [name=_method]").val("post");
    $("modal-form [name=nama_kategori]").focus();
}

function updateForm(url, data) {
    $users = JSON.parse(data);
    $("#modal-form").modal("show");
    $("#modal-form .modal-title").text("Edit User");

    $("#modal-form form")[0].reset();
    $("#modal-form form").attr("action", url);
    $("#modal-form [name=_method]").val("put");
    $("modal-form [name=name]").focus();
    $("#modal-form [name=name]").val($users.name);
    $("#modal-form [name=email]").val($users.email);
    $("#modal-form [name=level]").prop("checked", $users.level == 0);
}

function resetPass(url, id){
    $("#modal-reset").modal("show");

    $("#modal-form form")[0].reset();
    $("#modal-form form").attr("action", url);
    $("#modal-reset [name=id]").val(id);
}
</script>
@endpush