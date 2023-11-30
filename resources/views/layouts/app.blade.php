<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <div class="h-[60px] flex justify-between items-center px-4 py-2 border-b-[1px] border-black shadow">
            <div class="text-lg">Weather 1.0</div>
            <div class="shrink-0 py-1.5 px-4 rounded-full bg-slate-600 text-white hover:bg-white hover:text-black border border-slate-600 cursor-pointer duration-200">Get started</div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
