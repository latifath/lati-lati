@extends('layouts.master', [
    'title' => $produit->nom,
    'site_name' => env('APP_NAME'),
    'description' => $produit->description,
    'image' => path_image($produit->image_id) ? asset(path_image_produit() . path_image($produit->image_id)->filename) : '',
    'url' => route('root_sitepublic_show_produit_par_sous_categorie', [$produit->sous_categorie->categorie->slug, $produit->sous_categorie->slug, $produit->slug]),
    'type' => 'Article',
    'image_widht' => '300',
    'image_height' => '300',
    'image_type' => 'image/jpeg'
],[
    'tcard' => "summary_large_image",
    'tsite' => "@latifa_monsia",
    'ttitle' => $produit->nom,
    'tdescription' => $produit->description,
    'timage' => path_image($produit->image_id) ? asset(path_image_produit() . path_image($produit->image_id)->filename) : ''
])

@section('head')
{{-- pour la barre de seach --}}
 <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>

 <style>
   .img-fluid-prod{
        width: 400px;
        height: 500px;
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
                                    <img class="img-fluid-prod" src="{{ path_image($produit->image_id) ? asset(path_image_produit() . path_image($produit->image_id)->filename) : ''}}" alt="Image">
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
                                    <a class="btn btn-primary h-100 a:hover" id="remove" >
                                        <i class="fa fa-minus text-white"></i>
                                    </a>
                                </div>
                                <input type="hidden" id="id" name="id" value="{{ $produit->id }}">
                                <input type="text" class="form-control bg-secondary text-center" value="1" name="quantite" id="qty" min="1">
                                <div class="input-group-btn">
                                    <a class="btn btn-primary h-100" id="add">
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
                                {{ showSharer(route('root_sitepublic_show_produit_par_sous_categorie', [$produit->sous_categorie->categorie->slug, $produit->sous_categorie->slug, $produit->slug]), "") }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 pt-0">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <p class="nav-item nav-link active" style="{{ couleur_text_2() }}">Caractéristiques</p>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3" style="{{ couleur_text_2() }}">Caractéristiques du produit</h4>
                        <p>{!! $produit->description !!}</p>
                        {{-- <p>{!! Str::substr($produit->description, 0, 120) !!} {!! Str::length($produit->description) > 120 ? '...' : '' !!}</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($sous_categories_produits != null)
    @if($sous_categories_produits->count() > 4)
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
                                <img class="img-fluid-autre w-100" src="{{ path_image($produit->image_id) ? asset(path_image_produit() . path_image($produit->image_id)->filename) : ''}}" alt="">
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
    @endif

@endif
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

@section('js')

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
@endsection
