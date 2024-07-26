<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Role') }}
    </h2>
  </x-slot>

  <div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create') }}
      </h2>
      <div class="bg-slate-300 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form action="{{ route('role.store') }}" method="POST">
            @csrf
            <div>
              <x-input-label for="name" :value="__('Role Name')" />
              <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" route="name"
                :value="old('name')" />
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mt-4">
              <x-input-label for="guard_name" :value="__('Guard Name')" />
              <x-text-input id="guard_name" class="block mt-1 w-full" type="text" name="guard_name"
                route="guard_name" :value="old('guard_name')" />
              <x-input-error :messages="$errors->get('guard_name')" class="mt-2" />
            </div>
            <div class="mt-3">
              <div class="form-check form-switch form-switch-right form-switch-md">
                <label for="permission[]" class="form-label">Permission</label>
                <select class="form-control choices multiple-remove" id="permissions[]" name="permissions[]"
                  multiple="multiple">
                  @foreach ($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                  @endforeach
                </select>
              </div>
              <x-input-error :messages="$errors->get('permission')" class="mt-2" />
            </div>
            <x-primary-button class="mt-4">
              {{ __('Submit') }}
            </x-primary-button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-slate-300 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <table class="table table-hover table-nowrap mb-0" id="table1">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Guard</th>
                <th scope="col">Permission</th>
                <th scope="col" class="col-1"></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($roles as $role)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $role->name }}</td>
                  <td>
                    <span class="badge bg-light-success">{{ $role->guard_name }}</span>
                  </td>
                  <td>
                    @forelse ($role->permissions as $permission)
                      <span class="badge bg-light-success">{{ $permission->name }}</span>
                    @empty
                      <span class="badge bg-light-danger">No Permissions</span>
                    @endforelse
                  </td>
                  <td class="text-center" style="width: 100px;">

                    {{-- <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-route-{{ $permission->id }}"
                      class="btn icon btn-primary" title="Edit"><i class="bi bi-pencil"></i></a> --}}
                    {{-- <a class="btn icon btn-danger" title="Delete" onclick="showSweetAlert('{{ $permission->id }}')">
                      <i class="bi bi-x-lg"></i>
                    </a> --}}

                    {{-- @include('components.form.modal.route.edit')
                    @include('components.form.modal.route.delete') --}}

                  </td>
                </tr>
              @empty
                <tr>
                  <th colspan="5" class="text-center">No data to display</th>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
