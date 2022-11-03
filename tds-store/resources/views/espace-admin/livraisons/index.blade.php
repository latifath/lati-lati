@extends('layouts.master-dashboard')
@section('livraison')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Livraisons',
    'infos2' => 'Livraisons',
    'infos3' => 'Info livraisons',
])
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Livraisons</h4>
            </div>

            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>Numéro de <br>commande</th>
                        <th>Expéditeur</th>
                        <th>Destinataire</th>
                        <th>Téléphone <br>Destinataire</th>
                        <th>Adresse</th>
                        <th>Code<br> Postal</th>
                        <th>Ville</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($livraisons as $livraison)
                        <tr>
                            <td>{{ $livraison->id }}</td>
                            <td>{{ $livraison->adresse_client->prenom }} <br> {{ $livraison->adresse_client->nom }}</td>
                            <td>{{ $livraison->adresse_livraison->prenom }} <br> {{ $livraison->adresse_livraison->nom }}</td>
                            <td>{{ $livraison->adresse_livraison->telephone }}</td>
                            <td>{{ $livraison->adresse_livraison->rue }}</td>
                            <td>{{ $livraison->adresse_livraison->code_postal }}</td>
                            <td>{{ $livraison->adresse_livraison->ville }}</td>
                            <td>{{ $livraison->status }}</td>
                            <td>{{ $livraison->created_at }}</td>
                            <td>
                            <a href="">
                                <button data-toggle="tooltip" title="Livrer" class="btn btn-primary"><i class="fa fa-refresh"></i></i></button>
                            </a>
                            <a href="">
                                <button data-toggle="tooltip" title="Supprimer" class="btn bg-danger text-white"><i class="fa fa-trash"></i></i></button>
                            </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
