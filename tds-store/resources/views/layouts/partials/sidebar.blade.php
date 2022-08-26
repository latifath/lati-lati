<div class="col-lg-3 d-none d-lg-block">
    <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
        data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px; {{ couleur_background_2() }}">
        <h6 class="m-0 text-white">Toutes les categories</h6>
        <i class="fa fa-angle-down text-dark"></i>
    </a>
    <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 text-dark"
        id="navbar-vertical">
        <div class="navbar-nav w-100 overflow-hidden ">
            @foreach (categorie_menu() as $item)
                @if (sous_categories_menu($item->id)->count() == 0)
                    <a href="" class="nav-item nav-link">{{ $item->nom }}</a>
                @else
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown"><i
                                class="fa fa-angle-down float-right mt-1"></i>{{ $item->nom }}</a>

                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            @foreach (sous_categories_menu($item->id) as $k)
                                <a href="{{ route('root_sitepublic_all_produit_par_sous_categorie', [$item->slug, $k->slug])}}" class="dropdown-item">{{ $k->nom }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </nav>
</div>
