<div class="left side-menu" >
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <div class="left-side-logo d-block d-lg-none" >
        <div class="text-center" style="{{ couleur_principal() }}">

            <a href="/" class="logo"><img src="{{ asset('dashbord/images/logo.png') }}" height="5" widht="5" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">

            <ul>
                <li class="menu-title">principal</li>

                @client
                    <li>
                        <a href="{{ route('root_espace_client_index') }}" class="waves-effect">
                            <i class="dripicons-meter"></i>
                            <span> Tableau de bord <span class="badge badge-success badge-pill float-right"></span></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('root_espace_client_commande_index') }}" class="waves-effect"><i class="fa fa-shopping-cart"></i> <span> Commande </span></a>
                    </li>

                    <li class="">
                        <a href="{{ route('root_espace_client_paiement_index') }}" class="waves-effect"><i class="fa fa-money"></i> <span> Paiement </span> </a>
                    </li>

                    <li class="">
                        <a href="{{ route('root_site_public_favoris_index') }}" class="waves-effect"><i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            <span>Favoris</span></a>
                     </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i><span> Mon Profil</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('root_espace_client_information_client') }}">Compte </a></li>
                            <li><a href="{{ route('profile.show') }}" class="waves-effect">Profil</a></li>
                        </ul>
                    </li>
                @endclient

                @admin

                    <li>
                        <a href="{{ route('root_espace_admin_index') }}" class="waves-effect">
                            <i class="dripicons-meter"></i>
                            <span> Tableau de bord <span class="badge badge-success badge-pill float-right"></span></span>
                        </a>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-shopping-cart"></i> <span> Produit</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('root_espace_admin_add_vue') }}">Ajouter un produit</a></li>
                            <li><a href="{{ route('root_espace_admin_index_produit') }}">Tous les produits</a></li>
                            <li><a href="{{ route('root_espace_admin_index_categorie') }}">Catégories</a></li>
                            <li><a href="{{ route('root_espace_admin_index_sous_categorie') }}">Sous-catégories</a></li>
                            <li><a href="{{ route('root_espace_admin_produits_non_livrer') }}">Produits non livrés</a></li>

                            </li>
                        </ul>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i> <span> Client</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('root_espace_admin_clients_add') }}">Ajouter un client</a></li>
                            <li><a href="{{ route('root_espace_admin_clients_index') }}">Tous les clients</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money"></i> <span> Paiement</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('root_espace_admin_paiements_index') }}">Tous les paiements</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-shopping-cart"></i><span>Commande</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('root_index') }}">Ajouter une commande</a></li>
                            <li><a href="{{ route('root_espace_admin_commandes_index') }}">Toutes les commandes</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bar-chart" aria-hidden="true"></i><span>Récaptulatif</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('root_espace_admin_recapitutatif_index') }}">Récap vente</a></li>
                            <li><a href="{{ route('root_espace_admin_recapitutatif_paiement_index') }}">Récap paiement</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-houzz"></i><span>Stock</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('root_espace_admin_index_stock') }}">Tous les stocks</a></li>
                            <li><a href="{{ route('root_espace_admin_index_correction') }}">Correction stocks</a></li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="{{ route('root_espace_admin_commandes_news') }}" class="waves-effect"><i class="fa fa-envelope"></i><span>Newsletter</span> </a>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-truck"></i><span>Livraisons</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('root_espace_admin_index_livraison') }}">Livraison</a></li>
                            <li><a href="{{ route('root_espace_admin_index_expedition') }}">Expédition</a></li>
                        </ul>
                    </li>

                    <li class="">
                    </li>

                     <li class="">
                        <a href="{{ route('root_espace_admin_index_partenaire') }}" class="waves-effect"><i class="fa fa-handshake-o" aria-hidden="true"></i><span>Partenaires</span></a>
                     </li>

                    <li><a href="{{ route('root_espace_admin_index_promotion') }}"><i class="fa fa-bullhorn"></i>Promotions</a></li>

                    <li><a href="{{ route('root_espace_admin_publicites') }}"><i class="fa fa-bullhorn"></i>Publicites</a></li>

                    <li class="">
                        <a href="{{ route('root_espace_admin_index_utilisateur') }}" class="waves-effect"><i class="fa fa-user" aria-hidden="true"></i><span>Tous les utilisateurs</span></a>
                     </li>

                    <li class="">
                        <a href="{{ route('profile.show') }}" class="waves-effect"><i class="fa fa-user" aria-hidden="true"></i><span>Mon profil</span></a>
                     </li>

                @endadmin

                @comptable
                <li>
                    <a href="{{ route('root_espace_admin_index') }}" class="waves-effect">
                        <i class="dripicons-meter"></i>
                        <span> Tableau de bord <span class="badge badge-success badge-pill float-right"></span></span>
                    </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bar-chart" aria-hidden="true"></i><span>Récaptulatif</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('root_espace_admin_recapitutatif_index') }}">Récap vente</a></li>
                        <li><a href="{{ route('root_espace_admin_recapitutatif_paiement_index') }}">Récap paiement</a></li>
                    </ul>
                </li>

                @endcomptable
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->

</div>
