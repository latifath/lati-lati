@extends('layouts.master-dashboard')
@section('detail')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Commandes',
    'infos2' => 'Commandes',
    'infos3' => 'détails commande',
])
<br>

<div class="col-12">
        <div class="card border-secondary mb-5">
                <div class="card-header border-0" style="{{ couleur_principal() }}; font-size: 24px;">
                    <h4 class="font-weight-semi-bold m-0 text-center">Commande #{{ $id }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Montant</th>
                            <th>Sous total</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0 ;
                            @endphp
                            @foreach($commande_detail as $item)
                            @php $total += $item['prix'] * $item['quantite'] @endphp
                                <tr>
                                    <td>{{ produit($item->produit_id)->nom}}</td>
                                    <td>{{ $item->quantite }}</td>
                                    <td>{{number_format($item->prix, 0, '.', ' ') }} F CFA</td>
                                    <td>{{ number_format($item->quantite * $item->prix, 0, '.', ' ') }} F CFA</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            <div class="card-footer border-secondary bg-transparent">
                <div class="d-flex justify-content-between mt-2">
                    <h5 class="font-weight-bold" >Remise</h5>
                    <h5 class="font-weight-bold">{{ valeur_coupon_cmde($commande->promotion) != null ? valeur_coupon_cmde($commande->promotion) : 'null' }}</h5>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <h5 class="font-weight-bold">TVA</h5>
                    <h5 class="font-weight-bold" >{{ $commande->tva == 1 ? '18%' : '0%' }}</h5>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <h5 class="font-weight-bold" style="{{ couleur_text_2() }}">Total</h5>
                    <h5 class="font-weight-bold"  style="{{ couleur_text_2() }}">{{ number_format(montant_ttc(montant_apres_reduction_sans_session(total_commande($commande->id), $commande->promotion), $commande->adresse_livraison_id) , '0', '.', ' ') }} F CFA</h5>
                </div>
            </div>
        </div>
</div>
<br><br>
<div class="col-12">
    <div class="card border-secondary mb-5">
            <div class="card-header border-0" style="{{ couleur_principal() }}; font-size: 24px;">
                <h4 class="font-weight-semi-bold m-0 text-center">Adresse Client</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Pays</th>
                        <th>Rue</th>
                        <th>Ville</th>
                        <th>Code postal</th>
                    </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ adresseclient($commande->adresse_client_id)->nom }}</td>
                                <td>{{ adresseclient($commande->adresse_client_id)->prenom }}</td>
                                <td>{{ adresseclient($commande->adresse_client_id)->email }}</td>
                                <td>{{ adresseclient($commande->adresse_client_id)->telephone}}</td>
                                <td>{{ adresseclient($commande->adresse_client_id)->pays }}</td>
                                <td>{{ adresseclient($commande->adresse_client_id)->rue }}</td>
                                <td>{{ adresseclient($commande->adresse_client_id)->ville }}</td>
                                <td>{{ adresseclient($commande->adresse_client_id)->code_postal}}</td>

                            </tr>
                    </tbody>
                </table>
            </div>
            </div>
    </div>
</div>
<br>

<div class="col-12">
    <div class="card border-secondary mb-5">
            <div class="card-header border-0" style="{{ couleur_principal() }}; font-size: 24px;">
                <h4 class="font-weight-semi-bold m-0 text-center">Adresse Livraison</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Pays</th>
                        <th>Rue</th>
                        <th>Ville</th>
                        <th>Code postal</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ adresselivraison($commande->adresse_livraison_id)->nom }}</td>
                            <td>{{ adresselivraison($commande->adresse_livraison_id)->prenom }}</td>
                            <td>{{ adresselivraison($commande->adresse_livraison_id)->email }}</td>
                            <td>{{ adresselivraison($commande->adresse_livraison_id)->telephone}}</td>
                            <td>{{ adresselivraison($commande->adresse_livraison_id)->pays }}</td>
                            <td>{{ adresselivraison($commande->adresse_livraison_id)->rue }}</td>
                            <td>{{ adresselivraison($commande->adresse_livraison_id)->ville }}</td>
                            <td>{{ adresselivraison($commande->adresse_livraison_id)->code_postal}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            </div>
    </div>
</div>

<br><br>
<div class="col-12">
    <div class="card border-secondary mb-5">
            <div class="card-header border-0"  style="{{ couleur_principal() }}; font-size: 24px;">
                <h4 class="font-weight-semi-bold m-0 text-center">Détails paiement</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Type de paiement</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if( exist_commande_paiement($commande->id) !=null)
                        <tr>
                            <td>{{ number_format($paiement->montant, '0', '.', ' ') }} F CFA</td>
                            <td>{{ $paiement->created_at }}</td>
                            <td>{{ $paiement->type_paiement }}</td>
                        </tr>
                        @else
                        <tr>
                        <td colspan="3" class='text-center'> Aucune transaction trouvée</td>
                         </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            </div>
    </div>
</div>

@endsection
