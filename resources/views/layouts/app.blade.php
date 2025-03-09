<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('libraries.styles')

    @viteReactRefresh
    @vite('resources/js/app.jsx')

</head>
<body>

    <!-- partial:partials/_navbar.html -->

    @include('Components.nav')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->

        @include('Components.sidebar')
        <!-- partial -->
        <div class="main-panel">

          @if ($errors->any())
            <div class="content-wrapper" style="flex-grow:unset; padding:2.25rem 2.25rem 0 2.25rem">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
          @endif

          @include('flash::message')


          @yield('content')
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          @include('Components.footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @include('libraries.scripts')
  </body>
</html>
