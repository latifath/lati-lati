@extends('layouts.master', ['titre' => 'moi'])

@section('head')
<style>
    .img-fluid-scat-product {
        width: 200px;
        height: 300px;
        object-fit: contain;
    }
    .img-partenaire{
        width: 80px;
        height: 120px;
        object-fit: contain;
    }
</style>
 @endsection
@section('produit')
    <div class="container-fluid ">
        <div class="row px-xl-5 pb-3">
            @include('layouts.partials.sidebar')
            {{-- carousel --}}
            <div class="col-lg-9">
                <div class="container-fluid pt-2">
                    <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2"  style="{{ couleur_text_2() }}">Nos produits</span></h2>
                    </div>
                    <div class="row px-xl-5 pb-3">
                        @foreach ($sous_categories_produits as $produit)
                            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                                <div class="card product-item border-0 mb-4">
                                    <div
                                        class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid-scat-product w-100" src="{{ path_image($produit->image) ? asset(path_image_produit() . path_image($produit->image)->filename) : ''}}" alt="">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate mb-3">{{ $produit->nom}}</h6>
                                        <div class="d-flex justify-content-center">
                                            @if($produit->prix_promotionnel != null)
                                                <h6 class="text-muted ml-2"><del>{{ number_format($produit->prix, 0, '.', ' ') }} F CFA </del></h6>
                                                <h6 class="ml-3"> {{ number_format($produit->prix_promotionnel, 0, '.', ' ') }} F CFA</h6>
                                            @else
                                                <h6>{{ number_format($produit->prix, 0, '.', ' ') }} F CFA</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="{{ route('root_sitepublic_show_produit_par_sous_categorie', [$cat, $sous_cat, $produit->slug])}}" class="btn btn-sm p-0 mt-3" style="color: #343a40;"><i
                                                class="fas fa-eye" style="{{ couleur_text_2() }}"></i>Voir les details
                                        </a>
                                        <form action="{{ route('root_create_panier', $produit) }}" method="POST">
                                            @csrf
                                            <div class=" mb-4 pt-2 mt-1">
                                                <div class="input-group quantity mr-3" style="">
                                                    <input type="hidden" id="id" name="id" value="{{ $produit->id }}">
                                                    <input type="hidden" class="form-control bg-secondary text-center" value="1" name="quantite">
                                                </div>
                                                <button type="submit" class="btn btn-primary tx" style="display: flex; font-size: 11px;"><i class="fa fa-shopping-cart mr-1 mt-0"></i> Ajouter</button>
                                            </div>
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

    @include('layouts.partials.partenaire')

@endsection
