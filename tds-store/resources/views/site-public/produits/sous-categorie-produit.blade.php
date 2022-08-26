@extends('layouts.master', ['titre' => 'moi'])

@section('produit')
    <div class="container-fluid ">
        <div class="row px-xl-5 pb-3">
            @include('layouts.partials.sidebar')
            {{-- carousel --}}
            <div class="col-lg-9">
                <div class="container-fluid pt-2">
                    {{-- {{ dd('dd') }} --}}
                    <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2"  style="{{ couleur_text_2() }}">Nos produits</span></h2>
                    </div>
                    <div class="row px-xl-5 pb-3">
                        @foreach ($sous_categories_produits as $produit)
                            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                                <div class="card product-item border-0 mb-4" style="width: 20rem ;">
                                    <div
                                        class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid w-100" src="{{ asset('assets/img/product-1.jpg') }}" alt="">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate mb-3">{{ $produit->nom}}</h6>
                                        <div class="d-flex justify-content-center">
                                            <h6>{{ number_format($produit->prix, 0, '.', ' ') }}</h6>
                                            <h6 class="text-muted ml-2"><del>{{ number_format($produit->prix, 0, '.', ' ') }} FCFA</del></h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="{{ route('root_sitepublic_show_produit_par_sous_categorie', [$cat, $sous_cat, $produit->slug])}}" class="btn btn-sm p-0" style="color: #343a40;"><i
                                                class="fas fa-eye mr-1" style="{{ couleur_text_2() }}"></i>Voir
                                            les details
                                        </a>
                                        <form action="{{ route('root_create_panier', $produit) }}" method="POST">
                                            @csrf
                                                    <input type="hidden" id="id" name="id" value="{{ $produit->id }}">
                                                    <input type="hidden" class="form-control bg-secondary text-center" value="1" name="quantite">
                                                <button type="submit" class="btn btn-primary tx"><i class="fa fa-shopping-cart mr-1"></i> Ajouter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- pagination --}}
                    {{-- {{ $sous_categories_produits->links() }} --}}
                    {{-- pagination end --}}
            </div>
        </div>

    </div>
@endsection

@section('newsletter')
@include('layouts.partials.newsletter')
@endsection

@section('partenaire')
    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    @foreach (partenaires_logo() as $item)
                        <div class="vendor-item border p-4">
                            <img src="{{ $item->logo }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->
@endsection
