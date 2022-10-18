@extends('layouts.master')

@section('head')
<script src="https://www.paypal.com/sdk/js?client-id=AUIH145OuUGKi0m4xp3aJuBpRn1TdOqKop0QiUD_cRo12VqQeIA2siBz0DEasrmL_eaO_PF2VfnHFqkl&currency=USD"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AUIH145OuUGKi0m4xp3aJuBpRn1TdOqKop0QiUD_cRo12VqQeIA2siBz0DEasrmL_eaO_PF2VfnHFqkl"></script>

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
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $commande->id }}</td>
                                <td>{{ $commande->created_at }}</td>
                                <td>{{ valeur_coupon_cmde($commande->promotion) != null ? valeur_coupon_cmde($commande->promotion) : 'null' }} </td>
                                <td>{{ $commande->tva == 1 ? '18%' : '0%' }}</td>
                                <td style="{{ couleur_text_2() }}">{{  number_format(montant_ttc(montant_apres_reduction_sans_session($sub_total, $commande->promotion), $commande->adresse_livraison_id), '0', '.', ' ' ) }} F CFA</td>
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
            <p class="pt-3">Merci pour votre commande, Cliquez sur le boutton <strong>Procéder au paiement</strong></p>
            <div class="mb-4">
                <div class="col-sm-12">

                    <a href="{{ route('root_site_public_annuler_commande', $commande->id) }}">
                        <button class="btn btn-primary my-3 py-3">Annuler la commande</button>
                    </a>

                    @if ($type_paiement == "momo")
                    <button class="kkiapay-button btn btn-primary my-3 py-3">Procéder au paiement</button>
                    @elseif($type_paiement == "carte_bancaire")
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
{{-- adresse facturation --}}
<div class="modal fade" id="ModalEditAdresseFacturation" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalEditAdresseFacturationTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification Adresse Facturation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_site_public_edit_adresse_facturation') }}" id="" method="POST">
                @csrf
                <div class="modal-body p-0" style="background-color: #ffff;">
                    <div class="">
                        <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" value="{{ adresseclient($commande->adresse_client_id)->id}}" type="hidden" placeholder="" name="id" style="border: 1px solid;">
                        <div class="col-md-12 form-group">
                            <label>Nom</label>
                            <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" value="{{ adresseclient($commande->adresse_client_id)->nom}}" type="text" placeholder="" name="nom" >
                            {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Prénom</label>
                            <input class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" value="{{ adresseclient($commande->adresse_client_id)->prenom }}" type="text" placeholder="" name="prenom">
                            {!! $errors->first('prenom', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label>E-mail</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" style=" height: 50px; border: 1px solid;" value="{{  adresseclient($commande->adresse_client_id)->email }}" type="text" placeholder="" name="email">
                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Téléphone</label>
                            <input id="phone1" type="tel"  class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" style=" height: 50px; border: 1px solid;" value="{{ adresseclient($commande->adresse_client_id)->telephone }}"  placeholder="" name="telephone">
                            {!! $errors->first('telephone', '<p class="text-danger">:message</p>') !!}
                        <div class="alert alert-info" style="display: none;"></div>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Pays</label>
                            <select class="custom-select {{ $errors->has('pays') ? 'is-invalid' : '' }}" name="pays" style="height: 50px; border: 1px solid;">
                                <option  value="{{ adresseclient($commande->adresse_client_id)->pays ?? '' }} ">{{ adresseclient($commande->adresse_client_id)->pays ?? ''}}</option>
                                @foreach(pays() as $item)
                                    <option value="{{ $item->nom }}">{{ $item->nom }}</option>

                                @endforeach

                            </select>
                            {!! $errors->first('pays', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="col-md-12 form-group">
                            <label>Rue</label>
                            <input class="form-control {{ $errors->has('rue') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" value="{{ adresseclient($commande->adresse_client_id)->rue}}" type="text" placeholder="" name="rue">
                            {!! $errors->first('rue', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="col-md-12 form-group">
                            <label>Ville</label>
                            <input class="form-control {{ $errors->has('ville') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" value="{{ adresseclient($commande->adresse_client_id)->ville }}" type="text" placeholder="" name="ville">
                            {!! $errors->first('ville', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="col-md-12 form-group">
                            <label>Code postal</label>
                            <input class="form-control {{ $errors->has('code_postal') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" value="{{ adresseclient($commande->adresse_client_id)->code_postal }}" type="text" placeholder="" name="code_postal" >
                            {!! $errors->first('code_postal', '<p class="text-danger">:message</p>') !!}

                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="display:block; padding:0px; border-top: 0px;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-right: 50px; float:left; margin-right: 30px; border-top: 0px;">Annuler</button>
                    <button type="submit" class="btn btn-secondary" style="float:right;">Modifier</button>

                </div>
            </form>
       </div>
    </div>
</div>

{{-- adresse livraison --}}
    <div class="modal fade" id="ModalEditAdresseLivraison" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalEditAdresseLivraisonTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"> Modification Adresse de Livraison</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_site_public_edit_adresse_livraison') }}" id="" method="POST">
                <div class="modal-body p-0" style="background-color: #ffff;" >
                    @csrf
                    <div class="">
                        <input class="form-control" value="{{ adresselivraison($commande->adresse_livraison_id)->id}}" type="hidden" placeholder="" name="id" >

                        <div class="col-md-12 form-group">
                            <label>Nom</label>
                            <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" value="{{ adresselivraison($commande->adresse_livraison_id)->nom  }}" type="text" placeholder="" name="nom" >
                            {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="col-md-12 form-group">
                            <label>Prénom</label>
                            <input class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" value="{{ adresselivraison($commande->adresse_livraison_id)->prenom}}" type="text" placeholder="" name="prenom">
                            {!! $errors->first('prenom', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="col-md-12 form-group">
                            <label>E-mail</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"style="height: 50px; border: 1px solid;"  value="{{  adresselivraison($commande->adresse_livraison_id)->email }}" type="text" placeholder="" name="email">
                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="col-md-12 form-group">
                            <label>Téléphone</label>
                            <input id="phone1" type="tel"  class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" value="{{ adresselivraison($commande->adresse_livraison_id)->telephone }}"  placeholder="" name="telephone">
                            {!! $errors->first('telephone', '<p class="text-danger">:message</p>') !!}

                        <div class="alert alert-info" style="display: none;"></div>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Pays</label>
                            <select class="custom-select {{ $errors->has('pays') ? 'is-invalid' : '' }}" name="pays" style="height: 50px; border: 1px solid;" >
                                <option value="{{ adresselivraison($commande->adresse_livraison_id)->pays ?? '' }} ">{{ adresselivraison($commande->adresse_livraison_id)->pays ?? ''}}</option>
                                @foreach(pays() as $item)
                                    <option value="{{ $item->nom }}">{{ $item->nom }}</option>

                                @endforeach

                            </select>
                            {!! $errors->first('pays', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Rue</label>
                            <input class="form-control {{ $errors->has('rue') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" value="{{ adresselivraison($commande->adresse_livraison_id)->rue }}" type="text" placeholder="" name="rue">
                            {!! $errors->first('rue', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="col-md-12 form-group">
                            <label>Ville</label>
                            <input class="form-control {{ $errors->has('ville') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" value="{{ adresselivraison($commande->adresse_livraison_id)->ville }}" type="text" placeholder="" name="ville">
                            {!! $errors->first('ville', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="col-md-12 form-group">
                            <label>Code postal</label>
                            <input class="form-control {{ $errors->has('code_postal') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" value="{{ adresselivraison($commande->adresse_livraison_id)->code_postal }}" type="text" placeholder="" name="code_postal" >
                            {!! $errors->first('code_postal', '<p class="text-danger">:message</p>') !!}

                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="display:block; padding:0px; border-top: 0px;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-right: 50px; float:left; margin-right: 300px;">Annuler</button>
                    <button type="submit" class="btn btn-secondary" style="float:right">Modifier</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection

@section('js')
<script amount="{{ montant_ttc(montant_apres_reduction($sub_total), $commande->adresse_livraison_id) }}" callback="http://127.0.0.1:8000/validation-commmande/{{ $commande->id }}/commande-reçue/type-paiement-{{ $type_paiement }}" data="" url="https://technodatasolutions.bj/img/logo.png" position="center" theme="#0095ff" sandbox="true" key="08785180ecc811ec848227abfc492dc7" src="https://cdn.kkiapay.me/k.js"></script>

<script>
    $(document).on('click', '#btn_edit_adr_fact', function(){
        $('#ModalEditAdresseFacturation').modal('show');
    });

    // adresse livraison

    $(document).on('click', '#btn_edit_adr_livr', function(){
        $('#ModalEditAdresseLivraison').modal('show');
    });

</script>
<script>
    paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: function(data, actions) => {
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
            // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            // const transaction = orderData.purchase_units[0].payments.captures[0];
            // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);

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

