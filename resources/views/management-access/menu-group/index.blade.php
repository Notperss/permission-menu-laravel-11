@extends('layouts.app')
@section('title', 'Menu Group')
@section('content')
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Basic Breadcrumb -->
    <nav aria-label="breadcrumb float-left">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard.index') }}">Access Settings</a>
        </li>
        <li class="breadcrumb-item active">Menu</li>
      </ol>
    </nav>
    <!-- Basic Breadcrumb -->

    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center ">
          <h4 class="fw-normal mb-0 text-body">Menu Group</h4>

          @can('menu-group.store')
            <button type="button" class="btn btn-primary btn-md " data-bs-toggle="modal"
              data-bs-target="#modal-form-add-menu">
              <i class="bi bi-plus-lg"></i>
              Add
            </button>
          @endcan

        </div>
      </div>
      <div class="table-responsive text-nowrap mx-2">
        <table class="table" id="table1">
          <thead>
            <tr>
              <th>Name</th>
              <th>Permission</th>
              <th>Icon</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($menuGroups as $menuGroup)
              <tr>
                <td>{{ $menuGroup->name }}</td>
                <td>{{ $menuGroup->permission_name }}</td>
                <td><i class='bx {{ $menuGroup->icon }}'></i></td>
                <td>
                  @if ($menuGroup->status)
                    <span class="badge bg-label-primary me-1">Show</span>
                  @else
                    <span class="badge bg-label-danger me-1">Hide</span>
                  @endif
                </td>
                <td>
                  <div class="demo-inline-spacing">
                    @can('menu-item.index')
                      <a href="{{ route('menu.item.index', $menuGroup) }}" class="btn btn-icon btn-primary">
                        <span class="tf-icons bx bx-plus bx-22px"></span>
                      </a>
                    @endcan

                    @can('menu-group.update')
                      <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-menu-{{ $menuGroup->id }}"
                        class="btn btn-icon btn-secondary text-white">
                        <span class="tf-icons bx bx-edit bx-22px"></span>
                      </a>
                      @include('management-access.menu-group.modal-edit')
                    @endcan

                    @can('menu-group.destroy')
                      <a onclick="showSweetAlert('{{ $menuGroup->id }}')" title="Delete"
                        class="btn btn-icon btn-danger text-white">
                        <span class="tf-icons bx bx-x bx-22px"></span>
                      </a>
                      <form id="deleteForm_{{ $menuGroup->id }}"
                        action="{{ route('menu.destroy', encrypt($menuGroup->id)) }}" method="POST">
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

    @include('management-access.menu-group.modal-create')

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
