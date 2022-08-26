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
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Toutes les adresses livraison</h4>
            </div>

            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>E-mail</th>
                        <th>Téléphone</th>
                        <th>Pays</th>
                        <th>Ville</th>
                        <th>Rue</th>
                        <th>Code postal</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($livraisons as $livraison)
                        <tr>
                            <td>{{ $livraison->id }}</td>
                            <td>{{ $livraison->nom }}</td>
                            <td>{{ $livraison->prenom }}</td>
                            <td>{{ $livraison->email }}</td>
                            <td>{{ $livraison->telephone }}</td>
                            <td>{{ $livraison->pays }}</td>
                            <td>{{ $livraison->ville }}</td>
                            <td>{{ $livraison->rue }}</td>
                            <td>{{ $livraison->code_postal }}</td>
                            <td>{{ $livraison->created_at }}</td>
                            <td>
                            <a href="">
                                <button data-toggle="tooltip" title="Voir" class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-eye"></i></i></button>
                            </a>
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
