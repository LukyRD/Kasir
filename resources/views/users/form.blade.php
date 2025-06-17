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
              <label for="name" class="control-label">Nama User</label>
              <input type="text" name="name" id="name" class="form-control">
            </div>
  
            <div class="form-group my-1">
              <label for="email" class="control-label">Email</label>
              <input type="email" name="email" id="email" class="form-control">
            </div>
  
            <div class="form-group mt-1 d-flex flex-column">
              <div class="d-flex align-items-center">
                <label for="" class="mr-4">Admin?</label>
                <input type="checkbox" name="level" id="level">
              </div>
              <small class="text-secondary">Status jika Admin diceklis, jika Kasir tidak diceklis</small>
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