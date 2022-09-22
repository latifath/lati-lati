@extends('layouts.master-dashboard')

@section('les-info')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Commandes',
    'infos2' => 'Commandes',
    'infos3' => 'Détails commande',
])
<br>

<div class="row">
    <div class="col-6 offset-sm-3">
        <button  id="confirmation" data-id="{{ $commande->id }}" class="btn-success my-2 py-2" {{ disabled_button_commande($commande->status, 'terminee') }}><i class="fa fa-check">Accepter la commande</i> </button>

        <button id="btn_annule_commande"  data-id="{{ $commande->id }}" class="btn-secondary my-2 py-2 mx-2" type="submit" style="border: 1px solid;" {{ disabled_button_commande($commande->status, 'annulee') }}>Annuler la commande</button>

        <button id="btn_commande_en_attente" data-id="{{ $commande->id }}" class="btn-light my-2 py-2" type="submit" style="border: 1px solid;" {{ disabled_button_commande($commande->status, 'en cours') }}>Mettre en attente</button>

        <button id="btn_delete_commande" data-id="{{ $commande->id }}" class="btn-danger my-2 py-2  mx-2" type="submit">Supprimer la commande</button>

    </div>
</div>

@include('layouts.modal', ["route" => route('root_espace_admin_delete_commande', 0), 'nom'=>'cette commande'])

<div class="row mt-2">
    <div class="col-md-12 col-sm-12">
        <div class="card m-b-30" >
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Historiques</h4>
            </div>

            <div class="card-body">
                <p class="text-center" style="font-size: 24px;"><strong>Adresse client</strong></p>

                <div class="row mt-3">
                    <div class="col-sm-4">
                        <strong>Nom & Prénom</strong>
                    </div>
                    <div class="col-sm-6">{{ adresseclient($adr_cli->id)->nom }} {{ $adr_cli->prenom }}</div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <strong>E-mail</strong>
                    </div>
                    <div class="col-sm-6">{{  $adr_cli->email }}</div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <strong>Téléphone</strong>
                    </div>
                    <div class="col-sm-6">{{ $adr_cli->telephone }}</div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <strong>Rue & Ville</strong>
                    </div>
                    <div class="col-sm-6">{{ $adr_cli->rue }} {{ $adr_cli->ville }}</div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <strong>Code Postal & Pays</strong>
                    </div>
                    <div class="col-sm-6">{{ $adr_cli->code_postal }} {{ $adr_cli->pays }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12 col-sm-12">
        <div class="card m-b-30" >
            <div class="card-body">
                <p class="text-center" style="font-size: 24px;"><strong>Adresse livraison</strong></p>

                <div class="row mt-3">
                    <div class="col-sm-4">
                        <strong>Nom & Prénom</strong>
                    </div>
                    <div class="col-sm-6">{{ $adr_livr->nom}} {{ $adr_livr->prenom }}</div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <strong>E-mail</strong>
                    </div>
                    <div class="col-sm-6">{{  $adr_livr->email }}</div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <strong>Téléphone</strong>
                    </div>
                    <div class="col-sm-6">{{ $adr_livr->telephone }}</div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <strong>Rue & Ville</strong>
                    </div>
                    <div class="col-sm-6">{{ $adr_livr->rue }} {{ $adr_livr->ville }}</div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <strong>Code Postal & Pays</strong>
                    </div>
                    <div class="col-sm-6">{{ $adr_livr->code_postal }} {{ $adr_livr->pays }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Détails commande</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <td><strong>Description</strong></td>
                                <td><strong>Nom</strong></td>
                                <td><strong>Qty</strong></td>
                                <td><strong>Prix ex TVA</strong></td>
                                <td><strong>Sous-total</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sub_total = 0 ;
                            @endphp
                                @foreach ($commande_produit as $item)
                                    @php $sub_total += $item['quantite'] * $item['prix'] @endphp
                                    <tr>
                                        <td>{!! $item->produit->description !!}</td>
                                        <td>{{$item->produit->nom }}</td>
                                        <td>{{ number_format($item->prix, '0', '.', ' ') }} F CFA</td>
                                        <td>{{ $item->quantite }}</td>
                                        <td>{{ number_format($sub_total, '0', '.', ' ') }} F CFA</td>
                                   </tr>
                                @endforeach

                                <tr class="">
                                    @if ($commande->promotion != null)

                                    <td colspan="4" class="text-right"><strong>Remise</strong></td>
                                    <td class="">{{ valeur_coupon_cmde($commande->promotion) != null ? valeur_coupon_cmde($commande->promotion) : 'null' }}</td>
                                    @endif

                                </tr>
                                    <tr class="">
                                        <td colspan="4" class="text-right"><strong>TVA</strong></td>
                                        <td class="">{{ $commande->tva == 1 ? '18%' : '0%' }}</td>
                                    </tr>
                                <tr style="{{ couleur_text_2() }}">
                                    <td colspan="4" class="text-right"><strong>Montant TTC</strong></td>
                                    <td class="">{{ number_format(montant_ttc(montant_apres_reduction_sans_session($sub_total, $commande->promotion), $commande->adresse_livraison_id),  0, '.', ' ' ) }} F CFA</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12">
    <div class="card m-b-30">
        <div class="card-header bg-success">
            <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Paiement</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Reference</th>
                        <th>Montant</th>
                        <th>Type paiement</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($paiement as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{$value->reference }}</td>
                            <td>{{ number_format($value->montant, '0', '.', ' ') }} F CFA</td>
                            <td>{{$value->type_paiement }}</td>
                            <td>{{$value->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('espace-admin.commandes._modal');
@endsection
@section('js')
<script>
    $(document).on('click', '#btn_delete_commande', function(){
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

    $(document).on('click', '#confirmation', function(){
       var id = $(this).attr('data-id');

       $('#item_id').val(id);

       $('#ConfirmationModalCenter').modal('show');
   });

   $(document).on('click', '#btn_annule_commande', function(){
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#AnnulerModalCenter').modal('show');
    });

    $(document).on('click', '#btn_commande_en_attente', function(){
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#CommandeAttenteModalCenter').modal('show');
    });
</script>
@endsection
