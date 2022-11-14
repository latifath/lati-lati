@extends('layouts.master')

@section('head')
<script src="https://www.paypal.com/sdk/js?client-id=AUIH145OuUGKi0m4xp3aJuBpRn1TdOqKop0QiUD_cRo12VqQeIA2siBz0DEasrmL_eaO_PF2VfnHFqkl&currency=USD"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AUIH145OuUGKi0m4xp3aJuBpRn1TdOqKop0QiUD_cRo12VqQeIA2siBz0DEasrmL_eaO_PF2VfnHFqkl"></script>

{{-- pour le select --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />

@endsection
@section('validation')
<!-- Page Header Start -->
<div class="container-fluid mb-5" style='{{ couleur_background_1() }}'>
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
        <div class="d-inline-flex">
            <p class="m-0"><a href="/"><i class="fa fa-home" style="{{ couleur_blanche() }}"></i></a></p>
            <p class="m-0 px-2" style="{{ couleur_blanche() }}">/</p>
            <p class="m-0" style="{{ couleur_blanche() }}">Validation payement</p>
        </div>
    </div>
</div>
<!-- Page Header End -->
<div class="container-fluid pt-2">
    <div class="row px-xl-5">
        @include('layouts.partials.sidebar')
        <div class="col-md-9">
            <div class="row col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead style="color: dark; {{ couleur_principal() }}">
                            <tr>
                                <th>Identifiant commande</th>
                                <th>Date</th>
                                <th>Coupon</th>
                                <th>TVA</th>
                                <th>Expédition</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $commande->id }}</td>
                                <td>{{ $commande->created_at }}</td>
                                <td>{{ valeur_coupon_cmde($commande->promotion) != null ? valeur_coupon_cmde($commande->promotion) : 'null' }} </td>
                                <td>{{ $commande->tva == 1 ? '18%' : '0%' }}</td>
                                <td style="{{ couleur_text_2() }}">{{ info_livraison($commande->id)->montant != null ? number_format(info_livraison($commande->id)->montant, '0', '.', ' ') . ' F CFA ' : 'à communiquer' }} </td>
                                <td style="{{ couleur_text_2() }}">{{  number_format((montant_ttc(montant_apres_reduction_sans_session($sub_total, $commande->promotion), $commande->adresse_livraison_id) + info_livraison($commande->id)->montant), '0', '.', ' ' ) }} F CFA</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <h2 class="pt-4">Adresse facturation </h2>
                        <button id="btn_edit_adr_fact" class="btn pt-4"><i class="fa fa-edit" aria-hidden="true"></i></button>
                    </div>
                  <table class="table table-bordered text-center">
                    <div class="align-block" style="box-shadow: 20px 20px 50px;">
                        <tr>
                            <td class="border-0 float-left"> {{ adresseclient($commande->adresse_client_id)->nom . " " . adresseclient($commande->adresse_client_id)->prenom }}</td>
                        </tr>
                        <tr>
                            <td class="border-0 float-left"> {{ adresseclient($commande->adresse_client_id)->rue . " " . adresseclient($commande->adresse_client_id)->ville}}</td>
                        </tr>
                        <tr>
                            <td class="border-0 float-left"> {{ adresseclient($commande->adresse_client_id)->code_postal . " " . adresseclient($commande->adresse_client_id)->pays  }}</td>
                        </tr>
                        <tr>
                            <td class="border-0 float-left"><i class="fa fa-envelope" aria-hidden="true"></i> {{ adresseclient($commande->adresse_client_id)->email }}</td>
                        </tr>
                        <tr>
                            <td class="border-0 float-left"><i class="fa fa-phone-alt" aria-hidden="true"></i> {{ adresseclient($commande->adresse_client_id)->telephone }}</td>
                        </tr>
                    </div>
                 </table>
                </div>
                <div class=col-sm-6 >
                    <div class="row">
                        <h2 class="pt-4">Adresse livraison </h2>
                        <button id="btn_edit_adr_livr" class="btn pt-4"><i class="fa fa-edit" aria-hidden="true"></i></button>
                    </div>
                    <table class="table table-bordered text-center">
                        <div class="align-block" style="box-shadow: 20px 20px 50px;">
                            <tr>
                                <td class="border-0 float-left"> {{ adresselivraison($commande->adresse_livraison_id)->nom . " " . adresselivraison($commande->adresse_livraison_id)->prenom }}</td>
                            </tr>
                            <tr>
                                <td class="border-0 float-left"> {{ adresselivraison($commande->adresse_livraison_id)->rue . " " . adresselivraison($commande->adresse_livraison_id)->ville}}</td>
                            </tr>
                            <tr>
                                <td class="border-0 float-left"> {{ adresselivraison($commande->adresse_livraison_id)->code_postal. " " . adresselivraison($commande->adresse_livraison_id)->pays  }}</td>
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
            @if ($type_paiement == "livraison" )
            <p class="pt-3">Merci pour votre commande, Cliquez sur le boutton <strong>continuer</strong></p>
            @else
            <p class="pt-3">Merci pour votre commande, Cliquez sur le boutton <strong>Procéder au paiement</strong></p>
            @endif
            <div class="mb-4">
                <div class="col-sm-12">

                    <a href="{{ route('root_site_public_annuler_commande', $commande->id) }}">
                        <button class="btn btn-primary my-3 py-3">Annuler la commande</button>
                    </a>

                    @if ($type_paiement == "momo")
                    <button class="kkiapay-button btn btn-primary my-3 py-3">Procéder au paiement</button>
                    @elseif($type_paiement == "card")
                    <button class="kkiapay-button btn btn-primary my-3 py-3 mx-1">Procéder au paiement</button>
                    @elseif($type_paiement == "paypal")
                    <div id="paypal-button-container">
                        {{-- <button class="paypal.Buttons btn btn-primary my-3 py-3">PayPal</button> --}}
                    </div>
                    @elseif($type_paiement == "livraison")
                    <a href="{{ route('root_site_public_commande_recue', [$commande->id, $type_paiement])  }}">
                        <button class="btn btn-primary my-3 py-3 px-4"> Continuez</button>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('site-public.commandes._modal-edit-adresse')

