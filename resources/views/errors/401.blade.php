@extends('layouts.auth')
@section('title', 404)
@section('content')
  <!-- Content -->

  <!-- Error -->
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h2 class="mb-2 mx-2">You are not authorized! 🔐</h2>
      <p class="mb-4 mx-2">You don’t have permission to access this page. Go Home!</p>
      <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Back to home</a>
      <div class="mt-3">
        <img src="{{ asset('sneat/assets/img/illustrations/girl-with-laptop.png') }}" alt="page-misc-error-light"
          width="500" class="img-fluid"
          data-app-dark-img="{{ asset('sneat/assets/img/illustrations/page-misc-error-dark.png') }}"
          data-app-light-img="{{ asset('sneat/assets/img/illustrations/page-misc-error-dark.png') }}" />
      </div>
    </div>
  </div>
  <!-- /Error -->

  <!-- / Content -->
@endsection
@push('after-style')
  <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/pages/page-misc.css') }}" />
@endpush
