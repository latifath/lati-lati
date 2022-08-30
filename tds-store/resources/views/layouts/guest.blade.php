<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <meta content="Free HTML Templates" name="keywords">
        <meta content="Free HTML Templates" name="description"> --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="{{ asset('assets/img/tds.png') }}">

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" media="all" rel="stylesheet"/>

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

        @yield('style')

        <style>
            .tx:hover{
            color: #fff !important;
        }

        @media (min-width: 640px){
            .div_form_jetstream{
                margin-top: 200px !important;
            }
        }

        .div-logo{
            text-left : 20px;
        }

        </style>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

    </head>
    <body>
        @yield('head')

        @include('layouts.partials.header')

        <div class="container-fluid ">
            <div class="row px-xl-5 pb-3">
                @include('layouts.partials.sidebar')

                <div class="font-sans antialiased col-lg-9">
                    {{ $slot }}
                </div>
            </div>
        </div>

        @include('layouts.partials.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top tx"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src=https://code.jquery.com/jquery-3.4.1.min.js></script>

    @yield('js')

    <script src=https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js')  }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js')  }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('assets/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src=" {{ asset('assets/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @livewireScripts
    </body>
</html>
