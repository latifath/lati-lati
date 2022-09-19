@extends('layouts.master')
@section('head')
<link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />

    <style>
        .iti{
            display : block !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection
@section('verifier')
    <!-- Page Header Start -->
    <div class="container-fluid mb-5" style='{{ couleur_background_1() }}'>
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
            <div class="d-inline-flex">
                <p class="m-0"><a href="/"><i class="fa fa-home" style="{{ couleur_blanche() }}"></i></a></p>
                <p class="m-0 px-2" style="{{ couleur_blanche() }}">/</p>
                <p class="m-0" style="{{ couleur_blanche() }}">Validation commande</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <form action={{ route('root_site_public_validation') }} method="POST">
            @csrf
            <div class="row px-xl-5">
                @include('layouts.partials.sidebar')
                <div class="col-lg-9">
                    <div class="row">
                        <div class="mb-4 col-12">
                            <fieldset class="border p-2 mr-auto ml-2" style="border-color: #212529!important;">
                                <legend>
                                    <h4 class="font-weight-semi-bold mb-4">Adresse de facturation</h4>
                                </legend>
                                 <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Nom</label>
                                        <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->nom : (old('nom') ?? '' ) }}" type="text" placeholder="" name="nom" >
                                        {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}

                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Prénom</label>
                                        <input class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->prenom : '' }}" type="text" placeholder="" name="prenom">
                                        {!! $errors->first('prenom', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>E-mail</label>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->email : '' }}" type="text" placeholder="" name="email">
                                        {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Téléphone</label>
                                        <input id="phone1" type="tel"  class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->telephone : '' }}"  placeholder="" name="telephone">
                                        {!! $errors->first('telephone', '<p class="text-danger">:message</p>') !!}

                                       <div class="alert alert-info" style="display: none;"></div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Pays</label>
                                        <select class="custom-select {{ $errors->has('pays') ? 'is-invalid' : '' }}" style="height: 50px;" name="pays">
                                            <option style="{{ couleur_background_1() }}" value="{{ information_client() ? information_client()->pays  : '' }}">{{ information_client() ? information_client()->pays  : 'Choisissez le pays' }}</option>
                                            @foreach(pays() as $item)
                                                <option value="{{ $item->nom }}">{{ $item->nom }}</option>

                                            @endforeach

                                        </select>
                                        {!! $errors->first('pays', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Rue</label>
                                        <input class="form-control {{ $errors->has('rue') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->rue : '' }}" type="text" placeholder="Numero de la voie et nom de la rue" name="rue">
                                        {!! $errors->first('rue', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Ville</label>
                                        <input class="form-control {{ $errors->has('ville') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->ville : '' }}" type="text" placeholder="" name="ville">
                                        {!! $errors->first('ville', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                     <div class="col-md-6 form-group">
                                        <label>Code postal</label>
                                        <input class="form-control {{ $errors->has('code_postal') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->code_postal : '' }}" type="text" placeholder="123" name="code_postal" >
                                        {!! $errors->first('code_postal', '<p class="text-danger">:message</p>') !!}
                                        {{-- isset($adresseclient) ? $adresseclient->code_postal : --}}
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="mb-4 col-12">
                            <fieldset class="border p-2 mr-auto ml-2" style="border-color: #212529!important;">
                                <legend>
                                    <h4 class="font-weight-semi-bold mb-4">Adresse de livraison</h4>
                                </legend>
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="form-check">
                                        <label class="form-check-label check-form-livraison" >
                                            <input type="checkbox" class="form-check-input" value=""  onchange="valueChanged()" name="t" {{ $t == 1 ? 'checked' : '' }}>Adresse de livraison différente de adresse de facturation
                                            {{-- <input type="checkbox" class="form-check-input" value="" name="check" wire:click = change()>Adresse de livraison différente de adresse de facturation --}}
                                        </label>
                                    </div>
                                </div>
                                <div class="row form-livraison">
                                    <div class="col-md-6 form-group">
                                        <label>Nom</label>
                                        <input class="form-control {{ $errors->has('nomLivraison') ? 'is-invalid' : '' }}" style="height: 50px;"  type="text" placeholder="" name="nomLivraison" >
                                        {!! $errors->first('nomLivraison', '<p class="text-danger">:message</p>') !!}

                                   </div>

                                    <div class="col-md-6 form-group">
                                        <label>Prénom</label>
                                        <input class="form-control {{ $errors->has('prenomLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="prenomLivraison">
                                        {!! $errors->first('prenomLivraison', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>E-mail</label>
                                        <input class="form-control {{ $errors->has('emailLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="emailLivraison">
                                        {!! $errors->first('emailLivraison', '<p class="text-danger">:message</p>') !!}
                                    </div>


                                    <div class="col-md-6 form-group">
                                        <label>Téléphone</label>
                                        <input id="phone2" type="tel" class="form-control {{ $errors->has('telephoneLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" placeholder="" name="telephoneLivraison">
                                        {!! $errors->first('telephoneLivraison', '<p class="text-danger">:message</p>') !!}
                                        <div class="alert alert-info" style="display: none;"></div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Pays</label>
                                        <select class="custom-select {{ $errors->has('paysLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" name="paysLivraison">
                                            <option  value="{{ old('paysLivraison') ?? '' }}">{{ old('paysLivraison') ?? 'Choisissez le pays' }}</option>
                                            @foreach(pays() as $item)
                                                <option value="{{ $item->nom }}">{{ $item->nom }}</option>

                                            @endforeach
                                        </select>
                                        {!! $errors->first('paysLivraison', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Rue</label>
                                        <input class="form-control {{ $errors->has('rueLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="Numero de la voie et nom de la rue" name="rueLivraison">
                                        {!! $errors->first('rueLivraison', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Ville</label>
                                        <input  style="border: 1px, solid" class="form-control {{ $errors->has('villeLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="villeLivraison">
                                        {!! $errors->first('villeLivraison', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Code postal</label>
                                        <input class="form-control {{ $errors->has('code_postalLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="123" name="code_postalLivraison" >
                                        {!! $errors->first('code_postalLivraison', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                </div>

                            </fieldset>
                        </div>



                        {{-- @livewire('show-adr-livr-information') --}}

                    </div>
                    {{-- stock insuffisant --}}
                    @if (session()->has('stock'))
                        <ul >
                            @foreach (session("stock") as $key => $item)
                            <li class="text-danger">
                                La quantité du produit {{ $item['name'] }} est insuffisante (- {{ $item['qte'] }}).
                            </li>
                            @endforeach
                        </ul>
                        @if (session("stock") != null)
                            <p class="text-danger">Êtes-vous sûre de vouloir passer la commande? <br> si oui, cela veut dire que le reste des produits vous serez livré dès que le nouveau stock serait disponible.</p>
                        @endif

                    @endif

                    <div class="row">
                        @if(session()->has("panier"))
                             @php
                                $sub_total = 0
                            @endphp

                            <div class="col-md-6">
                                <div class="card border-secondary mb-5">
                                    <div class="card-header bg-secondary border-0">
                                        <h4 class="font-weight-semi-bold m-0">Total de la commande</h4>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="font-weight-medium mb-3">Des produits</h5>
                                        @foreach (session("panier") as $key => $item)

                                            @php $sub_total += $item['price'] * $item['quantity'] @endphp

                                            <div class="d-flex justify-content-between">
                                                <p>{{ $item['name'] }} ( x{{ $item['quantity'], }} )</p>
                                                <p>{{ number_format($item['price'] * $item['quantity'], 0, '.', ' ') }} F CFA</p>
                                            </div>
                                        @endforeach

                                        <div class="d-flex justify-content-between mt-2">
                                            <h5 style="{{ couleur_text_2() }}">sous-total</h5>
                                            <h5 style="{{ couleur_text_2() }}">{{ number_format($sub_total, '0', '.', ' ')}} F CFA</h5>
                                        </div>

                                        <h5 class="font-weight-medium mb-3 mt-2">Autres</h5>

                                        <div class="d-flex justify-content-between">
                                            <p>Remise</p>
                                                <p >{{ valeur_coupon() ?? '0' }}</p>
                                             {{-- <p>TVA</p>
                                            <p>{{ configuration()->tva == 1 ? '18%' : '0%' }}</p> --}}

                                        </div>
                                        <div class="card-footer border-secondary bg-transparent">
                                            <div class="d-flex justify-content-between mt-2">
                                                @if(!request()->session()->has('coupon'))
                                                <h5 class="font-weight-bold" style="{{ couleur_text_2() }}">Montant TTC</h5>
                                                <h5 class="font-weight-bold" style="{{ couleur_text_2() }}">{{  number_format($sub_total,  0, '.', ' ' ) }} F CFA</h5>
                                                </h5>

                                                @else
                                                <h5 class="font-weight-bold" style="{{ couleur_text_2() }}">Montant TTC</h5>
                                                <h5 class="font-weight-bold" style="{{ couleur_text_2() }}">{{ number_format(montant_apres_reduction($sub_total),  0, '.', ' ' )}} F CFA</h5>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <div class="card border-secondary mb-5">
                                <div class="card-header bg-secondary border-0">
                                    <h4 class="font-weight-semi-bold m-0">Paiement</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input {{ $errors->has('payment') ? 'is-invalid' : '' }}" value="carte_bancaire" name="payment" id="cart">
                                            <label class="custom-control-label" for="cart">Carte Bancaire</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input {{ $errors->has('payment') ? 'is-invalid' : '' }}" value="momo" name="payment" id="mobile">
                                            <label class="custom-control-label" for="mobile">Mobile Money</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input {{ $errors->has('payment') ? 'is-invalid' : '' }}" value="paypal" name="payment" id="paypal">
                                            <label class="custom-control-label" for="paypal">PayPal</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input {{ $errors->has('payment') ? 'is-invalid' : '' }}" value="livraison" name="payment" id="livraison">
                                            <label class="custom-control-label" for="livraison">Paiement à la livraison</label>
                                        </div>
                                    </div>
                                    {!! $errors->first('payment', '<p class="text-danger">:message</p>') !!}
                                </div>
                                <div class="card-footer border-secondary bg-transparent">
                                    {{-- <a href="{{ route('root_site_public_validation') }}"></a> --}}
                                    <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Passer la commande</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <!-- Checkout End -->

    {{-- <form action="{{ route('test') }}" method="POST">

        @csrf

        <div class="form-group">
            <label>Latitude</label>
            <input type="text" class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" name="latitude" id="item_lat">
            {!! $errors->first('latitude', '<p class="error">:message</p>') !!}
        </div>

        <button type="reset" class="btn btn-secondary btn-lg waves-effect waves-light">
            Annuler
        </button>
        <button type="submit" class="btn btn-lg pull-right waves-effect waves-light text-white btn-primary" name="valider" >
            Sauvegarder
        </button>

    </form> --}}
@endsection

<script>
    function valueChanged()
    {
        if($('.form-check-input').is(":checked"))
        {
            $(".form-livraison").show();
            setRequired(true)
        }
        else
        {
            $(".form-livraison").hide();
            setRequired(false)
        }
    }

    function setRequired(val){
        var input = document.querySelectorAll('.form-livraison input')
        for(i = 0; i < input.length; i++){
            // input[i].required = val;
        }
    }

    window.onload = function () {
        valueChanged()
    }

</script>
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script>
    $( 'select' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
    } );
</script>

<script>

function getIp(callback) {
 fetch('https://ipinfo.io/json?token=9299d29dc5c97f', { headers: { 'Accept': 'application/json' }})
   .then((resp) => resp.json())
   .catch(() => {
     return {
       country: 'us',
     };
   })
   .then((resp) => callback(resp.country));
}
    const phoneInputField1 = document.querySelector("#phone1");
    const phoneInputField2 = document.querySelector("#phone2");

   const phoneInput1 = window.intlTelInput(phoneInputField1, {
     initialCountry: "auto",
     geoIpLookup: getIp,
     preferredCountries: ["côte-d'ivore", "gha", "togo", "fr"],
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
   });

   const phoneInput2 = window.intlTelInput(phoneInputField2, {
     initialCountry: "auto",
     geoIpLookup: getIp,
     preferredCountries: ["côte-d'ivore", "gha", "togo", "fr"],
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
   });
const info = document.querySelector(".alert-info");

function process(event) {
 event.preventDefault();

 const phoneNumber1 = phoneInput1.getNumber();
 const phoneNumber2 = phoneInput2.getNumber();

 info.style.display = "";
 info.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber1}</strong>`;
 info.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber2}</strong>`;
}
</script>
@endsection

