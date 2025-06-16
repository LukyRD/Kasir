@extends('layouts.app')
@section('content-title', 'Barang Masuk')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <form action="{{route('barang-masuk.store')}}" method="post" id="form-barang-masuk">
                @csrf
                <div id="data-hidden"></div>
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <h4>Form Barang Masuk</h4>
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class=" w-50">
                        <div class="form-group my-1">
                            <label for="supplier">Supplier</label>
                                <select class="form-control" name="supplier" id="select-supplier"></select>
                            @error('supplier')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group my-1">
                            <label for="no_faktur">No Faktur</label>
                            <input type="text" name="no_faktur" id="no_faktur" class="form-control"
                                value="{{old('no_faktur')}}">
                            @error('no_faktur')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="w-100">
                            <label for="select2">Nama Produk</label>
                            <select class="form-control" name="select2" id="select2"></select>
                        </div>
                        <div>
                            <label for="select2">Stok saat ini</label>
                            <input type="number" id="current_stok" class="form-control mx-1"
                                style="width: 100px" readonly>
                        </div>
                        <div>
                            <label for="select2">Qty</label>
                            <input type="number" id="qty" class="form-control" style="width: 100px" min="1">
                        </div>
                        <div>
                            <label for="select2">Harga Beli</label>
                            <input type="number" id="harga_beli" class="form-control mx-1" style="width: 100px" min="1">
                        </div>
                        <div style="padding-top: 32px;">
                            <button type="button" class="btn btn-dark" id="btn-add">Tambahkan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-sm" id="table-produk">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Qty</th>
                            <th>Harga Beli</th>
                            <th>Total</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        // Proses plugins Select2 Nama produk
            let selectedProduk = {};
            $('#select2').select2({
                theme:"bootstrap",
                placeholder:'Cari Obat...',
                ajax:{
                    url:"{{route('get-data.produk')}}",
                    dataType:'json',
                    delay:250,
                    data:(params)=>{
                        return {
                            search:params.term
                        }
                    },
                    processResults:(data)=>{
                        data.forEach(item => {
                            selectedProduk[item.id] = item;
                        });

                        return {
                                results:data.map((item)=>{
                                    return {
                                        id:item.id,
                                        text:item.nama_produk
                                    }
                                })
                            }
                    },
                    cache:true
                },
                minimumInputLength:1
            });

            let selectedSupplier = {};
            $('#select-supplier').select2({
                theme:"bootstrap",
                placeholder:'Cari Supplier...',
                ajax:{
                    url:"{{route('get-data.supplier')}}",
                    dataType:'json',
                    delay:250,
                    data:(params)=>{
                        return {
                            search:params.term
                        }
                    },
                    processResults:(data)=>{
                        data.forEach(item => {
                            selectedSupplier[item.id] = item;
                        });

                        return {
                                results:data.map((item)=>{
                                    return {
                                        id:item.id,
                                        text:item.nama
                                    }
                                })
                            }
                    },
                    cache:true
                },
                minimumInputLength:1
            });

            // Proses Select 2 mengambil data stok
            $("#select2").on("change", function (e) {
                let id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{route('get-data.cek-stok')}}",
                    data: {
                        id:id
                    },
                    dataType: "json",
                    success: function (response) {
                        $("#current_stok").val(response);
                    }
                });
            });

            // Proses Select 2 mengambil data stok
            $("#select2").on("change", function (e) {
                let id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{route('get-data.cek-harga-beli')}}",
                    data: {
                        id:id
                    },
                    dataType: "json",
                    success: function (response) {
                        $("#harga_beli").val(response);
                    }
                });
            });

            // Aksi tombol tambahkan saat ditekan
            $("#btn-add").on("click", function () {
                const selectedId = $("#select2").val();
                const qty = $("#qty").val();
                const currentStok = $("#current_stok").val();
                const hargaBeli = $("#harga_beli").val();
                const total =parseInt(qty) * parseInt(hargaBeli);

                if(!selectedId || !qty){
                    alert('Harap pilih data dan jumlah stoknya!');
                    return;
                }

                // if(qty > currentStok){
                //     alert('Jumlah melebihi stok tersedia!');
                //     return;
                // }

                let produk = selectedProduk[selectedId];
                let exist = false;

                    // tabel produk setelah menambahkan data jika data belum ada
                $('#table-produk tbody tr').each(function(){
                    const rowProduk = $(this).find("td:first").text();
                    const rowHargaBeli = parseInt($(this).find("td:eq(2)").text());

                    if (rowProduk === produk.nama_produk && rowHargaBeli === parseInt(hargaBeli)) {
                        let currentQty = parseInt($(this).find("td:eq(1)").text());
                        let newQty = currentQty + parseInt(qty);
                        // hitung baru jika menambahkan qty dengan harga sama
                        let newTotal = newQty * parseInt(hargaBeli);

                        // Update Qty
                        $(this).find("td:eq(1)").text(newQty);

                        // Update Harga Beli (ambil yang terbaru dari input)
                        $(this).find("td:eq(2)").text(hargaBeli);

                        // Hitung total baru 
                        $(this).find("td:eq(3)").text(newTotal);

                        exist = true;
                        return false;
                    }

                })

                // Jika data sudah ada
                if (!exist) {
                    const row = `
                    <tr data-id="${produk.id}">
                        <td>${produk.nama_produk}</td>
                        <td>${qty}</td>
                        <td>${hargaBeli}</td>
                        <td>${total}</td>
                        <td>
                            <button class="btn btn-danger btn-sm btn-remove">
                            <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    `
                    $("#table-produk tbody").append(row);
                }


                $("#select2").val(null).trigger("change");
                $("#qty").val(null);
                $("#harga_beli").val(null);
                $("#current_stok").val(null);

            });

            // Aksi tombol remove
            $("#table-produk").on("click", ".btn-remove", function () {
                $(this).closest("tr").remove();
            });

            // Aksi submit data di tabel
            $("#form-barang-masuk").on("submit", function (e) {
                e.preventDefault();

                $("#data-hidden").html("");

                $("#table-produk tbody tr").each(function(index, row){
                    const namaProduk = $(row).find("td:eq(0)").text();
                    const qty = $(row).find("td:eq(1)").text();
                    const hargaBeli = $(row).find("td:eq(2)").text();
                    const total = $(row).find("td:eq(3)").text();
                    const produkId = $(row).data('id');

                    const inputProduk = `<input type="hidden" name="produk[${index}][nama_produk]" value="${namaProduk}">`;
                    const inputQty = `<input type="hidden" name="produk[${index}][qty]" value="${qty}">`;
                    const inputProdukId = `<input type="hidden" name="produk[${index}][id_produk]" value="${produkId}">`;
                    const inputHargaBeli = `<input type="hidden" name="produk[${index}][harga_beli]" value="${hargaBeli}">`;
                    const inputTotal = `<input type="hidden" name="produk[${index}][total]" value="${total}">`;

                    $("#data-hidden").append(inputProduk, inputQty, inputProdukId, inputHargaBeli, inputTotal);
                });

                this.submit();
            });

        });
</script>
@endpush