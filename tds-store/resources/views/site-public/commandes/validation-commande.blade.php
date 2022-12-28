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
        fieldset{
            border-color: #212529!important;
        }

        .select2-selection--single{
            height: 50px !important;
            border: 1px solid #EDF1FF !important;
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
                            <fieldset class="border p-3" style="border-color: #212529!important;">
                                <legend class="float-none w-auto p-2">
                                    Adresse de facturation
                                </legend>
                                 <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Nom</label>
                                        <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->nom : (old('nom') ?? '' ) }}" type="text" placeholder="" name="nom" >
                                        {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}

                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Prénom</label>
                                        <input class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->prenom : (old('prenom') ?? '' )  }}" type="text" placeholder="" name="prenom">
                                        {!! $errors->first('prenom', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>E-mail</label>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->email : (old('email') ?? '' )  }}" type="text" placeholder="" name="email">
                                        {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Téléphone</label>
                                        <input id="phone1" type="tel"  class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->telephone : (old('telephone') ?? '' )  }}"  placeholder="" name="telephone">
                                        {!! $errors->first('telephone', '<p class="text-danger">:message</p>') !!}

                                       <div class="alert alert-info" style="display: none;"></div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Pays</label>
                                        <select class="custom-select {{ $errors->has('pays') ? 'is-invalid' : '' }}" style="height: 50px;" name="pays">
                                            <option style="{{ couleur_background_1() }}" value="{{ information_client() ? information_client()->pays  : (old('pays') ?? '') }}">{{ information_client() ? information_client()->pays  : (old('pays') ?? 'Choisissez le pays') }}</option>
                                            @foreach(countries() as $country)
                                                <option value="{{ $country->name}}">{{ $country->name}}</option>

                                            @endforeach

                                        </select>
                                        {!! $errors->first('pays', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Rue</label>
                                        <input class="form-control {{ $errors->has('rue') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->rue : (old('rue') ?? '' )  }}" type="text" placeholder="" name="rue">
                                        {!! $errors->first('rue', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Ville</label>
                                        <input class="form-control {{ $errors->has('ville') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->ville : (old('ville') ?? '' )  }}" type="text" placeholder="" name="ville">
                                        {!! $errors->first('ville', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                     <div class="col-md-6 form-group">
                                        <label>Code postal</label>
                                        <input class="form-control {{ $errors->has('code_postal') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->code_postal : (old('code_postal') ?? '' ) }}" type="text" placeholder="" name="code_postal" >
                                        {!! $errors->first('code_postal', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="border p-2 mt-5" style="border-color: #212529!important;">
                                <legend class="float-none w-auto p-2">
                                    Adresse de livraison
                                </legend>
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="form-check">
                                        <label class="form-check-label check-form-livraison" >
                                            <input type="checkbox" class="form-check-input" value="1" onchange="valueChanged()" name="check" {{ old('check') == '1' ? 'checked' : '' }}>Adresse de livraison différente de l'adresse de facturation
                                        </label>
                                    </div>
                                </div>
                                <div class="row form-livraison" style="display: none">
                                    <div class="col-md-6 form-group">
                                        <label>Nom</label>
                                        <input class="form-control {{ $errors->has('nomLivraison') ? 'is-invalid' : '' }}" style="height: 50px;"  type="text" placeholder="" value="{{ old('nomLivraison') ?? '' }}" name="nomLivraison" >
                                        {!! $errors->first('nomLivraison', '<p class="text-danger">:message</p>') !!}
                                   </div>

                                    <div class="col-md-6 form-group">
                                        <label>Prénom</label>
                                        <input class="form-control {{ $errors->has('prenomLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" value="{{ old('prenomLivraison') ?? '' }}" name="prenomLivraison">
                                        {!! $errors->first('prenomLivraison', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>E-mail</label>
                                        <input class="form-control {{ $errors->has('emailLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" value="{{ old('emailLivraison') ?? '' }}" name="emailLivraison">
                                        {!! $errors->first('emailLivraison', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Téléphone</label>
                                        <input id="phone2" type="tel" class="form-control {{ $errors->has('telephoneLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" placeholder="" value="{{ old('telephoneLivraison') ?? '' }}" name="telephoneLivraison">
                                        {!! $errors->first('telephoneLivraison', '<p class="text-danger">:message</p>') !!}
                                        <div class="alert alert-info" style="display: none;"></div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Pays</label>
                                        <select class="custom-select {{ $errors->has('paysLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" name="paysLivraison">
                                            <option  value="{{ old('paysLivraison') ?? '' }}">{{ old('paysLivraison') ?? 'Choisissez le pays' }}</option>
                                            @foreach(countries() as $country)
                                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('paysLivraison', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Rue</label>
                                        <input class="form-control {{ $errors->has('rueLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" value="{{ old('rueLivraison') ?? '' }}" name="rueLivraison">
                                        {!! $errors->first('rueLivraison', '<p class="text-danger">:message</p>') !!}
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Ville</label>
                                        <select class="custom-select {{ $errors->has('villeLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" name="villeLivraison" id="ville">
                                            <option  value="{{ old('villeLivraison') ?? '' }}">{{ old('villeLivraison') ?? 'Choisissez la ville' }}</option>
                                            @foreach(villes() as $ville)
                                                <option value="{{ $ville->ville }}">{{ $ville->ville }}</option>
                                            @endforeach
                                            <option value="autres">Autres</option>
                                        </select>
                                        {!! $errors->first('villeLivraison', '<p class="text-danger">:message</p>') !!}
                                        <br>
                                        <div class="form-group ville2" style="display: none">
                                            <label>Entrez votre ville</label>
                                            <input class="form-control {{ $errors->has('villeLivraison2') ? 'is-invalid' : '' }}" type="text" style="height: 50px;" name="villeLivraison2">
                                            {!! $errors->first('villeLivraison2', '<p class="text-danger">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Code postal</label>
                                        <input class="form-control {{ $errors->has('code_postalLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" value="{{ old('code_postalLivraison') ?? '' }}" name="code_postalLivraison" >
                                        {!! $errors->first('code_postalLivraison', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                </div>
                            </fieldset>
                        </div>
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
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <p>Expédition</p>
                                            <p>À déterminer</p>
                                        </div>

                                        <div class="card-footer border-secondary bg-transparent" style="padding: 0px">
                                            <div class="d-flex justify-content-between mt-2">
                                                @if(!request()->session()->has('coupon'))
                                                <h5 class="font-weight-medium " style="{{ couleur_text_2() }}">Montant TTC</h5>
                                                <h5 class="font-weight-medium" style="{{ couleur_text_2() }}">{{  number_format($sub_total,  0, '.', ' ' ) }} F CFA</h5>
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
                                            <input type="radio" class="custom-control-input {{ $errors->has('payment') ? 'is-invalid' : '' }}" value="card" {{ old('payment') == 'card' ? 'checked' : '' }} name="payment" id="cart">
                                            <label class="custom-control-label" for="cart">Carte Bancaire</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input {{ $errors->has('payment') ? 'is-invalid' : '' }}" value="momo" {{ old('payment') == 'momo' ? 'checked' : '' }} name="payment" id="mobile">
                                            <label class="custom-control-label" for="mobile">Mobile Money</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input {{ $errors->has('payment') ? 'is-invalid' : '' }}" value="paypal" {{ old('payment') == 'paypal' ? 'checked' : '' }} name="payment" id="paypal">
                                            <label class="custom-control-label" for="paypal">PayPal</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input {{ $errors->has('payment') ? 'is-invalid' : '' }}" value="livraison" {{ old('payment') == 'livraison' ? 'checked' : '' }} name="payment" id="livraison">
                                            <label class="custom-control-label" for="livraison">Paiement à la livraison</label>
                                        </div>
                                    </div>
                                    {!! $errors->first('payment', '<p class="text-danger">:message</p>') !!}
                                </div>
                                <div class="card-footer border-secondary bg-transparent">
                                    <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Passer la commande</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
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
<script>
    $(document).ready(function(){
        $("select#ville").change(function(){
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

    function getIp(callback) {
        fetch('https://ipinfo.io/json?token=9299d29dc5c97f', { headers: { 'Accept': 'application/json' }})
        .then((resp) => resp.json())
        .catch(() => {
            return {
            country: 'bj',
            };
        })
        .then((resp) => callback(resp.country));
        }
        const phoneInputField1 = document.querySelector("#phone1");
        const phoneInputField2 = document.querySelector("#phone2");

    const phoneInput1 = window.intlTelInput(phoneInputField1, {
        initialCountry: "auto",
        geoIpLookup: getIp,
        preferredCountries: ["ci", "gh", "tg", "fr", "bj"],
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

