{{-- <x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Profile') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
          @include('profile.partials.update-profile-information-form')
        </div>
      </div>

      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
          @include('profile.partials.update-password-form')
        </div>
      </div>

      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
          @include('profile.partials.delete-user-form')
        </div>
      </div>
    </div>
  </div>
</x-app-layout> --}}
@extends('layouts.app')
@section('title', 'Profile')
@section('content')
  <!-- Content -->
  @if ($errors->updatePassword->any())

    @foreach ($errors->updatePassword->all() as $error)
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $error }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endforeach

  @endif

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

    <div class="row">
      <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Profile Details</h5>
          <!-- Account -->
          <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
              <img src="{{ asset(auth()->user()->avatar ?? 'sneat/assets/img/avatars/default.jpg') }}" alt="user-avatar"
                class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
              <div class="button-wrapper">
                {{-- <label for="upload" class="btn btn-primary me-2 mb-4">
                  <span class="d-none d-sm-block">Upload new photo</span>
                  <i class="bx bx-upload d-block d-sm-none"></i>
                  <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                </label>
                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                  <i class="bx bx-reset d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Reset</span>
                </button>

                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> --}}
                <div class="flex-grow-1 mt-3 mt-lg-5">
                  <div
                    class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                    <div class="user-profile-info">
                      <h4 class="mb-2 mt-lg-7">{{ auth()->user()->name }}</h4>
                      <ul
                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                        <li class="list-inline-item">
                          <i class='bx bx-palette me-2 align-top'></i><span
                            class="fw-medium">{{ auth()->user()->getRoleNames()->first() ?? '' }}</span>
                        </li>
                        <li class="list-inline-item">
                          <i class='bx bx-map me-2 align-top'></i><span class="fw-medium">Indonesia</span>
                        </li>
                        <li class="list-inline-item">
                          <i class='bx bx-calendar me-2 align-top'></i><span class="fw-medium"> Joined
                            {{ Carbon\Carbon::parse(auth()->user()->created_at)->translatedFormat('d F Y') }}</span>
                        </li>
                      </ul>
                    </div>
                    {{-- <a href="javascript:void(0)" class="btn btn-primary mb-1">
                      Change Password
                    </a> --}}
                    <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal"
                      data-bs-target="#modal-form-change-password">
                      <i class="bi bi-plus-lg"></i>
                      Change Password
                    </button>
                    @include('profile.partials.update-password-form')

                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr class="my-0" />
          <div class="card-body">
            {{-- <div class="row">

              <div class="col-xl-4 col-lg-5 col-md-5">
                <!-- About User -->
                <div class="card mb-6">
                  <div class="card-body">
                    <small class="card-text text-uppercase text-muted small">About</small>
                    <ul class="list-unstyled my-3 py-1">
                      <li class="d-flex align-items-center mb-4"><i class="bx bx-user"></i><span
                          class="fw-medium mx-2">Full
                          Name:</span> <span>{{ auth()->user()->name }}</span></li>
                      <li class="d-flex align-items-center mb-4"><i class="bx bx-envelope"></i><span
                          class="fw-medium mx-2">Email:</span> <span>{{ auth()->user()->email }}</span></li>
                      <li class="d-flex align-items-center mb-4"><i class="bx bx-check"></i><span
                          class="fw-medium mx-2">Status:</span> <span>
                          @if (auth()->user()->email_verified_at)
                            Active
                          @else
                            Inactive
                          @endif
                        </span></li>
                      <li class="d-flex align-items-center mb-4"><i class="bx bx-crown"></i><span
                          class="fw-medium mx-2">Role:</span>
                        <span>{{ auth()->user()->getRoleNames()->first() ?? '' }}</span>
                      </li>

                    </ul>
                  </div>
                </div>
                <!--/ About User -->
                <!--/ Profile Overview -->
              </div>

              <div class="col-xl-4 col-lg-5 col-md-5">
                <!-- Contact User -->
                <div class="card mb-6">
                  <div class="card-body">
                    <small class="card-text text-uppercase text-muted small">Contacts</small>
                    <ul class="list-unstyled my-3 py-1">
                      <li class="d-flex align-items-center mb-4"><i class="bx bx-phone"></i><span
                          class="fw-medium mx-2">Contact:</span> <span>(123) 456-7890</span></li>
                      <li class="d-flex align-items-center mb-4"><i class="bx bx-chat"></i><span
                          class="fw-medium mx-2">Skype:</span> <span>john.doe</span></li>
                      <li class="d-flex align-items-center mb-4"><i class="bx bx-envelope"></i><span
                          class="fw-medium mx-2">Email:</span> <span>john.doe@example.com</span></li>
                    </ul>
                  </div>
                </div>
                <!--/ Contact User -->
              </div>

              <div class="col-xl-4 col-lg-5 col-md-5">
                <!-- Profile Overview -->
                <div class="card mb-6">
                  <div class="card-body">
                    <small class="card-text text-uppercase text-muted small">Overview</small>
                    <ul class="list-unstyled mb-0 mt-3 pt-1">
                      <li class="d-flex align-items-center mb-4"><i class="bx bx-check"></i><span
                          class="fw-medium mx-2">Task
                          Compiled:</span> <span>13.5k</span></li>
                      <li class="d-flex align-items-center mb-4"><i class="bx bx-star"></i><span
                          class="fw-medium mx-2">Projects
                          Compiled:</span> <span>146</span></li>
                      <li class="d-flex align-items-center"><i class="bx bx-user"></i><span
                          class="fw-medium mx-2">Connections:</span> <span>897</span></li>
                    </ul>
                  </div>
                </div>
                <!--/ Profile Overview -->
              </div>

            </div> --}}
            <div class="row">

              <div class="col-xl-12">
                <!-- About User -->
                <div class="card mb-6">
                  <div class="card-body">
                    <small class="card-text text-uppercase text-muted small">About</small>
                    <ul class="list-unstyled my-3 py-1">
                      <li class="d-flex align-items-center mb-4"><i class="bx bx-user"></i><span
                          class="fw-medium mx-2">Full
                          Name:</span> <span>{{ auth()->user()->name }}</span></li>
                      <li class="d-flex align-items-center mb-4"><i class="bx bx-envelope"></i><span
                          class="fw-medium mx-2">Email:</span> <span>{{ auth()->user()->email }}</span></li>
                      <li class="d-flex align-items-center mb-4"><i class="bx bx-check"></i><span
                          class="fw-medium mx-2">Status:</span> <span>
                          @if (auth()->user()->email_verified_at)
                            Active
                          @else
                            Inactive
                          @endif
                        </span></li>
                      <li class="d-flex align-items-center mb-4"><i class="bx bx-crown"></i><span
                          class="fw-medium mx-2">Role:</span>
                        <span>{{ auth()->user()->getRoleNames()->first() ?? '' }}</span>
                      </li>

                    </ul>
                  </div>
                </div>
                <!--/ About User -->
                <!--/ Profile Overview -->
              </div>

            </div>
          </div>
          <!-- /Account -->
        </div>

      </div>
    </div>
  </div>
  <!-- / Content -->

@endsection
