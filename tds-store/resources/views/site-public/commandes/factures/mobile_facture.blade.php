
<div class="container-fluid col-md-8 offset-md-2 d-none">
    <div class="card" id="facture">
        <div class="card-body p-5"  style="padding: 0.75rem !important;">
            <div class="row">
                <div class="col-6" style="">
                    <p>
                        <img src="{{ asset('assets/img/tds.png') }}" alt="tds" class="logo" width="50%" height="20%">
                    </p>
                    <h3 style=""> Facture #{{ $commande->invoice->id}} </h3>
                </div>

                <div class="col-6 text-center" style="">
                    <div class="">
                        @if ($commande->invoice->date_paid)
                        <span style="font-size: 24px;" class="text-success font-weight-bold"> PAYE</span>
                        @elseif($commande->invoice->date_cancel)
                           <span style="font-size: 24px;" class="text-danger font-weight-bold"> ANNULE</span>
                        @else
                            <span style="font-size: 24px;" class="text-danger font-weight-bold"> NON PAYE</span><br>
                            @if( isset($_GET['type_paiement']))
                                <div class="col-6 text-right " style="margin-left: 150px;" id="btn-kkiapay">
                                    @if($_GET['type_paiement'] == "momo")
                                        <button class="kkiapay-button btn btn-success my-3">Procéder au paiement</button>
                                    @elseif($_GET['type_paiement'] == "card")
                                        <button class="kkiapay-button btn btn-primary my-3 mx-1">Procéder au paiement</button>
                                    @elseif($_GET['type_paiement'] == "paypal")
                                        <div id="paypal-button-container">
                                            <button class="paypal.Buttons btn btn-primary my-3">PayPal</button>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <br>
                        @endif
                    </div>
                    <div class="small-text">
                        <?php
                            $date = "$commande->invoice->created_at";

                        ?>
                        Date d'echéance: {{ date('Y-m-d', strtotime($date. ' + 14 days')) }}
                    </div>
                    <div class="paiement-btn-container hidden-print">
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-6 ">
                    <strong> Facturé à</strong>
                    <p class="small-text">
                        {{ adresseclient($commande->adresse_client_id)->nom  }} {{ adresseclient($commande->adresse_client_id)->prenom }} <br>
                        {{ adresseclient($commande->adresse_client_id)->rue  }}, {{ adresseclient($commande->adresse_client_id)->ville }} <br>
                        {{ adresseclient($commande->adresse_client_id)->code_postal }}, {{ adresseclient($commande->adresse_client_id)->pays }}
                </div>
                <div class="col-6 text-right">
                    <strong>Payé à</strong>
                    <p class="small-text">
                        TDS STORE <br>
                        Akpakpa, àproximité de la Béninoise <br>
                        +229 21335730 / +229 91435555 (WhatsApp)
                    </p>
                </div>
                <div class="col-6">
                    <strong>Date de facturation</strong><br>
                    <span>{{ $commande->invoice->created_at }} </span>
                </div>

                <div class="col-6 text-right">
                        <strong>Mode de paiement</strong>
                        @if ($commande->invoice->date_paid)
                            <select class="custom-select w-auto" name="mode">
                                <option selected>{{ $commande->invoice->payment_method ?? '' }}</option>
                            </select>
                        @else
                            <form action="" method="GET" id="paye">
                                <select class="custom-select type w-auto" name="type_paiement" >
                                    <option value="">{{ isset($_GET['type_paiement']) ? $_GET['type_paiement'] : 'type paiement' }}</option>
                                    <option value="momo">MoMo</option>
                                    <option value="card">Carte Bancaire</option>
                                    <option value="paypal">PayPal</option>
                                </select>
                                <button type="submit" class="btn bg-success text-white" id="btn-envoie">Envoyer</button>
                            </form>
                        @endif
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
                                        <td><strong>Prix HT</strong></td>
                                        <td><strong>Sous-total</strong></td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $sub_total = 0 ;
                                    @endphp
                                    @foreach (detail_commande($commande->id) as $item)
                                    @php $sub_total += $item['quantite'] * $item['prix'] @endphp

                                    <tr>
                                        <td>{{ produit($item->produit_id)->nom }}</td>
                                        <td>{{ $item->quantite }}</td>
                                        <td>{{ number_format(produit($item->produit_id)->prix, '0', '.', ' ')}}</td>
                                        <td>{{ number_format($item->quantite * $item->prix,'0', '.', ' ') }} F CFA</td>
                                    </tr>
                                    @endforeach

                                        <tr class="">
                                            <td colspan="3" class="text-right"><strong>Total</strong></td>
                                            <td class="">{{ number_format(total_commande($commande->id), '0', '.', ' ') }} F CFA</td>
                                        </tr>
                                        <tr class="">
                                            <td colspan="3" class="text-right"><strong>TVA</strong></td>
                                            <td class="">{{ $commande->tva == 1 ? '18%' : '0%' }}</td>
                                        </tr>
                                        <tr class="">
                                            <td colspan="3" class="text-right"><strong>Expédition</strong></td>
                                            <td class="">{{  verify_amount_livraison_exist(info_livraison($commande->id)) != null ? number_format(verify_amount_livraison_exist(info_livraison($commande->id)->montant), '0', '.', ' ') . ' F CFA ' : 'à communiquer'}}</td>
                                        </tr>
                                        @if ($commande->promotion != null)
                                            <tr class="">
                                                <td colspan="3" class="text-right"><strong>Remise</strong></td>
                                                <td class="">{{ valeur_coupon_cmde($commande->promotion) != null ? valeur_coupon_cmde($commande->promotion) : 'null' }}</td>
                                            </tr>
                                        @endif
                                    <tr class="">
                                    <td colspan="3" class="text-right"><strong>Montant Total</strong></td>
                                    <td class="">{{ number_format((montant_ttc(montant_apres_reduction_sans_session($sub_total, $commande->promotion), $commande->adresse_livraison_id) + info_livraison($commande->id)->montant),  0, '.', ' ' ) }} F CFA</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr class="text-center">
                                    <td><strong>Date de la commande</strong></td>
                                    <td><strong>Passerelle</strong></td>
                                    <td><strong>Transaction #</strong></td>
                                    <td><strong>Montant</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    @if($commande->invoice->date_paid)
                                        <td>{{ $commande->created_at }}</td>
                                        <td>{{ $commande->invoice->payment_method }}</td>
                                        <td>{{ $commande->invoice->reference }}</td>
                                        <td>{{ number_format((montant_ttc(montant_apres_reduction_sans_session($sub_total, $commande->promotion), $commande->adresse_livraison_id) + verify_amount_livraison_exist(info_livraison($commande->id))),  0, '.', ' ' ) }} F CFA</td>
                                    @else
                                        <td class="text-center" colspan="4">
                                            <span>Aucune transaction trouvée</span>
                                        </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
