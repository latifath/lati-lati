@extends('layouts.master-dashboard')

@section('detail-client')
    @include('layouts.partials-dashboard.entête-page', [
        'infos1' => 'Client #' . $client->id,
        'infos2' => 'Clients',
        'infos3' => 'Détails client',
    ])
    <div class="row mt-5">
        <div class="col-md-12 col-sm-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <p class="text-center" style="font-size: 24px;"><strong>Historique de Mr/Mme {{ $client->name }}
                        </strong></p>

                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <strong>Nom</strong>
                        </div>
                        <div class="col-sm-6">{{ $client->name }}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <strong>E-mail</strong>
                        </div>
                        <div class="col-sm-6">{{ $client->email }}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <strong>Date</strong>
                        </div>
                        <div class="col-sm-6">{{ $client->created_at }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-header bg-success">
                    <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Commande effectuée
                    </h4>
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Commande N°</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th style="width: 15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commandes as $key => $commande)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $commande->id }}</td>
                                    <td>{{ $commande->created_at }}</td>
                                    <td>{{ $commande->status }}</td>
                                    <td>
                                        <button id="btn_show_commande" class="btn btn-primary" data-id="{{ $commande->id }}"
                                            data-date="{{ $commande->created_at }}" data-statut="{{ $commande->status }}"
                                            data-nom="{{ $commande->adresse_client->nom . ' ' . adresseclient($commande->adresse_client_id)->prenom }}"
                                            data-email="{{ adresseclient($commande->adresse_client_id)->email }}"
                                            data-tel="{{ adresseclient($commande->adresse_client_id)->telephone }}"
                                            data-ville_pays="{{ adresseclient($commande->adresse_client_id)->ville . ' ' . adresseclient($commande->adresse_client_id)->pays }}"
                                            data-code_postal="{{ adresseclient($commande->adresse_client_id)->code_postal }}"><i
                                                class="fa fa-eye"></i> Voir </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade" id="ShowModalCommande" tabindex="-1" aria-labelledby="ShowModalCommandeLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Commande #<span id="id_com"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <td>Date</td>
                                <td><span id='date_com'></span></td>
                            </tr>
                            <tr>
                                <td>status</td>
                                <td><span id='status_com'></span></td>
                            </tr>
                            <tr>
                                <td>Nom & prénom</td>
                                <td><span id='nom_prenom'></span></td>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <td><span id='email'><span></td>
                            </tr>
                            <tr>
                                <td>Téléphone</td>
                                <td><span id='tel'></span></td>
                            </tr>
                            <tr>
                                <td>Ville & Pays</td>
                                <td><span id='ville_pays'></span></td>
                            </tr>
                            <tr>
                                <td>Code postal</td>
                                <td><span id='code_postal'></span></td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).on('click', '#btn_show_commande', function() {

            var ID = $(this).attr('data-id');
            var date = $(this).attr('data-date');
            var statut = $(this).attr('data-statut');
            var nom = $(this).attr('data-nom');
            var email = $(this).attr('data-email');
            var tel = $(this).attr('data-tel');
            var ville_pays = $(this).attr('data-ville_pays');
            var code_postal = $(this).attr('data-code_postal');

            $('#id_com').html(ID);
            $('#date_com').html(date);
            $('#status_com').html(statut);
            $('#nom_prenom').html(nom);
            $('#email').html(email);
            $('#tel').html(tel);
            $('#ville_pays').html(ville_pays);
            $('#code_postal').html(code_postal);

            $('#ShowModalCommande').modal('show');
        });
    </script>
@endsection
