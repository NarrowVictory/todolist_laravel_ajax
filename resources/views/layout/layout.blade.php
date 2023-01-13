<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
            <meta name="_token" content="{{ csrf_token() }}">
                <title>
                    {{ $title ?? "Todo App" }}
                </title>
                <link href="{{ 'assets/css/bootstrap.min.css' }}" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
                @stack('css')
            </meta>
        </meta>
    </head>
    <body class="d-flex flex-column min-vh-100">
        @include('layout.navbar')
        <div class="container">
            @yield('content')
        </div>
        <script src="{{ 'assets/js/bootstrap.min.js' }}">
        </script>
        @stack('js')
        @include('layout.footer')
    </body>
</html>