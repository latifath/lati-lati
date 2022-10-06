@extends('layouts.master-dashboard')
@section('paiement')

@include('layouts.partials-dashboard.entête-page', [
'infos1' => 'Paiements',
'infos2' => 'Paiements',
'infos3' => 'Tous les paiements',
])
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Paiements</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Date</th>
                                <th>Reference</th>
                                <th>Type de paiement</th>
                                <th>Montant</th>
                                <th>Identifiant commande</th>
                                <th style="width: 15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $t= 1;
                            @endphp
                            @foreach($paiements as $paiement)

                            <tr>
                                <td>{{ $t}}</td>
                                <td>{{ $paiement->created_at }}</td>
                                <td>{{ $paiement->reference }}</td>
                                <td>{{ $paiement->type_paiement }}</td>
                                <td>{{ number_format($paiement->montant, '0', '.', ' ')}} F CFA</td>
                                <td>{{ $paiement->commande_id }}</td>
                                <td>
                                    <button data-toggle="tooltip" title="Voir" id="btn_details_commande" class="btn" style="background-color: #007bff; border: #007bff; color: white;" data-id="{{ commande($paiement->commande_id)->id}}" data-date="{{ commande($paiement->commande_id)->created_at}}" data-statut="{{ commande($paiement->commande_id)->status }}"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                    <button data-toggle="tooltip" title="Editer" id="btn_edit_paiement" data-id="{{ $paiement->id }}" data-montant="{{ $paiement->montant }}" data-date="{{ $paiement->created_at }}" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                    <button data-toggle="tooltip" title="Supprimer" id="btn_delete_paiement" data-id="{{ $paiement->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i></button>

                                </td>
                                @php
                                $t++;
                                @endphp
                                @endforeach
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DetailsModalCommande" tabindex="-1" aria-labelledby="DetailsModalCommandeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Détails commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td><span id='id_com'></span></td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td><span id='date_com'></span></td>
                        </tr>
                        <tr>
                            <td>status</td>
                            <td><span id='statut'></span></td>
                        </tr>

                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="{{ couleur_background_1() }}; {{ couleur_blanche() }}" data-dismiss="modal">Fermé</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalModifiePaiement" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifiePaiement aria-hidden=" true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification paiement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_edit_paiement')}}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body" style="background-color:  #cdc3b8;">
                    <div class="">
                        <input id="edit_id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" type="hidden" placeholder="" name="id">
                        <div class="form-group">
                            <label for="">Montant</label>
                            <input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="montant" id="edit_montant">
                            {!! $errors->first('montant', '<p class="text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label for="">Date</label>
                            <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="date" id="edit_date">
                            {!! $errors->first('date', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            <label for="">Type_paiement</label>
                            <select class="custom-select {{ $errors->has('type_paiement') ? 'is-invalid' : '' }}" style="height: 50px;" name="type_paiement" id="">
                                <option value="">Choisir le type de paiement</option>
                                <option value="momo">MoMo</option>
                                <option value="carte_bancaire">Carte Bancaire</option>
                                <option value="paypal">PayPal</option>
                            </select>
                            {!! $errors->first('type_paiement', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="form-group">
                            <label for="">Id commande</label>
                            <select class="custom-select {{ $errors->has('commande_id') ? 'is-invalid' : '' }}" style="height: 50px;" name="commande_id" id="edit_cmde_id">
                                <option value="">Choisir une commande</option>
                                @foreach ($cmdes as $cmde)
                                @if (exist_commande_paiement($cmde->id) != null)
                                <option value="{{ $cmde->id }}">#{{ $cmde->id }}</option>
                                @endif
                                @endforeach
                            </select>
                            {!! $errors->first('commande_id', '<p class="text-danger">:message</p>') !!}

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="button" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn" style="{{ couleur_background_1() }}; {{ couleur_blanche() }}">Modifier</button>

                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.modal', ["route" => route('root_espace_admin_delete_paiement', 0), 'nom'=>'cet paiement'])

@endsection

@section('js')
<script>
    $(document).on('click', '#btn_details_commande', function() {

        var ID = $(this).attr('data-id');
        var date = $(this).attr('data-date');
        var statut = $(this).attr('data-statut');

        $('#id_com').html(ID);
        $('#date_com').html(date);
        $('#statut').html(statut);

        $('#DetailsModalCommande').modal('show');
    });

    $(document).on('click', '#btn_edit_paiement', function() {
        var ID = $(this).attr('data-id');
        var montant = $(this).attr('data-montant');
        var date = $(this).attr('data-date');
        var type_paiement = $(this).attr('data-type_paiement');
        var commande_id = $(this).attr('data-commande_id')

        $('#edit_id').val(ID);
        $('#edit_montant').val(montant);
        $('#edit_date').val(date);
        $('#edit_type').val(type_paiement);
        $('#edit_commande_id').val(commande_id);



        $('#ModalModifiePaiement').modal('show');
    });

    $(document).on('click', '#btn_delete_paiement', function() {
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

</script>
@endsection
