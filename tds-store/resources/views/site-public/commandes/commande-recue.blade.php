@extends('layouts.master')
@section('style')
<style>
    @media (max-width: 760px) {
    .facture {
        display: none;
    }
  }
  @media (min-width: 761px) {
    .facture_mobile{
        display: none;
    }
  }
</style>
@endsection
@section('commande-reçue')
<!-- Page Header Start -->
<div class="container-fluid mb-5" style='{{ couleur_text_1() }}'>
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px; {{ couleur_background_1() }};">
        <div class="d-inline-flex">
            <p class="m-0"><a href="/"><i class="fa fa-home" style="{{ couleur_blanche() }}"></i></a></p>
            <p class="m-0 px-2" style="{{ couleur_blanche() }}">/</p>
            <p class="m-0" style="{{ couleur_blanche() }}">Validation commande</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="container-fluid pt-0">
    <div class="row px-xl-5">
        @include('layouts.partials.sidebar')

        <div class="col-sm-8">
            <div class="">
                <h3>Merci!</h3>
                <p class="mb-4">Vous avez passé la commande avec succès.
                    Votre facture est disponible et téléchargeable.
                    <a href="{{ route('root_site_public_facture', [$commande, $type_paiement]) }}" class="facture btn btn-primary text-white tx" style="float: right; margin-bottom: 10px;" role="button">Facture</a>
                    <button class="btn border facture_mobile" onClick="imprimer('facture')" style="{{ couleur_background_1() }}; {{ couleur_blanche() }}; text-white;">
                        <i class="fa fa-print" aria-hidden="true" input type="button" value="Imprimer"> </i> Imprimer
                    </button>
                </p>
            </div>
            <table class="table table-bordered text-center">
                <thead style="color: dark; {{ couleur_principal() }}">
                    <tr>
                        <th>Identifiant commande</th>
                        <th>Date</th>
                        <th>Coupon</th>
                        <th>TVA</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->created_at }}</td>
                        <td>{{ valeur_coupon_cmde($commande->promotion) != null ? valeur_coupon_cmde($commande->promotion) : 'null' }} </td>
                        <td>{{ $commande->tva == 1 ? '18%' : '0%' }}</td>
                        <td style="{{ couleur_text_2() }}">{{ number_format (montant_ttc(montant_apres_reduction_sans_session(total_commande($commande->id), $commande->promotion), $commande->adresse_livraison_id), 0, '.', ' ') }} F CFA</td>

                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered text-center">
                <thead style="color: dark; {{ couleur_principal() }}">
                    <tr>
                        <th>Moyen de paiement</th>
                    <tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $type_paiement }}</td>
                    </tr>
                </tbody>
            </table>
            <h2 class="pt-4">Détails de la commande</h2>

            <table class="table table-bordered text-center">
                <thead style="color: dark; {{ couleur_principal() }}">
                    <tr>
                        <th>Produit</th>
                        <th>Total du produit</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_commande = 0 ;
                    @endphp
                    @foreach (detail_commande($commande->id) as $item)
                    <tr>
                        <td>{{ produit($item->produit_id)->nom . " x" . $item->quantite }}</td>
                        <td>{{ number_format($item->quantite *  $item->prix, '0', '.', ' ') }} F CFA</td>
                    </tr>
                    @php
                    $total_commande += ($item->quantite * $item->prix )
                    @endphp
                    @endforeach
                    <tr style="{{ couleur_text_2() }}">
                        <td class="border-right-0"><b> Sous total </b></td>
                        <td class="border-left-0">{{ number_format($total_commande, '0', '.', ' ') }} F CFA</td>
                    </tr>
                    <tr>
                        <td class="border-right-0">Remise :</td>
                        <td class="border-left-0">{{ $commande->promotion ?? 'non' }}</td>
                    </tr>
                    <tr>
                        <td class="border-right-0">TVA :</td>
                        <td class="border-left-0">{{ $commande->tva == 1 ? '18%' : '0%' }}</td>
                    </tr>

                    <tr>
                        <td class="border-right-0">Moyen de paiement :</td>
                        <td class="border-left-0">{{ $type_paiement }}</td>
                    </tr>
                    <tr>
                        <td class="border-right-0" style="{{ couleur_text_2() }}"><b>Montant TTC</b></td>
                        <td class="border-left-0" style="{{ couleur_text_2() }}"><b>{{  number_format(montant_ttc(montant_apres_reduction_sans_session($total_commande, $commande->promotion), $commande->adresse_livraison_id),  0, '.', ' ' ) }} F CFA</b></td>
                    </tr>

                </tbody>
            </table>
            <div class="col-md-6">
                <a href="{{ route('root_index') }}"><button class="btn btn-block btn-primary my-3 py-3">Commander une nouvelle fois</button></a>
            </div>
            <h2 class="pt-4">Adresse de facturation </h2>
            <table class="table table-bordered text-center">
                <div class="align-block" style="box-shadow: 20px 20px 50px;">
                    <tr>
                        <td class="border-0 float-left"> {{ adresseclient($commande->adresse_client_id)->nom . " " . adresseclient($commande->adresse_client_id)->prenom }}</td>
                    </tr>
                    <tr>
                        <td class="border-0 float-left"> {{ adresseclient($commande->adresse_client_id)->rue . " " . adresseclient($commande->adresse_client_id)->ville }}</td>
                    </tr>
                    <tr>
                        <td class="border-0 float-left"> {{ adresseclient($commande->adresse_client_id)->code_postal . " " . adresseclient($commande->adresse_client_id)->pays }}</td>
                    </tr>
                    <tr>
                        <td class="border-0 float-left"><i class="fa fa-envelope" aria-hidden="true"></i> {{ adresseclient($commande->adresse_client_id)->email }}</td>
                    </tr>
                    <tr>
                        <td class="border-0 float-left"><i class="fa fa-phone-alt" aria-hidden="true"></i> {{ adresseclient($commande->adresse_client_id)->telephone }}</td>
                    </tr>
                </div>
            </table>
            <div>
                <h2 class="pt-4">Adresse de livraison </h2>
                <table class="table table-bordered text-center">
                    <div class="align-block" style="box-shadow: 20px 20px 50px;">
                        <tr>
                            <td class="border-0 float-left"> {{ adresselivraison($commande->adresse_livraison_id)->nom . " " . adresselivraison($commande->adresse_livraison_id)->prenom }}</td>
                        </tr>
                        <tr>
                            <td class="border-0 float-left"> {{ adresselivraison($commande->adresse_livraison_id)->rue . " " . adresselivraison($commande->adresse_livraison_id)->ville }}</td>
                        </tr>
                        <tr>
                            <td class="border-0 float-left"> {{ adresselivraison($commande->adresse_livraison_id)->code_postal. " " . adresselivraison($commande->adresse_livraison_id)->pays }}</td>
                        </tr>
                        <tr>
                            <td class="border-0 float-left"><i class="fa fa-envelope" aria-hidden="true"></i> {{ adresselivraison($commande->adresse_livraison_id)->email }}</td>
                        </tr>
                        <tr>
                            <td class="border-0 float-left"><i class="fa fa-phone-alt" aria-hidden="true"></i> {{ adresselivraison($commande->adresse_livraison_id)->telephone }}</td>
                        </tr>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>

@include('site-public.commandes.mobile_facture')
@endsection


