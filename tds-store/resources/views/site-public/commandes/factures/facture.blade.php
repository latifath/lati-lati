<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TDS-store</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<style>

    @media (max-width: 992px) {
        .logo {
            width: 60%;
        }
        .custom-select {
            width: 50%;
            height: 50%;
        }
        #btn-envoie {
        margin-top: 10px;
    }
    #btn-kkiapay {
        margin-left: 10px ! important;

    }
    .kkiapay-button{
        width: 130px;
        height: 100px;
    }
    .col-6{
        padding-right: 0px !important;
        padding-left: 5px !important;
    }
    #pay{
        font-size: 14px;
    }
}
</style>

<body>
    <div class="container-fluid col-md-8 offset-md-2">
        <div class="card" id="facture">
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-6" style="">
                        <p>
                            <img src="{{ asset('assets/img/tds.png') }}" alt="tds" class="logo">
                        </p>
                        <h3 style=""> Facture #{{ $invoice->id}} </h3>
                    </div>

                    <div class="col-6 text-center" style="">
                        <div class="">
                            @if ($invoice->date_paid)
                            <span style="font-size: 24px;" class="text-success font-weight-bold"> PAYE</span>
                            @elseif($invoice->date_cancel)
                               <span style="font-size: 24px;" class="text-danger font-weight-bold"> ANNULE</span>
                            @else
                                <span style="font-size: 24px;" class="text-danger font-weight-bold"> NON PAYE</span><br>
                                @if( isset($_GET['type_paiement']))
                                    <div class="col-6 text-right " style="margin-left: 110px;" id="btn-kkiapay">
                                        @if($_GET['type_paiement'] == "momo")
                                            <button class="kkiapay-button btn btn-success my-3 py-3">Procéder au paiement</button>
                                        @elseif($_GET['type_paiement'] == "carte_bancaire")
                                            <button class="kkiapay-button btn btn-primary my-3 py-3 mx-1">Procéder au paiement</button>
                                        @elseif($_GET['type_paiement'] == "paypal")
                                            <div id="paypal-button-container">
                                                <button class="paypal.Buttons btn btn-primary my-3 py-3">PayPal</button>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <br>
                            @endif
                        </div>
                        <div class="small-text">
                            <?php
                                $date = "$invoice->created_at";

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
                        @if ($adresseclient)
                            <p class="small-text">
                                {{ $adresseclient->nom . " " . $adresseclient->prenom }} <br>
                                {{ $adresseclient->rue  }}, {{ $adresseclient->ville }} <br>
                                {{ $adresseclient->code_postal }}, {{ $adresseclient->pays }}
                            </p>
                        @endif
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
                        <span>{{ $invoice->created_at }} </span>
                    </div>

                    <div class="col-6 text-right">
                            <strong>Mode de paiement</strong>
                            @if ($invoice->date_paid)
                                <select class="custom-select w-auto" name="mode">
                                    <option selected>{{ $invoice->payment_method ?? '' }}</option>
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
                                        @foreach ($items as $item)
                                            @php $sub_total += $item['quantite'] * $item['prix'] @endphp

                                            <tr>
                                                <td>{{ $commande ? produit($item->produit_id)->nom : $item->description }}</td>
                                                <td>{{ $commande ? $item->quantite : $item->quantity }}</td>
                                                <td>{{ number_format($commande ? produit($item->produit_id)->prix : $item->price, '0', '.', ' ')}}</td>
                                                <td>{{ number_format($commande ? $item->quantite * $item->prix : $item->amount,'0', '.', ' ') }} F CFA</td>
                                            </tr>
                                        @endforeach

                                            <tr class="">
                                                <td colspan="3" class="text-right"><strong>Total</strong></td>
                                                <td class="">{{ number_format($commande ? $sub_total : $invoice->subtotal, '0', '.', ' ') }} F CFA</td>
                                            </tr>
                                            <tr class="">
                                                <td colspan="3" class="text-right"><strong>TVA</strong></td>
                                                <td class="">{{ $invoice->tva == 1 ? '18%' : '0%' }}</td>
                                            </tr>
                                            @if ($commande)
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
                                            @php
                                                $amount_ttc = montant_ttc(montant_apres_reduction_sans_session($sub_total, $commande->promotion), $commande->adresse_livraison_id) + info_livraison($commande->id)->montant;
                                            @endphp
                                            @endif
                                            <tr class="">
                                                <td colspan="3" class="text-right"><strong>Montant Total</strong></td>
                                                <td class="">{{ number_format($commande ? $amount_ttc : $invoice->total,  0, '.', ' ' ) }} F CFA</td>
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
                                        @if($invoice->date_paid)
                                            <td>{{ $commande ? $commande->created_at : $invoice->created_at }}</td>
                                            <td>{{ $invoice->payment_method }}</td>
                                            <td>{{ $invoice->reference }}</td>
                                            <td>{{ number_format(kkiapay($invoice->reference)->amount,  0, '.', ' ' ) }} F CFA</td>
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
        <div class="row py-5 float-right pr-3">
            <a href="{{ route('root_espace_client_paiement_index') }}">
                <button class="btn mx-4" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button>
            </a>

            <button class="btn border" onClick="imprimer('facture')" style="{{ couleur_background_1() }}; {{ couleur_blanche() }}; text-white;">
                <i class="fa fa-print" aria-hidden="true" input type="button" value="Imprimer"> </i> Imprimer
            </button>
        </div>
    </div>

    <script amount="{{ $commande ? montant_ttc(montant_apres_reduction($sub_total), $commande->adresse_livraison_id) + verify_amount_livraison_exist(info_livraison($commande->id)) : $invoice->total }}" paymentmethod="" callback="http://127.0.0.1:8000/espace-client/facture/{{ $invoice->id }}?type_paiement={{ isset($_GET['type_paiement']) ? $_GET['type_paiement'] : ' ' }}" data="" url="https://technodatasolutions.bj/img/logo.png" position="center" theme="#0095ff" sandbox="true" key="08785180ecc811ec848227abfc492dc7" src="https://cdn.kkiapay.me/k.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script src=https://code.jquery.com/jquery-3.4.1.min.js></script>
    <script src=https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js></script>
    <script>
        function imprimer(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload();
        }
    </script>

    @include('flashy::message')

</body>
</html>
