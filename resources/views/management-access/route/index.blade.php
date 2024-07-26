<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Route') }}
    </h2>
  </x-slot>

  <div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create') }}
      </h2>
      <div class="bg-slate-300 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form action="{{ route('route.store') }}" method="POST">
            @csrf
            <div>
              <x-input-label for="route" :value="__('Route')" />
              <select class="form-control choices" id="route" name="route">
                @foreach ($facadesRoutes as $facadesRoute)
                  @if (!blank($facadesRoute->getName()))
                    <option value="{{ $facadesRoute->getName() }}">{{ $facadesRoute->getName() }}</option>
                  @endif
                @endforeach
              </select>
              <x-input-error :messages="$errors->get('route')" class="mt-2" />
            </div>
            <div class="mt-4">
              <x-input-label for="permission_name" :value="__('permission_name')" />
              <select class="form-control choices" id="permission_name" name="permission_name">
                @foreach ($permissions as $permission)
                  <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                @endforeach
              </select>
              <x-input-error :messages="$errors->get('permission_name')" class="mt-2" />
            </div>
            <div class="mt-4">
              <x-input-label for="description" :value="__('description')" />
              <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                rsoute="description" :value="old('description')" />
              <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="mt-3">
              <div class="form-check form-switch form-switch-right form-switch-md">
                <label for="status" class="form-label">Status</label>
                <input class="form-check-input code-switcher" type="checkbox" id="tables-small-showcode" name="status"
                  value="1">
              </div>
              <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
                <th scope="col">Route</th>
                <th scope="col">Permission</th>
                <th scope="col">Status</th>
                <th scope="col">Description</th>
                <th scope="col" class="col-1"></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($routes as $route)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $route->route }}</td>
                  <td>
                    <span class="badge bg-light-success">{{ $route->permission_name }}</span>
                  </td>
                  <td>
                    @if ($route->status)
                      <span class="badge bg-light-success">Enable</span>
                    @else
                      <span class="badge bg-light-danger">Disable</span>
                    @endif
                  </td>
                  <td>{{ $route->description }}</td>
                  <td class="text-center" style="width: 100px;">
                    {{-- <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-route-{{ $route->id }}"
                      class="btn icon btn-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                    <a class="btn icon btn-danger" title="Delete" onclick="showSweetAlert('{{ $route->id }}')">
                      <i class="bi bi-x-lg"></i>
                    </a>

                    @include('components.form.modal.route.edit')
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
