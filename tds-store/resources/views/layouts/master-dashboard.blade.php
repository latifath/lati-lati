<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>TDS-store</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('dashbord/images/logo.png') }}">

         <!-- Alertify css -->
         {{-- <link href="{{  asset('dashbord/plugins/alertify/css/alertify.css') }}" rel="stylesheet" type="text/css"> --}}

        <link href="{{ asset('dashbord/css/bootstrap.min.css') }}" rel="stylesheet"  type="text/css">
        <link href="{{ asset('dashbord/css/icons.css') }}" rel="stylesheet"  type="text/css">
        <link href="{{  asset('dashbord/css/style.css') }}" rel="stylesheet"  type="text/css">

         <!-- DataTables -->
         <link href="{{ asset('dashbord/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
         <link href="{{ asset('dashbord/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
         <!-- Responsive datatable examples -->
         <link href="{{ asset('dashbord/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />


    </head>


    <body class="fixed-left">
        @yield('head')
        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">

        @include('layouts.partials-dashboard.sidebar')

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                @include('layouts.partials-dashboard.header')

                <div class="page-content-wrapper ">
                    <div class="container-fluid">
                        @yield('contenu')

                        @yield('contenu-client')

                         @yield('contenu-commande')

                         @yield('detail')

                         @yield('gestion-paiement')

                         @yield('contenu-admin')

                        @yield('gestion-client')

                        @yield('detail-client')

                        @yield('client-detail-commande')

                        @yield('paiement')

                        @yield('admin-commandes')

                        @yield('les-info')

                        @yield('index-utilisateur')

                        @yield('newsletter')

                        @yield('categorie')

                        @yield('détail-categorie')

                        @yield('creation-client')

                        @yield('livraison')

                        @yield('sous-categorie')

                        @yield('détail-sous-categorie')

                        @yield('produits')

                        @yield('produit-create')

                        @yield('update-produit')

                        @yield('Paiement-create')

                        @yield('stocks')

                        @yield('ajout-stock')

                        @yield('information-client')

                        @yield('correction-stock')

                        @yield('Images')

                        @yield('show-images')

                        @yield('Admin-index-promotion')

                        @yield('compte')

                        @yield('publicites')

                        @yield('client-favoris')

                        @yield('produit-non-livrer')

                        @yield('bilan-vente')

                        @yield('show-bilan-vente')

                        @yield('bilan-paiement')

                    </div>

                </div>


            </div>

            @include('layouts.partials-dashboard.footer')


        </div>
        </div>

        <!-- jQuery  -->
        <script src="{{ asset('dashbord/js/jquery.min.js') }}"></script>

        @yield('js')
        {{-- tiny scrip --}}
        <script src="{{ asset('dashbord/plugins/tinymce/tinymce.min.js') }}"></script>

        <script src="{{ asset('dashbord/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('dashbord/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('dashbord/js/detect.js') }}"></script>
        <script src="{{ asset('dashbord/js/fastclick.js') }}"></script>
        <script src="{{ asset('dashbord/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('dashbord/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('dashbord/js/waves.js') }}"></script>
        <script src="{{ asset('dashbord/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('dashbord/js/jquery.scrollTo.min.js') }}"></script>

        <!-- Alertify js -->
        <script src="{{ asset('dashbord/plugins/alertify/js/alertify.js') }}"></script>
        <script src="{{ asset('dashbord/pages/alertify-init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('dashbord/js/app-drixo.js') }}"></script>


        <!-- Required datatable js -->
        <script src="{{ asset('dashbord/plugins/datatables/jquery.dataTables.min.js ')}}"></script>
        <script src="{{ asset('dashbord/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Responsive examples -->
        <script src="{{ asset('dashbord/plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('dashbord/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ asset('dashbord/pages/datatables.init.js') }}"></script>


        <script>
            $(document).ready(function () {
                if($(".elm1").length > 0){
                    tinymce.init({
                        selector: "textarea.elm1",
                        language: "fr_FR",
                        theme: "modern",
                        height:300,
                        plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "save table contextmenu directionality emoticons template paste textcolor"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                        style_formats: [
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                        ]
                    });
                }
            });
        </script>


        @include('flashy::message');
    </body>
</html>
