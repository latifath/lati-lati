<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TDS-store</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
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

    </style>

    @livewireStyles

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

</head>

<body>
 @yield('head')

    @include('layouts.partials.header')

    @yield('produit')

    @yield('contenu')

    @yield('page_produit')

    @yield('detail_produit')

    @yield('panier')

    @yield('register')

    @yield('login')

    @yield('verifier')

    @yield('validation')

    @yield('confirmation-commande')

    @yield('commande-reçue')

    @yield('newsletter')

    @yield('partenaire')

    @yield('information-client')


    <!-- Footer Start -->
    @include('layouts.partials.footer')
    <!-- Footer End -->


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
    <script src=" {{ asset('asets/mail/contact.js') }}"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        function imprimer(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload();
        }
    </script>



    @livewireScripts


    @include('flashy::message')
</body>

</html>


