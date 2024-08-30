@extends('layouts.app')
@section('title', 'Route')
@section('content')
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Basic Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard.index') }}">Access Settings</a>
        </li>
        <li class="breadcrumb-item active">Route</li>
      </ol>
    </nav>
    <!-- Basic Breadcrumb -->

    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center ">
          <h4 class="fw-normal mb-0 text-body">Route</h4>
          <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal"
            data-bs-target="#modal-form-add-route">
            <i class="bi bi-plus-lg"></i>
            Add
          </button>
        </div>
      </div>
      <div class="table-responsive text-nowrap mx-2">
        <table class="table" id="table1">
          <thead>
            <tr>
              <th>Route</th>
              <th>Permission</th>
              <th>Description</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($routes as $route)
              <tr>
                <td>{{ $route->route }}</td>
                <td>{{ $route->permission_name }}</td>
                <td>{{ $route->description }}</td>
                <td>
                  @if ($route->status)
                    <span class="badge bg-label-primary me-1">Show</span>
                  @else
                    <span class="badge bg-label-danger me-1">Hide</span>
                  @endif
                </td>
                <td>
                  <div class="demo-inline-spacing">
                    <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-route-{{ $route->id }}"
                      class="btn btn-icon btn-secondary text-white">
                      <span class="tf-icons bx bx-edit bx-22px"></span>
                    </a>
                    <a onclick="showSweetAlert('{{ $route->id }}')" title="Delete"
                      class="btn btn-icon btn-danger text-white">
                      <span class="tf-icons bx bx-x bx-22px"></span>
                    </a>
                  </div>

                  <form id="deleteForm_{{ $route->id }}" action="{{ route('route.destroy', $route->id) }}"
                    method="POST">
                    @method('DELETE')
                    @csrf
                  </form>

                  @include('management-access.route.modal-edit')
                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->

    @include('management-access.route.modal-create')

  </div>
  <!-- / Content -->
  <script>
    function showSweetAlert(getId) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          // If the user clicks "Yes, delete it!", submit the corresponding form
          document.getElementById('deleteForm_' + getId).submit();
        }
      });
    }
  </script>
@endsection
