@extends('layouts.master-dashboard')
@section('Paiement-create')
    @include('layouts.partials-dashboard.entête-page', [
        'infos1' => 'Commandes #',
        'infos2' => 'Toutes les commandes',
        'infos3' => 'Ajouter paiement',
    ])
    <br>
    <style>
        .nav-link {
            color: #01674e;
        }
    </style>

    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="col-md-12 mt-2">
                        <p class="text-justify"></p>
                        <!-- Nav pills -->
                        <ul class="nav nav-tabs" style="font-size: 18px;">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#resume">Résumé</a>
                            </li>
                            @if($commande->status != 'terminee')
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#paiement">Ajouter un paiement</a>
                            </li>
                            @else
                            @endif
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content mt-4">
                            <div class="tab-pane mx-0 active" id="resume">
                                <div class="row mb-5" style="font-size: 15px;">
                                    <div class="col-md-6">
                                        <table class="table table-bordered text-center">
                                            <div class="align-block" style="box-shadow: 20px 20px 50px; font-size: 20px">

                                                <tr>
                                                    <td class="border-0 float-left">Nom du client: <span
                                                            style="{{ couleur_text_1() }}; font-size: 16px;">{{ $adr_cli->nom }}
                                                            {{ $adr_cli->prenom }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-0 float-left">Date de facturation: <span
                                                            style="{{ couleur_text_1() }}">{{ $commande->created_at }}
                                                        </span></td>
                                                </tr>

                                                @if (exist_commande_paiement($commande->id) == null)

                                                <tr>
                                                    <td class="border-0 float-left">Total dû: <span
                                                            style="{{ couleur_text_2() }}">{{  number_format(montant_ttc(montant_apres_reduction_sans_session(total_commande($commande->id), $commande->promotion), $commande->adresse_livraison_id), '0', '.', ' ') }} F CFA</span>
                                                    </td>
                                                </tr>
                                                @else

                                                <tr>
                                                    <td class="border-0 float-left">Solde: <span
                                                        style="{{ couleur_text_2() }}">{{ number_format(account_commande($commande->id)->montant, '0', '.', ' ') }} F CFA</span>
                                                    </td>
                                                </tr>
                                                @endif
                                            </div>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        @if (exist_commande_paiement($commande->id) == null)
                                            <span style="font-size: 24px;" class="text-danger font-weight-bold"> NON
                                                PAYE</span>
                                        @else
                                            <span style="font-size: 24px;" class="text-success font-weight-bold">
                                                PAYE</span>
                                            <p>Méthode de paiement: <strong style="font-size: 16px">
                                                    {{ account_commande($commande->id)->type_paiement }}</strong></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="card col-12 p-0 mt-5">
                                    <div class="card-header">
                                        <h3 class="panel-titre">
                                            <strong>Items de la facturation</strong>
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Description</strong></td>
                                                        <td><strong>Qty</strong></td>
                                                        <td><strong>Prix</strong></td>
                                                        <td><strong>Sous-total</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (detail_commande($commande->id) as $item)
                                                        <tr>
                                                            <td>{{ produit($item->produit_id)->nom }}</td>
                                                            <td>{{ $item->quantite }}</td>
                                                            <td>{{ number_format(produit($item->produit_id)->prix, '0', '.', ' ') }} F CFA</td>
                                                            <td>{{ number_format($item->quantite * $item->prix, '0', '.', ' ') }} F CFA
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    <tr class="">
                                                        @if ($commande->promotion != null)

                                                        <td colspan="3" class="text-right"><strong>Remise</strong></td>
                                                        <td class="">{{ valeur_coupon_cmde($commande->promotion) != null ? valeur_coupon_cmde($commande->promotion) : 'null' }}</td>
                                                        @endif

                                                    </tr>

                                                    <tr class="">
                                                        <td colspan="3" class="text-right"><strong>TVA</strong></td>
                                                        <td class="">{{ $commande->tva == 1 ? '18%' : '0%' }}</td>
                                                    </tr>

                                                    <tr class="">
                                                        <td colspan="3" class="text-right"><strong
                                                                style="{{ couleur_text_2() }}">Montant Total</strong></td>
                                                        <td class=""style="{{ couleur_text_2() }}">
                                                            {{  number_format(montant_ttc(montant_apres_reduction_sans_session(total_commande($commande->id), $commande->promotion), $commande->adresse_livraison_id), '0', '.', ' ')}} F CFA</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="card m-b-30">
                                            <div class="card-header bg-success">
                                                <h4 class="mt-0 header-title text-white"
                                                    style="font-size: 24px; text-align: center;">Paiement</h4>
                                            </div>

                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered dt-responsive nowrap"
                                                        style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Type paiement</th>
                                                                <th>Montant</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (exist_commande_paiement($commande->id) != null)
                                                                <tr>
                                                                    <td>{{ $paiement->created_at }}</td>
                                                                    <td>{{ $paiement->type_paiement }}</td>
                                                                    <td>{{number_format($paiement->montant, '0', '.', ' ') }} F CFA</td>
                                                                </tr>
                                                            @else
                                                                <tr>

                                                                    <td colspan="3" class="text-center">Aucune
                                                                        transaction trouvé</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- ajouter paiement --}}
                            <div class="tab-pane mx-0 fade" id="paiement">
                                <div class="row mt-4">
                                    <div class="col-md-8 offset-md-2">
                                        <div class="card m-b-30">
                                            {{-- <div class="card-header bg-light">
                                            <h4 class="mt-2 header-title text-dark" style="font-size: 24px">Ajouter un paiement</h4>
                                        </div> --}}
                                            <div class="card-body">
                                                <form action="{{ route('root_espace_admin_paiement_create') }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for=""></label>
                                                        <input
                                                            class="form-control {{ $errors->has('commande_id') ? 'is-invalid' : '' }}"
                                                            style="height: 50px;" value="{{ $commande->id }}"
                                                            type="hidden" placeholder="" name="commande_id">
                                                        {!! $errors->first('commande_id', '<p class="text-danger">:message</p>') !!}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Date</label>
                                                        <input
                                                            class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"
                                                            style="height: 50px;" type="date" placeholder=""
                                                            name="date">
                                                        {!! $errors->first('date', '<p class="text-danger">:message</p>') !!}
                                                    </div>

                                                    <div class=" form-group">
                                                        <label for="">Type de paiement</label>
                                                        <select
                                                            class="custom-select {{ $errors->has('type_paiement') ? 'is-invalid' : '' }}"
                                                            style="height: 50px;" name="type_paiement">
                                                            <option value="">Choisir le type de paiement</option>
                                                            <option value="momo">MoMo</option>
                                                            <option value="carte_bancaire">Carte Bancaire</option>
                                                            <option value="paypal">PayPal</option>


                                                        </select>
                                                        {!! $errors->first('type_paiement', '<p class="text-danger">:message</p>') !!}
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="description">Montant</label>
                                                        <input
                                                            class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}"
                                                            style="height: 50px;" type="text" placeholder=""
                                                            name="montant">

                                                        {!! $errors->first('montant', '<p class="text-danger">:message</p>') !!}
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="description">Reférence</label>
                                                        <input
                                                            class="form-control {{ $errors->has('reference') ? 'is-invalid' : '' }}"
                                                            style="height: 50px;" type="text" placeholder=""
                                                            name="reference">

                                                        {!! $errors->first('reference', '<p class="text-danger">:message</p>') !!}
                                                    </div>

                                                    <div class="float-right">
                                                        <button type="submit" class="btn btn-primary">Ajouter un
                                                            paiement</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection