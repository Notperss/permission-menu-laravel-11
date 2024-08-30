@extends('layouts.app')
@section('title', 'Users')
@section('content')
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Basic Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard.index') }}">Access Settings</a>
        </li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
    </nav>
    <!-- Basic Breadcrumb -->

    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center ">
          <h4 class="fw-normal mb-0 text-body">Users</h4>
          <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal"
            data-bs-target="#modal-form-add-user">
            <i class="bi bi-plus-lg"></i>
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
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($users as $user)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  @foreach ($user->roles as $role)
                    <span class="badge bg-label-info me-1">{{ $role->name }}</span>
                  @endforeach
                </td>
                <td>
                  @if (!blank($user->email_verified_at))
                    <span class="badge bg-label-primary me-1">Active</span>
                  @else
                    <span class="badge bg-label-danger me-1">Inactive</span>
                  @endif
                </td>
                <td>
                  <div class="demo-inline-spacing">
                    <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-user-{{ $user->id }}"
                      class="btn btn-icon btn-secondary text-white">
                      <span class="tf-icons bx bx-edit bx-22px"></span>
                    </a>
                    <a onclick="showSweetAlert('{{ $user->id }}')" title="Delete"
                      class="btn btn-icon btn-danger text-white">
                      <span class="tf-icons bx bx-x bx-22px"></span>
                    </a>
                  </div>

                  <form id="deleteForm_{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}"
                    method="POST">
                    @method('DELETE')
                    @csrf
                  </form>

                  @include('management-access.user.modal-edit')
                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->
    @include('management-access.user.modal-create')


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
