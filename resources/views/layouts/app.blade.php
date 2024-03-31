<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="appTheme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts & styles-->
    @livewireScripts

    {{--    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}

    {{--    <x-livewire-alert::scripts />--}}

    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-livewire-alert::scripts />

<div class="min-h-screen bg-[#F9FAFB]">
    <livewire:layout.navigation />

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!--    Footer -->
    <footer class="footer footer-center p-4 bg-transparent mt-8 pb-4 text-base-content/50">
        <aside>
            <p class="!text-xs md:text-sm">Copyright © 2024 - All right reserved by EWSD GP10</p>
        </aside>
    </footer>
</div>
</body>
</html>
