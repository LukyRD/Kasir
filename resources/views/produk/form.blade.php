{{-- Modal Tambah Dan Edit --}}
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
  <div class="modal-dialog" role="document">
    <form action="" method="post" class="form-horizontal">
      @csrf
      @method('post')

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- .modal-header --}}
        <div class="modal-body">
          <div class="form-group my-1">
            <label for="nama_produk" class="control-label">Nama Produk</label>
            <input type="text" name="nama_produk" id="nama_produk" class="form-control">
          </div>

          <div class="form-group my-1">
            <label for="id_kategori" class="control-label">Kategori</label>
            <select name="id_kategori" id="id_kategori" class="form-control">
              <option value="">Pilih Kategori</option>
              @foreach ($kategori as $item)
              <option id="opsi" value="{{$item['id']}}">{{$item['nama_kategori']}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group my-1">
            <label for="merk" class="control-label">Merk</label>
            <input type="text" name="merk" id="merk" class="form-control">
          </div>

          <div class="form-group my-1">
            <label for="harga_jual" class="control-label">Harga Jual</label>
            <input type="number" name="harga_jual" id="harga_jual" class="form-control">
          </div>

          <div class="form-group my-1">
            <label for="harga_beli" class="control-label">Harga Beli</label>
            <input type="number" name="harga_beli" id="harga_beli" class="form-control">
          </div>

          <div class="form-group my-1">
            <label for="stok" class="control-label">Stok</label>
            <input type="number" name="stok" id="stok" class="form-control">
          </div>

          <div class="form-group my-1">
            <label for="stok_minimal" class="control-label">Stok Minimal</label>
            <input type="number" name="stok_minimal" id="stok_minimal" class="form-control">
          </div>

          <div class="form-group mt-1 d-flex flex-column">
            <div class="d-flex align-items-center">
              <label for="" class="mr-4">Produk Aktif?</label>
              <input type="checkbox" name="is_active" id="is_active">
            </div>
            <small class="text-secondary">Jika aktif maka akan ditampilkan di halaman kasir</small>
          </div>
          {{-- .form-group --}}
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
          </div>
          {{-- .modal-footer --}}
        </div>
        {{-- .modal-body --}}
      </div>
      {{-- .modal-content --}}
    </form>
  </div>
  {{-- .modal-dialog --}}
</div>
{{-- .modal --}}