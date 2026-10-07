@props(['title' => null, 'description' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('showroom.name') }}</title>
    <meta name="description" content="{{ $description ?? 'Showroom mobil bekas berkualitas. Lihat katalog dan hubungi kami via WhatsApp.' }}">
    <meta property="og:title" content="{{ $title ?? config('showroom.name') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" href="{{ asset('logo-web.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-web.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-gray-50 text-gray-900 antialiased">
    <x-navbar />

    <main class="flex-1">
        {{ $slot }}
    </main>

    <x-footer />
    <x-whatsapp-float />
</body>
</html>