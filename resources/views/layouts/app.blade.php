<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>


    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keyword')">
    <meta name="author" content='Abdelrahman Web It '>




    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- owl --}}
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet">
    {{-- exzoom --}}
    <link href="{{ asset('assets/exzoom/jquery.exzoom.css') }}" rel="stylesheet">


    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

    @livewireStyles
</head>

<body>
    <div id="app">

        @include('layouts/inc/frontnavbar')

        <main class="">
            @yield('content')
        </main>
        @include('layouts/inc/frontendfooter')
    </div>


    <script src="{{ asset('admin/vendors/base/vendor.bundle.base.js') }}"></script>
    <script href="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <script href="{{ asset('assets/js/bootstrap.min.js') }}"></script>



    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
        window.addEventListener('message', event => {
            if (event.detail) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.notify(event.detail.text, event.detail.type);
            }
        })
    </script>


    {{--  owl --}}
    {{-- <script href="{{ asset('assets/js/owl.carousel.min.js') }}"></script> --}}
    <script href="{{ asset('assets/js/owl.carousel.js') }}"></script>
    {{-- exzoom --}}
    <script href="{{ asset('assets/exzoom/jquery.exzoom.js') }}"></script>
    @yield('script')


    @livewireScripts
    @stack('scripts')
</body>

</html>
