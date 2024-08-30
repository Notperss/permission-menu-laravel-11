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


    {{-- <h4 class="mb-1">Permissions List</h4>

    <p class="mb-6">A role provided access to predefined menus and features so that depending on assigned role an
      administrator can have access to what user needs.</p>
    <!-- Role cards -->
    <div class="row g-6"> --}}

    {{-- @foreach ($Permissions as $role)
        <div class="col-xl-4 col-lg-6 col-md-6 my-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-normal mb-0 text-body">Total {{ $role->users->count() }} users</h6>
                <a onclick="showSweetAlert('{{ $role->id }}')" class="justify-content-end" title="delete role">
                  <i class="bx bx-x"></i>
                </a>
              </div>
              <form id="deleteForm_{{ $role->id }}" action="{{ route('role.destroy', $role->id) }}" method="POST">
                @method('DELETE')
                @csrf
              </form>
              <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                  <h5 class="mb-1">{{ $role->name }}</h5>
                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editRoleModal-{{ $role->id }}"
                    class="role-edit-modal"><span>Edit Role</span></a>
                  @include('management-access.role.modal-edit')
                </div>
                <a href="javascript:void(0);"><i class="bx bx-copy bx-md text-muted"></i></a>
              </div>
            </div>
          </div>
        </div>
      @endforeach --}}


    {{-- <div class="col-xl-4 col-lg-6 col-md-6 my-3">
      <div class="card h-100">
        <div class="row h-100">
          <div class="col-sm-5">
            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-4 ps-6">
              <img src="{{ asset('sneat/assets/img/illustrations/man-with-laptop-light.png') }}" class="img-fluid"
                alt="Image" width="120" data-app-light-img="illustrations/lady-with-laptop-light.png"
                data-app-dark-img="illustrations/lady-with-laptop-dark.png">
            </div>
          </div>
          <div class="col-sm-7">
            <div class="card-body text-sm-end text-center ps-sm-0">
              <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">Add New Role</button>
              <p class="mb-0"> Add new role, <br> if it doesn't exist.</p>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    {{-- <div class="col-12">
        <h4 class="mt-6 mb-1">Total users with their roles</h4>
        <p class="mb-0">Find all of your company’s administrator accounts and their associate roles.</p>
      </div> --}}
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
                      <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-permission-{{ $permission->id }}"
                        class="btn btn-icon btn-secondary text-white">
                        <span class="tf-icons bx bx-edit bx-22px"></span>
                      </a>
                      <a onclick="showSweetAlert('{{ $permission->id }}')" title="Delete"
                        class="btn btn-icon btn-danger text-white">
                        <span class="tf-icons bx bx-x bx-22px"></span>
                      </a>
                    </div>

                    <form id="deleteForm_{{ $permission->id }}"
                      action="{{ route('permission.destroy', $permission->id) }}" method="POST">
                      @method('DELETE')
                      @csrf
                    </form>

                    @include('management-access.permission.modal-edit')
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
@push('after-script')
@endpush
