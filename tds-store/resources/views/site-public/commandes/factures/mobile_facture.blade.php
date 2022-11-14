
<div class="container-fluid col-md-8 offset-md-2 d-none">
    <div class="card" id="facture">
        <div class="card-body p-5">
            <div class="row">
                <div class="col-6" style="">
                    <p>
                        <img src="{{ asset('assets/img/tds.png') }}" alt="">
                    </p>
                    <h3 style=""> Facture #{{ $commande->id}} </h3>
                </div>
                <div class="col-6 text-center" style="">
                    <div class="">
                        @if (exist_commande_paiement($commande->id) != null)
                        <span style="font-size: 24px;" class="text-success font-weight-bold"> PAYE</span>
                        @else
                            <span style="font-size: 24px;" class="text-danger font-weight-bold"> NON PAYE</span>
                        @endif
                    </div>
                    <div class="small-text">
                        <?php
                            $date = "$commande->created_at";

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
                    <span>{{ $commande->created_at }} </span>
                </div>
                <div class="col-6 text-right">
                    <strong>Mode de paiement</strong>
                    <form action="">
                        <input type="hidden" name="mode" value="">
                        <select class="custom-select w-auto" name="mode">
                            <option value="">{{ $type_paiement }}</option>
                            <option selected>{{ $type_paiement }}</option>
                        </select>
                    </form>
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
                                        <td><strong>Prix ex TVA</strong></td>
                                        <td><strong>Sous-Total</strong></td>
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
                                            <td class="">{{  info_livraison($commande->id) != null ? number_format(info_livraison($commande->id)->montant, '0', '.', ' ') . ' F CFA ' : 'À communiquer' }}</td>
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
                                    @if(exist_commande_paiement($commande->id) != '')
                                        <td>{{ $pay->created_at }}</td>
                                        <td>{{ $type_paiement }}</td>
                                        <td>{{ $pay->reference}}</td>
                                        <td>{{ number_format($pay->montant, '0', '.', ' ' ) }} F CFA</td>
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
