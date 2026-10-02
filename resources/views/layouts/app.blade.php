<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta
        name="description"
        content="@yield('description', 'Portfolio of Hasya, a web developer building thoughtful web experiences.')"
    >

    <title>@yield('title', 'RESTORE — A little world built by Hasya')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#F5F1E8] text-[#343532] antialiased">

    <x-navbar />

    <main>
        @yield('content')
    </main>

    <x-footer />

</body>
</html>
