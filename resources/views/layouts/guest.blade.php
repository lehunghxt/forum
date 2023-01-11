<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <x-partials.head />
</head>

<body class="bg-gray-100" x-data="{ open: false }">
    {{-- Navbar --}}
    <x-partials.nav />
    {{-- Header --}}
    <header class="relative flex items-center justify-center h-40 bg-blue-500 shadow">
        <img class="absolute z-10 object-cover w-full h-40 opacity-10" src="{{ asset('img/bg/bg-header.jpg') }}" alt="">
        <h2 class="text-2xl md:text-4xl font-bold text-gray-200">Chào mừng đến với cộng đồng</h2>
    </header>

    

    {{-- Slot --}}
    <div class="mb-8 font-sans antialiased text-gray-900">
        {{ $slot }}
    </div>

    {{-- Footer --}}
    <x-partials.footer />

    {{-- Blade UI Kit --}}
    {{-- @bukScripts(true) --}}

    {{-- Livewire --}}
    <livewire:scripts />

</body>

</html>
