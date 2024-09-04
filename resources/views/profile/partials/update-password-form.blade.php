<!-- Modals add menu -->
<div id="modal-form-change-password" class="modal fade modal-form-user" tabindex="-1"
  aria-labelledby="modal-form-change-password-label" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="modal-form" action="{{ route('password.update') }}" method="post">
        @csrf
        @method('put')

        <div class="modal-header">
          <h5 class="modal-title" id="modal-form-change-password-label">Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
              id="current_password" placeholder="Enter Current Password" name="current_password">
            @error('current_password')
              <a style="color: red">
                <small>
                  {{ $message }}
                </small>
              </a>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
              placeholder="Enter New Password" name="password">
            @error('password')
              <a style="color: red">
                <small>
                  {{ $message }}
                </small>
              </a>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
              id="password_confirmation" placeholder="New Password Confirmation" name="password_confirmation">
            @error('password_confirmation')
              <a style="color: red">
                <small>
                  {{ $message }}
                </small>
              </a>
            @enderror
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary ">Save</button>
        </div>
      </form>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
