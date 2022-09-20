@extends('layouts.master')
@section ('detail_produit')

<!-- Page Header Start -->
<div class="container-fluid mb-5 py-2 px-xl-5" style="{{ couleur_background_1() }}">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">

        <div class="d-inline-flex">
            <p class="m-0"><a href="/"><i class="fa fa-home" style="{{ couleur_blanche() }}"></i></a></p>
            <p class="text-muted px-1" style="{{ couleur_blanche() }}">/</p>
            <p class="m-0" style="{{ couleur_blanche() }}">Détail Produit</p>
        </div>
    </div>
</div>

<!-- Page Header End -->
<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        @include('layouts.partials.sidebar')
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-4 pb-5">
                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner border" style="height: 400px;">
                            <div class="carousel-item active">
                                @if($last_image == null)
                                    <img class="img-fluid" src="{{ asset('storage/articles/product-1.jpg') }}" alt="Image" style="width: 100% !important; height: auto;">
                                @else
                                    <img class="img-fluid" src="{{ asset('storage/' . $last_image->path) }}" alt="Image">
                                @endif
                            </div>
                            @if ($images->count() > 0)
                                @foreach($images as $image)
                                    @if ($last_image->id != $image->id)
                                        <div class="carousel-item">
                                            <img class="w-100 h-100" src="{{ asset('storage/' . $image->path)  }}" alt="Image">
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 pb-5">

                    <div class="">
                        @livewire('like', ['produit' => $produit])
                    </div>
                    <h3 class="font-weight-semi-bold mt-3">{{ $produit->nom}}</h3>
                    @if($produit->prix_promotionnel != null)
                    <h3 class="font-weight-semi-bold mb-4 mt-3">{{ number_format($produit->prix_promotionnel, '0', '.', ' ') }} F CFA</h3>
                    @else
                    <h3 class="font-weight-semi-bold mb-4 mt-3">{{ number_format($produit->prix , '0', '.', ' ') }} F CFA</h3>
                    @endif
                    <form action="{{ route('root_create_panier', $produit) }}" method="POST">
                        @csrf
                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <div class="input-group-btn" type="number" id="quantity" name="quantity" min="1">
                                    <button class="btn btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="hidden" id="id" name="id" value="{{ $produit->id }}">
                                <input type="text" class="form-control bg-secondary text-center" value="1" name="quantite">
                                <div class="input-group-btn">
                                    {{-- <input type="number" id="quantity" name="quantity" min="1" max="5"> --}}

                                    <button class="btn btn-primary" type="number" id="quantity" name="quantity"  max="10">
                                        <i class="fa fa-plus"></i>
                                    </button>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary tx px-3"><i class="fa fa-shopping-cart mr-1"></i> Ajouter au panier</button>
                        </div>
                    </form>

                    <div class="d-flex" style="{{ couleur_text_2() }}">
                        <p class=" font-weight-medium mb-0 mr-2">Stock:</p>
                        <div class="d-inline-flex font-weight-medium mb-0 mr-2"> {{ $produit->quantite }}</div>

                    </div>
                    <br>
                    @if($produit->quantite != null)

                    <h4 class="text-success">Disponible</h4>

                    @else
                    <h2 class="text-danger">Indisponible</h2>

                    @endif

                    <div class="d-flex pt-2">
                        <p class="font-weight-medium mb-0 mr-2">Partager sur:</p>
                        <div class="d-inline-flex">
                            <a class="px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 pt-0">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                     {{-- <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a> --}}
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3" style="{{ couleur_text_2() }}">Description du produit</h4>
                        <p>{!! $produit->description !!}</p>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>



<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2" style="{{ couleur_text_2() }}">Vous pourriez aussi aimer</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach ($sous_categories_produits as $produit)
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        @if (last_image_produit($produit->id) == "")
                            <img class="img-fluid w-100" src="https://cdn.pixabay.com/photo/2022/05/10/11/12/tree-7186835__480.jpg" alt="" style="width: 100% !important; height: auto;">
                        @else
                            <img class="img-fluid w-100" src="{{ asset('storage/'. last_image_produit($produit->id)->path )}}" alt="" style="width: 100% !important; height: auto;">
                        @endif
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{ $produit->nom }}</h6>
                        <div class="d-flex justify-content-center">
                            @if($produit->prix_promotionnel != null)
                                <h6 class="text-muted"><del>{{ number_format($produit->prix, 0, '.', ' ') }} F CFA </del></h6>
                                <h6 class="ml-3"> {{ number_format($produit->prix_promotionnel, 0, '.', ' ') }} F CFA</h6>
                            @else
                                <h6>{{ number_format($produit->prix, 0, '.', ' ') }} F CFA</h6>

                            @endif
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border" style="m-auto">
                        <a href="{{ route('root_sitepublic_show_produit_par_sous_categorie', [$cat, $sous_cat, $produit->slug])}}" class="btn btn-sm p-0 mt-2" style="color: #343a40;"><i class="fas fa-eye  mr-1" style="{{ couleur_text_2() }}"></i>Voir les details</a>
                        <form action="{{ route('root_create_panier', $produit) }}" method="POST">
                            @csrf
                                    <input type="hidden" id="id" name="id" value="{{ $produit->id }}">
                                    <input type="hidden" class="form-control bg-secondary text-center" value="1" name="quantite">
                                <button type="submit" class="btn btn-primary tx"><i class="fa fa-shopping-cart mr-1"></i> Ajouter</button>

                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Products End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@endsection

@section('newsletter')
@include('layouts.partials.newsletter')
<!-- Subscribe End -->
@endsection

@section('partenaire')
    @include('layouts.partials.partenaire')
@endsection

@if(session()->has('cart'))
    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="fa fa-exclamation" aria-hidden="true"></i> Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Produit ajouté au panier avec succès</h5>
                    <hr>
                    <p>Il y a {{ $cartCount }} @if($cartCount > 1) articles @else article
                        @endif dans votre panier pour un total de <strong>{{ number_format($cartTotal, 2,
        ',', ' ') }} FCFA TTC</strong> hors frais de port.</p>
                    <p><em>Vous avez la possibilité de venir chercher vos produits sur place,
                            dans ce cas vous cocherez la case correspondante lors de la confirmation de votre
                            commande et aucun frais de port ne vous sera facturé.</em></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{ route('panier.index') }}" class="btn waves-effect waves-
            light">
                        <i class="material-icons left">check</i>
                        Commander
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

@section('js')
    {{-- <script>
        @if(session()->has('cart'))
            document.addEventListener('DOMContentLoaded', () => {
            const instance = M.Modal.init(document.querySelector('.modal'));
            instance.open();
            });
        @endif
    </script> --}}
@endsection
