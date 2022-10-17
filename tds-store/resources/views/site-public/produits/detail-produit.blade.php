@extends('layouts.master')
{{-- pour la barre de seach --}}
 <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

 <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>

 @section('head')
<style>
    .img-fluid-prod {
        width: 300px;
        height: 400px;
        object-fit: contain;
    }
    .img-fluid-autre {
        width: 100px;
        height: 200px;
        object-fit: contain;
    }
    .img-partenaire{
        width: 80px;
        height: 120px;
        object-fit: contain;
    }
</style>
 @endsection

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
                <div class="col-lg-4 pb-0">
                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner border" style="height: 400px;">
                            <div class="carousel-item active">
                                    <img class="img-fluid-prod" src="{{ path_image($produit->image) ? asset(path_image_produit() . path_image($produit->image)->filename) : ''}}" alt="Image">
                            </div>
                            @foreach($produit->images as $image)
                                <div class="carousel-item">
                                    <img class="w-100 h-100" src="{{ $image ? asset(path_image_produit() . $image->filename) : ''}}" alt="Image">
                                </div>
                            @endforeach
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
                                <div class="input-group-btn">
                                    <a class="btn btn-primary a:hover" id="remove" >
                                        <i class="fa fa-minus text-white"></i>
                                    </a>
                                </div>
                                <input type="hidden" id="id" name="id" value="{{ $produit->id }}">
                                <input type="text" class="form-control bg-secondary text-center" value="1" name="quantite" id="qty" min="1">
                                <div class="input-group-btn">
                                    <a class="btn btn-primary" id="add">
                                        <i class="fa fa-plus text-white"></i>
                                    </a>

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
                            <a class="px-2" id="facebook-btn" href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            {{-- <a class="px-2" id="twitter-btn" href="#">
                                <i class="fab fa-twitter"></i>
                            </a> --}}

                            <a href="http://twitter.com/share" class="twitter-share-icon px-2"
                            data-count="vertical" data-via="InfoWebMaster"><i class="fab fa-twitter"></i></a>
                            <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                            <a class="px-2" id="linkedin-btn" href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>

                            {{-- <a name="fb_share" type="box_count" share_url="http://www.example.com/page.html"><i class="fab fa-facebook-f"></i></a>
                            <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script> --}}


                            {{-- <script type="text/javascript" src="http://platform.linkedin.com/in.js"></script>
                            <script type="in/share" data-counter="top"></script> --}}


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
                        <img class="img-fluid-autre w-100" src="{{ path_image($produit->image) ? asset(path_image_produit() . path_image($produit->image)->filename) : ''}}" alt="">
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
@foreach (partenaires_logo() as $pl)
@if($pl == null)
@else
   @section('partenaire')
        <!-- Vendor Start -->
        <div class="container-fluid py-5" style="padding-bottom: 0rem !important">
            <div class="row px-xl-5">
                <div class="col">
                    <div class="owl-carousel vendor-carousel">
                        @foreach (partenaires_logo() as $pl)
                            <div class="vendor-item border p-4">
                                <img class="img-partenaire" src="{{ path_image($pl->image) ? asset(path_image_partenaire() . path_image($pl->image)->filename) : '' }}" alt="partenaire">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Vendor End -->
    @endsection
 @endif
@endforeach
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
            </div>alpine
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

    <script type="text/javascript">
        $("#add").click(function() {
            var $input = $('#qty');

            $input.val( +$input.val() + 1 );

        });
        $("#remove").click(function() {
            var $input = $('#qty');

            if($input.val() > 1){
                $input.val( +$input.val() - 1 );
            }
        });
    </script>

    <script>
        // socila share
        const facebookBtn = document.getElementById('facebook-btn');
        // const twitterBtn = document.getElementById('twitter-btn');
        const linkedinBtn = document.getElementById('linkedin-btn');

        let produitUrl = encodeURI(document.location.href);
        let produitNom = encodeURI('{{ $produit->nom }}');

        facebookBtn.setAttribute("href", 'http://www.facebook.com/sharer.php?href=${produitUrl}');
        // twitterBtn.setAttribute("href", 'http://www.twitter.com/sharer.php?href=${produitUrl}&text=${produitNom}');
        linkedinBtn.setAttribute("href", 'http://www.linkedin.com/shareArticle?url=${produitUrl}&title=${produitNom}');

    </script>
@endsection
