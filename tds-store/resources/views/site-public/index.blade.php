@extends('layouts.master', ['titre' => 'home'])
{{-- barre de recherche --}}
 <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
@section('produit')
{{-- {{ dd(session("stock")) }} --}}
    <div class="container-fluid ">
        <div class="row px-xl-5 pb-3">
            @include('layouts.partials.sidebar')
            {{-- carousel --}}
            <div class="col-lg-9">
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active" style="height: 410px;">
                            @if($publicite_latest == null)
                               <img class="img-fluid" src="{{ asset('assets/img/server.jpg') }}" alt="Image">
                            @else
                                <img class="img-fluid" src="{{ asset(path_image_publicite() . path_image($publicite_latest->image)->filename) }}" alt="Image">
                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">{{ $publicite_latest->message }}
                                        </h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">{{ $publicite_latest->nom }}</h3>
                                        {{-- <a href="" class="btn btn-light py-2 px-3" style="{{ couleur_background_1() }}; text-white;">Voir maintenat</a> --}}
                                    </div>
                                </div>
                            @endif
                        </div>
                        @foreach($publicites as $publicite)
                            @if ($publicite_latest->id != $publicite->id)
                                <div class="carousel-item" style="height: 410px;">
                                    <img class="img-fluid" src="{{ asset(path_image_publicite() . path_image($publicite->image)->filename) }}" alt="Image">
                                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px;">
                                            <h4 class="text-light text-uppercase font-weight-medium mb-3">{{ $publicite->message }}
                                            </h4>
                                            <h3 class="display-4 text-white font-weight-semi-bold mb-4">{{ $publicite->nom }}</h3>
                                            {{-- <a href="" class="btn btn-light py-2 px-3" style="{{ couleur_background_1() }}; text-white;">Voir maintenaant</a> --}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
                {{-- carousel End --}}

                <!-- Products Start -->
                <div class="container-fluid pt-5">
                    <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2" style="{{ couleur_text_2() }}">Nos derniers produits</span></h2>
                    </div>
                    <div class="row px-xl-5 pb-3">
                        @foreach ($produits_latest as $produit)
                            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                                <div class="card product-item border-0 mb-4" style="width: 20rem ;">
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid w-100" src="{{ path_image($produit->image) != null ? asset(path_image_produit() . path_image($produit->image)->filename) :  " "}}" alt="">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3" style="{{ couleur_text_2() }}">
                                        <h6 class="text-truncate mb-3">{{ $produit->nom}}</h6>
                                        <div class="d-flex justify-content-center">
                                            @if($produit->prix_promotionnel != null)
                                                <h6 class="text-muted"><del>{{ number_format($produit->prix, 0, '.', ' ') }} F CFA </del></h6>
                                                <h6 class="ml-3"> {{ number_format($produit->prix_promotionnel, 0, '.', ' ') }} F CFA</h6>
                                            @else
                                            <h6>{{ number_format($produit->prix, 0, '.', ' ') }} F CFA</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="{{ route('root_sitepublic_show_produit_par_sous_categorie', [one_categorie(one_sous_categorie($produit->sous_categorie_id)->categorie_id)->slug, one_sous_categorie($produit->sous_categorie_id)->slug, $produit->slug])}}" class="btn btn-sm mt-1" style="color: #343a40;"><i
                                                class="fas fa-eye mr-1" style="{{ couleur_text_2() }}"></i>Voir
                                            les details
                                        </a>

                                        <form action="{{ route('root_create_panier', $produit) }}" method="POST">
                                            @csrf
                                                <input type="hidden" id="id" name="id" value="{{ $produit->id }}">
                                                <input type="hidden" class="form-control bg-secondary text-center" value="1" name="quantite">
                                                <button type="submit" class=" btn btn-primary tx"><i class="fa fa-shopping-cart mr-1"></i> Ajouter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="container" style="align-item: center">
                            <a href="{{ route('root_sitepublic_produits') }}" class="btn btn-primary text-white tx" role="button">Voir plus</a>
                        </div>
                        <!-- Products End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('newsletter')
    @include('layouts.partials.newsletter')
@endsection

@section('partenaire')
    <!-- Vendor Start -->
    @include('layouts.partials.partenaire')

    <!-- Vendor End -->
@endsection
