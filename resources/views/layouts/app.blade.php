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
    </head>
    <body>
        <div id="app">
            <dashboard-layout-component>
                @include('layouts.sidebar-nav')
                <div class="main-panel">
                    @include('layouts.navbar')
                    @yield('content')
                    <footer-component></footer-component>
                </div>
            </dashboard-layout-component>
            @include('layouts.global-spinner')
        </div>
        <!-- Scripts -->
        @include('layouts.scripts')
    </body>
</html>
