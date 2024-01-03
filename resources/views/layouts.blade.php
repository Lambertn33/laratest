<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>Laravel</title>
    </head>
    <body class="antialiased">
       <div class="w-full h-full">
            @yield('content')
       </div>
    </body>
</html>
