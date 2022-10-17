<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TDS-store</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
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
        .col-6{
            padding-right: 0px !important;
            padding-left: 5px !important;
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
                        <h3 style=""> Facture #{{ $cmde->id}} </h3>
                    </div>
                    <div class="col-6 text-center" style="">
                        <div class="">
                            @if (exist_commande_paiement($cmde->id) != null)
                            <span style="font-size: 24px;" class="text-success font-weight-bold"> PAYE</span>
                            @else
                                <span style="font-size: 24px;" class="text-danger font-weight-bold"> NON PAYE</span>

                            @endif
                        </div>
                        <div class="small-text">
                            <?php
                                $date = "$cmde->created_at";

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
                            {{ adresseclient($cmde->adresse_client_id)->nom  }} {{ adresseclient($cmde->adresse_client_id)->prenom }} <br>
                            {{ adresseclient($cmde->adresse_client_id)->rue  }}, {{ adresseclient($cmde->adresse_client_id)->ville }} <br>
                            {{ adresseclient($cmde->adresse_client_id)->code_postal }}, {{ adresseclient($cmde->adresse_client_id)->pays }}
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
                        <span>{{ $cmde->created_at }} </span>
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
                                            <td><strong>Sous-total</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sub_total = 0 ;
                                        @endphp
                                        @foreach (detail_commande($cmde->id) as $item)
                                        @php $sub_total += $item['quantite'] * $item['prix'] @endphp
                                        <tr>
                                            <td>{{ produit($item->produit_id)->nom }}</td>
                                            <td>{{ $item->quantite }}</td>
                                            <td>{{ number_format(produit($item->produit_id)->prix, '0', '.', ' ') }} F CFA</td>
                                            <td>{{ number_format($item->quantite * $item->prix,'0', '.', ' ') }} F CFA</td>
                                        </tr>
                                        @endforeach
                                            <tr class="">
                                                <td colspan="3" class="text-right"><strong> Total</strong></td>
                                                <td class="">{{ number_format(total_commande($cmde->id), '0', '.', ' ') }} F CFA</td>
                                            </tr>
                                            <tr class="">
                                                <td colspan="3" class="text-right"><strong> TVA</strong></td>
                                                <td class="">{{ $cmde->tva == 1 ? '18%' : '0%' }}</td>
                                            </tr>
                                            @if ($cmde->promotion != null)
                                                <tr class="">
                                                    <td colspan="3" class="text-right"><strong>Remise</strong></td>
                                                    <td class="">{{ valeur_coupon_cmde($cmde->promotion) != null ? valeur_coupon_cmde($cmde->promotion) : 'null' }} </td>
                                                </tr>
                                            @endif
                                            <tr class="">
                                                <td colspan="3" class="text-right"><strong>Montant Total</strong></td>
                                                <td class="">{{ number_format(montant_ttc(montant_apres_reduction_sans_session($sub_total, $cmde->promotion), $cmde->adresse_livraison_id),  0, '.', ' ' ) }} F CFA</td>
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
                                        @if(exist_commande_paiement($cmde->id) != '')
                                            <td>{{ $pay->created_at }}</td>
                                            <td>{{ $type_paiement }}</td>
                                            <td>{{ $pay->reference}}</td>
                                            <td>{{  number_format(montant_ttc(montant_apres_reduction($sub_total), $cmde->adresse_livraison_id),  0, '.', ' ' ) }} F CFA</td>
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
            <a href="{{ route('root_site_public_commande_recue', [$cmde->id, $type_paiement]) }}">
                <button class="btn mx-4" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-arrow-left" aria-hidden="true"></i>Retour</button>
            </a>

            <button class="btn border" onClick="imprimer('facture')" style="{{ couleur_background_1() }}; {{ couleur_blanche() }}; text-white;">
                <i class="fa fa-print" aria-hidden="true" input type="button" value="Imprimer"> </i> Imprimer
            </button>
        </div>
    </div>

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

</body>
</html>

