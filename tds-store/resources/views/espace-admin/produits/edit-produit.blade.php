@extends('layouts.master-dashboard')

@section('update-produit')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Produits',
    'infos2' => 'Produits',
    'infos3' => 'Modifier produit',
])
<br>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card m-b-30">
            <div class="card-header bg-light">
                <h4 class="mt-2 header-title text-dark" style="font-size: 24px">Modification produit #{{ $produit->id }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('root_espace_admin_modifie_produit', $produit->id)}}"  method="POST">
                    @csrf

                    @include('espace-admin.produits.form', ['SubmitName' => 'Modifier'])

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
