<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-teal-lightest font-sans font-normal antialiased">
        @include('_navigation')

        <div id="app" class="flex flex-col">
            @yield('content')

            <modal-component></modal-component>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
