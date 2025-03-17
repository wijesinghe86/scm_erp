<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('libraries.styles')



</head>

<body>
    <div class="container-fluid page-body-wrapper">
        @yield('content')
    </div>
    @include('libraries.scripts')
</body>

</html>
