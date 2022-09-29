<div class="container-fluid">
    <div class="row py-2 px-xl-5" style="font-size: 13.5px; {{ couleur_principal() }};">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center" style="{{ couleur_text_3() }}; font-size: 15px;">
                <a class="px-1" style="{{ couleur_text_3() }};" href="">Des questions?</a>
                {{-- <span class="text-muted px-1"></span> --}}
                <a class="text-nowrap px-1" style="{{ couleur_text_3() }}; font-size: 15px;" href="">Contactez-nous!</a>
                <span class="text-nowrap">
                    <strong><i class="fa fa-phone-alt" style="{{couleur_text_1() }}"></i></strong>
                    <a href="tel:+229 21 33 57 30"  style="{{ couleur_text_3() }}; font-size: 15px;">+229 21 33 57 30</a>
                </span>
                <span class="hidden-xs"></span>
                <span class="text-nowrap px-1"  style="{{ couleur_text_3() }}; font-size: 15px;">
                    <strong><i class="fa fa-envelope" style="{{ couleur_text_1() }}"></i></strong>
                    <a href="#"  style="{{ couleur_text_3() }}; font-size: 15px;">info@tdsstore.bj</a>
                </span>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex">
                  {{-- pour voir si un utilisateur est connecté et affiché certaine chose  --}}
                @auth
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-jet-dropdown-link href="{{ route('root_deconnexion') }}" @click.prevent="$root.submit();" style="{{ couleur_text_3() }}; font-size: 15px;">
                            Déconnexion
                        </x-jet-dropdown-link>

                    </form>
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
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse" style="background-color: #f0f0f0;">
                    <div class="navbar-nav m-auto py-0" style="padding: 10px 20px; background-color: #f0f0f0; border-right: 1px solid #ffff; {{ couleur_text_3() }};">
                        @php
                        $i = 0
                        @endphp
                        @foreach (categorie_menu() as $item)
                        @php
                        $i++
                        @endphp
                        @if($i <= 8) @if(sous_categories_menu($item->id)->count() == 0)
                            <a href="#" class="nav-item nav-link active" style="border-right: 1px solid #ffff; padding-right: 40px; {{ couleur_text_3() }};">{{ $item->nom }}</a>
                            @else
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="padding-right: 40px; border-right: 1px solid #ffff; {{ couleur_text_3() }};" >{{ $item->nom }}</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    @foreach (sous_categories_menu($item->id) as $k)
                                    <a href="{{ route('root_sitepublic_all_produit_par_sous_categorie', [$item->slug, $k->slug])}}" class="dropdown-item">{{ $k->nom }}</a>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @endif
                            @endforeach
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>

