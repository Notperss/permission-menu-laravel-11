<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default"
  data-assets-path="{{ asset('sneat/assets/') }}" data-template="vertical-menu-template-free" data-style="light">

<head>
  {{-- meta --}}
  {{-- @include('includes.meta') --}}

  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Application | @yield('title')</title>

  <meta name="description" content="" />


  {{-- styles --}}
  @stack('before-style')
  @include('includes.style')
  @stack('after-style')

</head>

<body>

  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar  ">

    <div class="layout-container">
      {{-- menu --}}
      {{-- @include('components.web.menu') --}}

      <x-menu />

      <!-- Layout container -->
      <div class="layout-page">
        @include('components.validation-errors')

        {{-- navbar --}}
        @include('components.web.navbar')

        @include('sweetalert::alert')
        <!-- Content wrapper -->
        <div class="content-wrapper">

          @yield('content')

          {{-- footer --}}
          @include('components.web.footer')

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  {{-- JS --}}
  @stack('before-script')
  @include('includes.script')
  @stack('after-script')

</body>

</html>

<!-- beautify ignore:end -->
