<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <style>
            .btn-toggle::before{
                content: url({{asset('images/right.svg')}});
            }
            .btn-light.btn-toggle::before{
                content: url({{asset('images/rightDark.svg')}});
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
    <div class="container-fluid">
        @yield('main')
    </div>
    </body>
</html>
