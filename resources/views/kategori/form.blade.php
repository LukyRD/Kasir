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
          <div class="form-group row">
            <label for="nama_kategori" class="col-md-2 col-md-offset-1 control-label">Kategori</label>
            <div class="col-md-9">
              <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required autofocus>
            </div>
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