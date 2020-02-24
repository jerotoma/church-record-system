<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @include('layouts.scripts')

        <!-- Styles -->
        @include('layouts.styles')
    </head>
    <body>
        <div id="app">
            <div class="wrapper nav-open">
                <notifications></notifications>
                @include('layouts.sidebar-navigation')
                <div class="main-panel">
                    @include('layouts.top-navigation')
                    @yield('content')
                    <content-footer-component></content-footer-component>
                </div>
            </div>
        </div>
    </body>
</html>
