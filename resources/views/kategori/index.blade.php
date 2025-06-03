<x-layout>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button id="tambah" type="button" class="btn btn-dark btn-sm mb-3" onclick="addForm('{{$url}}')">
                            <i class="fa-regular fa-circle-plus mr-1"></i> Tambah</button>
                        <div class="table-responsive">
                            <table id="" class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th width='10%'>No</th>
                                        <th>Kategori</th>
                                        <th width='15%'><i class="fa-solid fa-gear"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $kategori)
                                    @php
                                        $id=$kategori['id_kategori'];
                                        $nama=$kategori['nama_kategori'];
                                    @endphp               
                                    <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$kategori['nama_kategori']}}</td>
                                            <td>
                                            <button class="btn btn-success btn-xs" onclick="updateForm('{{$url}}/{{$id}}', '{{$nama}}')" type="button" data-toggle="modal" data-target="#modal"><i class="fa fa-pen-to-square"></i></button>
                                            <form action="/kategori/{{$kategori['id_kategori']}}" class="d-inline" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" onclick="return confirm('Yakin?')"></i></button>
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
    </div>
    <!-- /.container-fluid -->
    
    
</x-layout>
@include('kategori.form')

