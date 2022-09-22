@extends('layouts.master-dashboard')
@section('payer-commande')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Paiement',
    'infos2' => 'Paiement',
    'infos3' => 'Payer une commande',
])
<br>
    <div class="row mt-4">
        <div class="col-md-8 offset-md-2">
            <div class="card m-b-30">
                <div class="card-header bg-light">
                <h4 class="mt-2 header-title text-dark" style="font-size: 24px">Payer la commande</h4>
            </div>
                <div class="card-body">
                    <form action="{{ route('root_espace_client_payer_commande') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for=""></label>
                            <input
                                class="form-control {{ $errors->has('commande_id') ? 'is-invalid' : '' }}"
                                style="height: 50px;"
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
                            <input
                                class="form-control {{ $errors->has('reference') ? 'is-invalid' : '' }}"
                                style="height: 50px;" type="hidden" placeholder=""
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
@endsection
