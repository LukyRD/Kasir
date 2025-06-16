@extends('layouts.app')
@section('content-title', 'Kasir')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <form action="{{route('kasir.store')}}" method="post" id="form-kasir">
                @csrf
                <div id="data-hidden"></div>
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <h4>Form Kasir</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="w-100">
                            <label for="select2">Nama Produk</label>
                            <select class="form-control" name="select2" id="select2"></select>
                        </div>
                        <div>
                            <label for="select2">Stok saat ini</label>
                            <input type="number" id="current_stok" class="form-control mx-1" style="width: 100px"
                                readonly>
                        </div>
                        <div>
                            <label for="select2">Qty</label>
                            <input type="number" id="qty" class="form-control" style="width: 100px" min="1">
                        </div>
                        <div>
                            <label for="select2">Harga</label>
                            <input type="number" id="harga_jual" class="form-control mx-1" style="width: 100px" min="1"
                                readonly>
                        </div>
                        <div style="padding-top: 32px;">
                            <button type="button" class="btn btn-dark" id="btn-add">Tambahkan</button>
                        </div>
                    </div>
                </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm" id="table-produk">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-body">
                    <div>
                        <label for="">Total</label>
                        <input type="number" class="form-control" name="sub_total" id="sub_total" readonly>
                    </div>
                    <div>
                        <label for="">Bayar</label>
                        <input type="number" class="form-control" name="bayar" id="bayar" min="1">
                    </div>
                    <div>
                        <label for="">Kembalian</label>
                        <input type="number" class="form-control" name="kembalian" id="kembalian" readonly>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-3 w-100">Simpan</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        // fungsi menghitung sub total
        function hitungTotal(){
            let subTotal = 0;

            $('#table-produk tbody tr').each(function(){
                const total = parseInt($(this).find('td:eq(3)').text());
            subTotal += total;
            });

            $("#sub_total").val(subTotal);

        }

        // aksi tombol tambah pada kolom qty
        $("#table-produk").on("click", ".btn-plus", function () {
            const row = $(this).closest("tr");
            let qtyEl = row.find(".qty-text");
            let qty = parseInt(qtyEl.text());
            const harga = parseInt(row.data("harga"));
            const stok = parseInt(row.data("stok"));

            // validasi stok
            if (qty + 1 > stok) {
                alert("Stok tidak mencukupi!");
                return;
            }

            qty++;
            qtyEl.text(qty);
            row.find(".total-cell").text(qty * harga);

            hitungTotal();
        });

        // aksi tombol kurang pada kolom qty
        $("#table-produk").on("click", ".btn-minus", function () {
            const row = $(this).closest("tr");
            let qtyEl = row.find(".qty-text");
            let qty = parseInt(qtyEl.text());
            const harga = parseInt(row.data("harga"));

            if (qty > 1) {
                qty--;
                qtyEl.text(qty);
                row.find(".total-cell").text(qty * harga);
                hitungTotal();
            }
        });

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
                    url: "{{route('get-data.cek-harga-jual')}}",
                    data: {
                        id:id
                    },
                    dataType: "json",
                    success: function (response) {
                        $("#harga_jual").val(response);
                    }
                });
            });

            // Aksi tombol tambahkan saat ditekan
            $("#btn-add").on("click", function () {
                const selectedId = $("#select2").val();
                const qty = $("#qty").val();
                const currentStok = $("#current_stok").val();
                const hargaJual = $("#harga_jual").val();
                const total = parseInt(qty) * parseInt(hargaJual);

                // validasi apabila tidak ada data dipilih
                if(!selectedId || !qty){
                    alert('Harap pilih data dan jumlah stoknya!');
                    return;
                }

                // Validasi stok saat input data 
                if (parseInt(qty) > parseInt(currentStok)) {
                    alert('Jumlah melebihi stok tersedia!');
                    return;
                }

                let produk = selectedProduk[selectedId];
                let exist = false;

                // tabel produk setelah menambahkan data jika sudah ada
                $('#table-produk tbody tr').each(function(){
                    const rowProduk = $(this).find("td:first").text();

                    if (rowProduk === produk.nama_produk) {
                        let currentQty = parseInt($(this).find(".qty-text").text());
                        let newQty = currentQty + parseInt(qty);

                        // Validasi stok saat data sudah ada
                        if (newQty > parseInt(currentStok)) {
                            alert("Total qty melebihi stok tersedia!");
                            exist = true; // tanda exist supaya tidak tambah baris baru
                            return false;
                        }
                        // hitung baru jika menambahkan qty dengan harga sama
                        let newTotal = newQty * parseInt(hargaJual);

                        // Update Qty
                        $(this).find(".qty-text").text(newQty);


                        // Update Harga Jual (ambil yang terbaru dari input)
                        $(this).find("td:eq(2)").text(hargaJual);

                        // Hitung total baru 
                        $(this).find(".total-cell").text(newTotal);


                        exist = true;
                        return false;
                    }

                })

                // Jika data sudah belum ada, buat baris baru
                if (!exist) {
                    const row = `
                        <tr data-id="${produk.id}" data-harga="${hargaJual}" data-stok="${currentStok}">
                            <td>${produk.nama_produk}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-secondary btn-minus">-</button>
                                <span class="mx-2 qty-text">${qty}</span>
                                <button type="button" class="btn btn-sm btn-secondary btn-plus">+</button>
                            </td>
                            <td>${hargaJual}</td>
                            <td class="total-cell">${total}</td>
                            <td>
                                <button class="btn btn-danger btn-sm btn-remove">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        `;
                    $("#table-produk tbody").append(row);
                }


                $("#select2").val(null).trigger("change");
                $("#qty").val(null);
                $("#harga_jual").val(null);
                $("#current_stok").val(null);

                hitungTotal();
            });

            // Aksi tombol remove
            $("#table-produk").on("click", ".btn-remove", function () {
                $(this).closest("tr").remove();
                hitungTotal();
            });

            // Aksi submit data di tabel
            $("#form-kasir").on("submit", function (e) {
                e.preventDefault();
                let valid = true;

                $("#data-hidden").html("");

                $("#table-produk tbody tr").each(function(index, row){
                    const namaProduk = $(row).find("td:eq(0)").text();
                    const qty = $(row).find(".qty-text").text();
                    const hargaJual = $(row).find("td:eq(2)").text();
                    const total = $(row).find("td:eq(3)").text();
                    const produkId = $(row).data('id');
                    const stok = parseInt($(row).data("stok"));

                    // validasi stok saat transaksi di submit (opsional)
                    if (qty > stok) {
                        alert("Qty untuk produk '" + namaProduk + "' melebihi stok!");
                        valid = false;
                        return false; // break each
                    }

                    const inputProduk = `<input type="hidden" name="produk[${index}][nama_produk]" value="${namaProduk}">`;
                    const inputQty = `<input type="hidden" name="produk[${index}][qty]" value="${qty}">`;
                    const inputProdukId = `<input type="hidden" name="produk[${index}][id_produk]" value="${produkId}">`;
                    const inputHargaJual = `<input type="hidden" name="produk[${index}][harga_jual]" value="${hargaJual}">`;
                    const inputTotal = `<input type="hidden" name="produk[${index}][total]" value="${total}">`;

                    $("#data-hidden").append(inputProduk, inputQty, inputProdukId, inputHargaJual, inputTotal);
                });

                // pengkondisian jika tidak valid
                if (!valid) return;

                this.submit();
            });

            // aksi menghitung kembalian saat input bayar
            $("#bayar").on("input", function () {
                const subTotal = parseInt($("#sub_total").val()) || 0;
                const bayar = parseInt($(this).val()) || 0;
                const kembalian = bayar - subTotal;

                $("#kembalian").val(kembalian);
            });

        });
</script>
@endpush