<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'E-Lang') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{asset('template-admin-lte')}}/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="{{asset('template-admin-lte')}}/dist/css/adminlte.min.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <script src="{{asset('template-admin-lte')}}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('template-admin-lte')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('template-admin-lte')}}/dist/js/adminlte.min.js"></script>
    </body>
</html>