@endsection

@section('js')
<script amount="{{ montant_ttc(montant_apres_reduction($sub_total), $commande->adresse_livraison_id) + verify_amount_livraison_exist(info_livraison($commande->id)) }}" paymentmethod="{{ $type_paiement }}" callback="http://127.0.0.1:8000/validation-commmande/{{ $commande->id }}/commande-reçue/type-paiement-{{ $type_paiement }}" data="" url="https://technodatasolutions.bj/img/logo.png" position="center" theme="#0095ff" sandbox="true" key="08785180ecc811ec848227abfc492dc7" src="https://cdn.kkiapay.me/k.js"></script>

<script>
    $(document).ready(function(){
        $("select#ville1").change(function(){
            var option_ville = $(this).children("option:selected").val();
            if (option_ville == "autres") {
                $('.ville2').show();
            }else{
                $('.ville2').hide();
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script>
    $( 'select' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
    } );


    $(document).on('click', '#btn_edit_adr_fact', function(){
        $('#ModalEditAdresseFacturation').modal('show');
    });

    // adresse livraison

    $(document).on('click', '#btn_edit_adr_livr', function(){
        $('#ModalEditAdresseLivraison').modal('show');
    });


    paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '{{montant_ttc(montant_apres_reduction($sub_total), $commande->adresse_livraison_id) }}' // Can also reference a variable or function
              }
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Transaction \${transaction.status}: \${transaction.id}\n\nSee console for all available details`);

            // var firstname = $('.firstname').val();
            // var lastname = $('.lastname').val();

            console.log(orderData.id);
            // console.log(orderData);

            $.ajax({
                type: "POST",
                url: "/place-order",
                data: {
                    // 'fname': firstname,
                    // 'lname': lastname,
                    'payment_mode':"Paid by PayPal",
                    'payment_id':orderData.id,
                },
                success: function(response){
                    console.log(orderData);
                    // swal(response.status);
                    // window.location.href = "/my-orders";
                    // console.log(response.status);
                    alert('Transaction');
                }
            });




            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
          });
        }
      }).render('#paypal-button-container');

</script>
@endsection

