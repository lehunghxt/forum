<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="font-sans antialiased"  x-data="{ open: false }">

    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">

        <x-dashboard.nav />

        <div class="grid grid-cols-8">

            {{-- Sidenav --}}
            <x-dashboard.sidenav />

            <div class="col-span-12 sm:col-span-12 md:col-span-6 xl:col-span-7">
                <!-- Page Heading -->
                @if (isset($header))
                <header class="mx-6 mt-6 text-gray-600 shadow bg-blue-50">
                    <div class="px-4 py-6 wrapper">
                        {{ $header }}
                    </div>
                </header>
                @endif

                {{-- Alerts --}}
                <div class="mx-6 mt-6">
                    <x-alerts.main />
                </div>

                <!-- Page Content -->
                <main class="m-6 bg-white shadow">
                    <div class="py-6">
                        {{ $slot }}
                    </div>
                </main>

            </div>

        </div>



    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>
