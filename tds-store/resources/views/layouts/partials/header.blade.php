
<style>
    .header-menu-content{
        display: none;
        z-index: 1000;
        width:100%;
        position: absolute;
        min-height: 180px;
        left: 0;
    }
    .parent-menu-item-hover:hover .header-menu-content{
        display: block;
    }
    ul {
        list-style-type: none;
    }
</style>

<div class="container-fluid">

    <div class="row py-2 px-xl-5" style="font-size: 13.5px; {{ couleur_principal() }};">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center" style="{{ couleur_text_3() }}; font-size: 14px;">
                <strong style="{{ couleur_text_3() }};">Des questions?</strong>
                {{-- <span class="text-muted px-1"></span> --}}
                <strong class="px-2" style="{{ couleur_text_3() }}; font-size: 14px;">Contactez-nous!</strong>
                <span class="text-nowrap">
                    <strong><i class="fa fa-phone-alt" style="{{couleur_text_1() }}"></i></strong>
                    <a href="tel:+22921335730"  style="{{ couleur_text_3() }}; font-size: 14px;">+229 21 33 57 30</a>
                </span>
                <span class="hidden-xs"></span>
                <span class="text-nowrap px-1"  style="{{ couleur_text_3() }}; font-size: 14px;">
                    <strong><i class="fa fa-envelope" style="{{ couleur_text_1() }}"></i></strong>
                    <a href="mailto:info@tdsstore"  style="{{ couleur_text_3() }}; font-size: 14px;">info@tdsstore.bj</a>
                </span>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex">
                  {{-- pour voir si un utilisateur est connecté et affiché certaine chose  --}}
                @auth
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-jet-dropdown-link href="{{ route('root_deconnexion') }}" @click.prevent="$root.submit();" style="{{ couleur_text_3() }}; font-size: 15px; padding-right: 0rem !important;">
                            Déconnexion
                        </x-jet-dropdown-link>
                    </form>
                    <span class="text-muted px-1">|</span>

                    @if (Auth::user()->role == "admin" || Auth::user()->role == "gestionnaire" || Auth::user()->role == "comptable")
                        <a href="{{ route('root_espace_admin_index') }}" style=" {{ couleur_text_3() }} ; font-size: 15px;">Espace-admin</a>
                    @else
                        <a href="{{ route('root_espace_client_index') }}" style=" {{ couleur_text_3() }} ; font-size: 15px;">Espace-client</a>
                    @endif

                    @else
                        <a href="{{ route('root_auth_login') }}" class="nav-item nav-link  p-0 " style="{{ couleur_text_3() }}; font-size: 15px;">Connexion</a>

                        @if (Route::has('register'))
                            <span class="text-muted px-1">|</span>

                            <a href="{{ route('root_auth_register') }}" class="nav-item nav-link  p-0"  style="{{ couleur_text_3() }}; font-size: 15px;">Inscription</a>
                        @endif
                @endauth
            </div>
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="/" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><img src="{{ asset('assets/img/tds.png') }}" alt=""></h1>
            </a>
        </div>

        <div class="col-lg-6 col-6 text-left p-0">
            @livewire('search')
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="#" class="btn border">
                <i class="fas fa-heart" style="{{ couleur_text_2() }}"></i>
                @if (auth()->check())
                    <span class="badge">{{ count_favoris() }}</span>
                @else
                    <span class="badge">0</span>
                @endif
            </a>
            <a href="{{ route('root_show_panier') }}" class="btn border">
                <i class="fas fa-shopping-cart" style="{{ couleur_text_2() }}"></i>
                <span class="badge">
                    @if(session()->has("panier"))
                        {{ count(session("panier")) }}
                    @else
                        0
                    @endif
                </span>
            </a>

        </div>
    </div>
</div>

<!-- Navbar Start -->
<div class="container-fluid mb-5" style="{{ couleur_text_3() }}">
    <div class="row border-top px-xl-5">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="{{route('root_index')}}" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><img src="{{ asset('assets/img/tds.png') }}" alt="logo-tds"></h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse" style="background-color: #f0f0f0; ">
                    <div class="navbar-nav m-auto py-0">
                        @php
                        $i = 0
                        @endphp
                        @foreach (priority_by_category_tree() as $item)
                            @php
                            $i++
                            @endphp
                            @if($i <= 8 )
                                <div class="parent-menu-item-hover" >
                                    <a href="#" class="nav-link dropdown-toggle pr-5" style="border-right: 1px solid #ffff;">{{ $item->nom }}</a>
                                    <div class="header-menu-content" style="background-color: #f5efef; border: 1px solid #ddd;">
                                        <div class="row">
                                            @foreach (sous_categories_menu($item->id) as $k)
                                                <div class="col-md-3 col-sm-4 mb-3">
                                                    <div class="">
                                                        <a href="{{ route('root_sitepublic_all_produit_par_sous_categorie', [$item->slug, $k->slug])}}" class="nav-link">{{ $k->nom }}</a>
                                                    </div>
                                                    <ul>
                                                        @foreach (produits_sous_categorie($k->slug) as $produit)
                                                            <li>
                                                                <a href="{{ route('root_sitepublic_show_produit_par_sous_categorie', [$item->slug, $k->slug, $produit->slug])}}">{{ $produit->nom }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @php
                        $j = 0
                        @endphp
                        <div class="parent-menu-item-hover">
                            @if(count(categorie_menu()) > 8 )
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="border-right: 1px solid #ffff; {{ couleur_text_3() }};">Autres</a>
                                    <div class="header-menu-content" style="background-color:  #f5efef; border: 1px solid #ddd;">
                                        <div class="row">
                                            @foreach (priority_by_category_two() as $item)
                                                <div class="col-md-3 col-sm-4 mb-3" style="margin-bottom: 0 !important;">
                                                    <div class="mt-0">
                                                        <a href="" class="nav-link">{{ $item->nom }}</a>
                                                    </div>
                                                    <ul>
                                                        @foreach (sous_categories_menu($item->id) as $k)
                                                        <li>
                                                            <a href="{{ route('root_sitepublic_all_produit_par_sous_categorie', [$item->slug, $k->slug])}}">{{ $k->nom }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                            @foreach (priority_by_category_one() as $item)
                                                <div class="col-md-3 col-sm-4 mb-3" style="margin-bottom: 0 !important;">
                                                    <div class="mt-0">
                                                        <a href="" class="nav-link">{{ $item->nom }}</a>
                                                    </div>
                                                    <ul>
                                                        @foreach (sous_categories_menu($item->id) as $k)
                                                        <li>
                                                            <a href="{{ route('root_sitepublic_all_produit_par_sous_categorie', [$item->slug, $k->slug])}}">{{ $k->nom }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                            @foreach (priority_by_category_zero() as $item)
                                                <div class="col-md-3 col-sm-4 mb-3" style="margin-bottom: 0 !important;">
                                                    <div class="mt-0">
                                                        <a href="" class="nav-link">{{ $item->nom }}</a>
                                                    </div>
                                                    <ul>
                                                        @foreach (sous_categories_menu($item->id) as $k)
                                                        <li>
                                                            <a href="{{ route('root_sitepublic_all_produit_par_sous_categorie', [$item->slug, $k->slug])}}">{{ $k->nom }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
