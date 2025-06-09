<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Mbolang Malang') }}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/web.css') }}">

    <!-- Custom Fonts: SF Pro Display -->
    <style>
        @font-face {
            font-family: 'SF Pro Display';
            src: url('/assets/SF-Pro-Display/SFPRODISPLAYREGULAR.otf') format('opentype');
            font-weight: 400;
            font-style: normal;
        }
        @font-face {
            font-family: 'SF Pro Display';
            src: url('/assets/SF-Pro-Display/SFPRODISPLAYBOLD.otf') format('opentype');
            font-weight: 700;
            font-style: normal;
        }
        @font-face {
            font-family: 'SF Pro Display';
            src: url('/assets/SF-Pro-Display/SFPRODISPLAYMEDIUM.otf') format('opentype');
            font-weight: 500;
            font-style: normal;
        }
        @font-face {
            font-family: 'SF Pro Display';
            src: url('/assets/SF-Pro-Display/SFPRODISPLAYBLACKITALIC.otf') format('opentype');
            font-weight: 900;
            font-style: italic;
        }
        @font-face {
            font-family: 'SF Pro Display';
            src: url('/assets/SF-Pro-Display/SFPRODISPLAYHEAVYITALIC.otf') format('opentype');
            font-weight: 800;
            font-style: italic;
        }
        @font-face {
            font-family: 'SF Pro Display';
            src: url('/assets/SF-Pro-Display/SFPRODISPLAYLIGHTITALIC.otf') format('opentype');
            font-weight: 300;
            font-style: italic;
        }
        @font-face {
            font-family: 'SF Pro Display';
            src: url('/assets/SF-Pro-Display/SFPRODISPLAYSEMIBOLDITALIC.otf') format('opentype');
            font-weight: 600;
            font-style: italic;
        }
        @font-face {
            font-family: 'SF Pro Display';
            src: url('/assets/SF-Pro-Display/SFPRODISPLAYTHINITALIC.otf') format('opentype');
            font-weight: 200;
            font-style: italic;
        }
        @font-face {
            font-family: 'SF Pro Display';
            src: url('/assets/SF-Pro-Display/SFPRODISPLAYULTRALIGHTITALIC.otf') format('opentype');
            font-weight: 100;
            font-style: italic;
        }

        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')

    <script src="//unpkg.com/alpinejs" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="overflow-x-hidden font-['Plus_Jakarta_Sans'] text-gray-800" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    @if (!request()->is('login') && !request()->is('register') && !request()->is('forgot-password') && !request()->is('reset-password') && !request()->is('verify-email'))
        @include('partials.navbar')
    @endif

    {{-- Untuk halaman seperti login/register --}}
    @yield('content')

    {{-- Untuk komponen yang pakai slot Breeze (dashboard dsb) --}}
    @hasSection('slot')
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    @endif

    @if (!request()->is('login') && !request()->is('register') && !request()->is('forgot-password') && !request()->is('reset-password') && !request()->is('verify-email'))
        @include('partials.footer')
    @endif

</body>
</html>
