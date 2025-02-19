<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >

        <!-- Scripts -->
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    @php
        $image = config('app.background');
        if ($image && file_exists(public_path($image))) {
            $backgroundCss = 'background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(250, 0, 0, 0.2)), url(' . asset($image) . ');';
            $backgroundCss .= 'background-size: cover; background-attachment: fixed;';
            $backgroundCssOverlay = 'height: 100%; width: 100%; background-color: white; opacity: 0.5; z-index: -1; position: fixed;';
        } else {
            $backgroundCss = $backgroundCssOverlay = '';
        }
    @endphp
    <body class="font-sans antialiased" style="{{ $backgroundCss }}">
        <div style="{{ $backgroundCssOverlay }}"></div>
        <!-- Page Heading -->
        @isset($header)
            <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
                <div class="container">
                    <div class="navbar-brand">
                        <a href="{{ route('root') }}" class="text-default">{{ __('Wine Wiz') }}</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                         <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('wine.wizard') ? 'active' : '' }}" href="{{ route('wine.wizard') }}">
                                    {{ __('app.nav.wizard') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('wine.index') ? 'active' : '' }}" href="{{ route('wine.index') }}">
                                    {{ __('app.nav.wine-list') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('food.index') ? 'active' : '' }}" href="{{ route('food.index') }}">
                                    {{ __('app.nav.food-list') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">
                                    {{ __('app.nav.about') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <span class="text-muted">v0.9.2</span>
                </div>
            </nav>
        @endisset

        <div class="container">
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
