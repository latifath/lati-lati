
@extends('layouts.master-dashboard')
@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
<style>
    .select2-selection--single{
            height: 50px !important;
            border: 1px solid #ced4da !important;
        }
</style>
@endsection

@section('compte')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Profil',
    'infos2' => 'Tableau de bord',
    'infos3' => 'Compte',
])
<br>
<div class="row">
    <div class="col-md-12 ">
        <div class="card m-b-30">
            <div class="card-header bg-light">
                <h4 class="mt-2 header-title text-dark" style="font-size: 24px">Information Client</h4>
            </div>
            <div class="card-body">
                <form method="POST" action={{ information_client() ? route('root_espace_client_update_information_client')  : route('root_espace_client_create_information_client') }}>
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Nom</label>
                            <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->nom  : '' }}" type="text" placeholder="" name="nom" >
                            {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Prénom</label>
                            <input class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->prenom  : '' }}" type="text" placeholder="" name="prenom">
                            {!! $errors->first('prenom', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class=" col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->email  : '' }}" type="text" placeholder="" name="email">
                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Téléphone</label>
                            <input id="phone1" type="tel"  class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->telephone  : '' }}"  placeholder="" name="telephone">
                            {!! $errors->first('telephone', '<p class="text-danger">:message</p>') !!}
                            <div class="alert alert-info" style="display: none;"></div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Pays</label>
                            <select class="custom-select is-invalid {{ $errors->has('pays') ? 'is-invalid' : '' }}" style="height: 50px;" name="pays">
                                <option value="{{ information_client() ? information_client()->pays  : '' }}">{{ information_client() ? information_client()->pays  : 'Choisissez le pays' }}</option>
                                @foreach(pays() as $item)
                                    <option value="{{ $item->nom }}">{{ $item->nom }}</option>
                               @endforeach
                            </select>
                            {!! $errors->first('pays', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Rue</label>
                            <input class="form-control {{ $errors->has('rue') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->rue  : '' }}" type="text" placeholder="Numero de la voie et nom de la rue" name="rue">
                            {!! $errors->first('rue', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Ville</label>
                            <input class="form-control {{ $errors->has('ville') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->ville  : '' }}" type="text" placeholder="" name="ville">
                            {!! $errors->first('ville', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Code postal</label>
                            <input class="form-control {{ $errors->has('code_postal') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->code_postal  : '' }}" type="text" placeholder="123" name="code_postal" >
                            {!! $errors->first('code_postal', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="col-md-6 form-group">
                            <label>Nom d'entreprise</label>
                            <input class="form-control {{ $errors->has('nom_entreprise') ? 'is-invalid' : '' }}" style="height: 50px;" value="{{ information_client() ? information_client()->nom_entreprise  : '' }}" type="text" placeholder="" name="nom_entreprise" >
                            {!! $errors->first('nom_entreprise', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="">
                        <button class="btn btn-primary font-weight-bold my-3 py-3 float-right" type="submit">{{ information_client() ? 'Modifier'  : 'Ajouter' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script>
    $( 'select' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
    } );
</script>
@endsection
