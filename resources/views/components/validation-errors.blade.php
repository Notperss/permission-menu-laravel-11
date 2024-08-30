@if ($errors->any())
  <!-- Toast with Placements -->
  <div class="bs-toast toast toast-placement-ex bg-danger top-0 start-50 translate-middle-x show m-2" role="alert"
    aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <i class='bx bx-bell me-2'></i>
      <div class="me-auto fw-medium">Error!</div>
      {{-- <small>11 mins ago</small> --}}
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
  <!-- Toast with Placements -->
@endif
