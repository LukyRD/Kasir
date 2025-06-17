<div class="modal" id="modal-reset" tabindex="-1" role="dialog">
  <form action="{{route('reset-password')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Ketika Password di reset, maka password User tersebut akan menjadi default yaitu <strong>"12345678"</strong>.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Reset Password</button>
      </div>
    </div>
  </div>
</form>
</div>