@extends('layouts.master')
@section('panier')
<!-- Page Header Start -->
<div class="container-fluid mb-5" style="{{ couleur_background_1() }}">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
        <div class="d-inline-flex" style="{{ couleur_blanche() }}">
            <p class="m-0" ><a href="/" style="{{ couleur_blanche() }}" ><i class="fa fa-home"></i></a></p>
                <p class="text-muted px-1" style="{{ couleur_blanche() }}">/</p>
                <p class="m-0">Panier</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Cart Start -->
<div class="container-fluid pt-5">

    <div class="row px-xl-5">
        @include('layouts.partials.sidebar')

        @if(session()->has("panier"))

            <div class="col-lg-9 table-responsive mb-5">
                <div class="row">
                    @if (session()->has('message'))
                    <div class="alert alert-info" >{{ session('message') }}</div>
                    @endif
                    <div class="col-lg-12 mb-5">
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center mb-0">
                            <a href="{{ route('root_empty_panier') }}" class="btn btn-primary tx float-right mb-2"><i class="fa fa-trash" aria-hidden="true"></i> vider le panier</a>
                            <thead class="" style="color: dark; {{ couleur_principal() }}">
                                <tr>
                                    <th>Produits</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Sous-total</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @php
                                    $sub_total = 0 ;
                                    $total_ttc = 0;
                                 @endphp

                                <!-- On parcourt les produits du panier en session : session('basket') -->
                                @foreach (session("panier") as $key => $item)

                                    <!-- On incrémente le total général par le total de chaque produit du panier -->
                                    @php $sub_total += $item['price'] * $item['quantity'] @endphp
                                    <tr>
                                        <td class="align-middle"><img src="" alt="" style="width: 50px;"> {{ $item['name'] }}</td>
                                        <td class="align-middle">{{ number_format($item['price'], 0, '.', ' ') }} F CFA</td>
                                        <td class="align-middle">
                                            <form action="{{ route('root_create_panier', $key) }}" method="POST">
                                                @csrf
                                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-sm btn-primary btn-minus" >
                                                        <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm bg-secondary text-center" value="{{ $item['quantity'] }}" name='quantite' >

                                                    <div class="input-group-btn">
                                                        <button class="btn btn-sm btn-primary btn-plus" type="submit">
                                                            <i class="fa fa-plus"></i>
                                                        </button>

                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="align-middle">{{ number_format($item['price'] * $item['quantity'], 0, '.', ' ') }} F CFA</td>
                                        <td class="align-middle">
                                            <a href="{{ route('root_delete_panier', $key) }}" class="btn btn-sm " style="{{ couleur_background_2() }}"><i class="fa fa-times" style="{{ couleur_blanche() }}"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    @if(session()->has("stock"))
                        <div class="col-md-6 mt-5" >
                            <ul >
                                @foreach (session("stock") as $key => $item)
                                <li class="text-danger">
                                    La quantité du produit {{ $item['name'] }} est insuffisante : -{{ $item['qte'] }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-md-6 mt-5 {{ session()->has('stock') ? '' : 'offset-md-6' }}">
                        {{-- {{ dd(request()->session()->has('coupon')) }} --}}
                        @if (!request()->session()->has('coupon'))
                        <div class="mb-3">
                            <p> Si vous détenez un code coupon, entrez-le dans le champ ci-dessous</p>
                        </div>
                        <form class="mb-3" action="{{ route('site_public_verification_coupon') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control p-4" placeholder="Code coupon" name="code">
                                <div class="input-group-append">
                                    <button type=submit class="btn btn-primary">Appliquer Coupon</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <div class="mb-3">
                            <p> Un coupon est déjà appliqué.</p>
                        </div>
                        @endif
                        <div class="card border-secondary mb-5">
                            <div class="card-header bg-secondary border-0">
                                <h4 class="font-weight-semi-bold m-0">Récapitulatif du panier</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3 pt-1">
                                    <h6 class="font-weight-medium">Sous-total</h6>
                                    <h6 class="font-weight-medium">{{ number_format($sub_total,  0, '.', ' ' ) }} F CFA </h6>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <h6 class="font-weight-medium">Coupon
                                        @if (!request()->session()->has('coupon'))

                                        @else
                                        <form action="{{ route('site_public_delete_promotion') }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger border-0" ><i class="fa fa-trash"></i></button>
                                        </form>
                                        @endif
                                    </h6>
                                    <h6 class="font-weight-medium mt-1">{{ valeur_coupon() }} </h6>
                                </div>

                                {{-- <div class="d-flex justify-content-between mb-3">
                                    <h6 class="font-weight-medium">TVA</h6>
                                    <h6 class="font-weight-medium">{{ configuration()->tva == 1 ? '18%' : '0%' }}</h6>
                                </div> --}}

                                <div class="d-flex justify-content-between">
                                    <h6 class="font-weight-medium">Expédition</h6>
                                    <h6 class="font-weight-medium">0

                                    </h6>
                                </div>
                            </div>
                            <div class="card-footer border-secondary bg-transparent">
                                <div class="d-flex justify-content-between mt-2">
                                    <h5 class="font-weight-bold" style="{{ couleur_text_2() }}">Total</h5>
                                    @if(!request()->session()->has('coupon'))
                                    <h5 class="font-weight-bold" style="{{ couleur_text_2() }}">{{  number_format($sub_total,  0, '.', ' ' ) }} F CFA</h5>

                                    @else
                                    <h5 class="font-weight-bold" style="{{ couleur_text_2() }}">{{  number_format(montant_apres_reduction($sub_total),  0, '.', ' '  )}} F CFA</h5>
                                    @endif
                                </div>
                                <a href="{{ route('root_site_public_validation_commande') }}"><button class="btn btn-block btn-primary my-3 py-3">Passer à la caisse</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <p>Aucun produit</p>
        @endif
    </div>
</div>
<!-- Cart End -->
 @endsection
