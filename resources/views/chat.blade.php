<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{config('app.name')}}</title>
        <link rel="shortcut icon" type="image/png" href="{{url('/images/favicon.png')}}"/>

        <script src="{{ url('js/socket.io.min.js') }}"></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    </head>
    <body>
        <p>
            <input type="hidden" value="{{Auth::user()->id}}" id="userId" />
        </p>
        <div id="app">
        </div>
        <!-- JavaScript -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
