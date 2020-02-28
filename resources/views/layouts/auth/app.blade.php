<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Church Record System') }}</title>
        <!-- Styles -->
        @include('layouts.styles')
        @yield('styles')
        @include('layouts.scripts')
    </head>
    <body>
        <div id="app">
            <div class="wrapper">
                <div class="main-panel">
                    <div class="auth-container">
                        @yield('content')
                        <div class="background"/>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scripts -->
    </body>
</html>
