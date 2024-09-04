@extends('layouts.app')
@section('title', 'Permissions')
@section('content')
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Basic Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard.index') }}">Roles & Permissions</a>
        </li>
        <li class="breadcrumb-item active">Permissions</li>
      </ol>
    </nav>
    <!-- Basic Breadcrumb -->

    <div class="col-12">

      <!-- Basic Bootstrap Table -->
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-normal mb-0 text-body">Permissions </h4>
            <button type="button" class="btn btn-primary btn-md " data-bs-toggle="modal"
              data-bs-target="#modal-form-add-permission">
              Add
            </button>
          </div>
        </div>
        <div class="table-responsive text-nowrap mx-2">
          <table class="table" id="table1">
            <thead>
              <tr>
                <th>#</th>
                <th>User</th>
                <th>Guard Name</th>
                <th>Assigned To</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($permissions as $permission)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $permission->name }}</td>
                  <td>{{ $permission->guard_name }}</td>
                  <td>
                    @foreach ($permission->roles as $role)
                      <span class="badge bg-label-info me-1">{{ $role->name }}</span>
                    @endforeach
                  </td>
                  <td>
                    <div class="demo-inline-spacing">

                      @can('permission.update')
                        <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-permission-{{ $permission->id }}"
                          class="btn btn-icon btn-secondary text-white">
                          <span class="tf-icons bx bx-edit bx-22px"></span>
                        </a>
                        @include('management-access.permission.modal-edit')
                      @endcan

                      @can('permission.destroy')
                        <a onclick="showSweetAlert('{{ $permission->id }}')" title="Delete"
                          class="btn btn-icon btn-danger text-white">
                          <span class="tf-icons bx bx-x bx-22px"></span>
                        </a>
                        <form id="deleteForm_{{ $permission->id }}"
                          action="{{ route('permission.destroy', $permission->id) }}" method="POST">
                          @method('DELETE')
                          @csrf
                        </form>
                      @endcan

                    </div>
                  </td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
      <!--/ Basic Bootstrap Table -->

    </div>
  </div>
  <!--/ Role cards -->

  <!-- Add Role Modal -->
  @include('management-access.permission.modal-create')
  <!--/ Add Role Modal -->

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
