@extends('layouts.master-dashboard')
@section('gestion-client')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Clients',
    'infos2' => 'Clients',
    'infos3' => 'Tous les clients',
])
<br>
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Clients</h4>
            </div>

            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th>Date</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($utilisateurs as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a href="{{ route('root_espace_admin_clients_show', $user->id )}}">
                                    <button data-toggle="tooltip" title="Voir" class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                </a>

                                <a href="#">
                                    <button class="btn" data-toggle="tooltip" title="Bloquer l'accès" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-lock" aria-hidden="true"></i></button>
                                </a>

                                <button data-toggle="tooltip" title="Supprimer" id="btn_delete"  data-id="{{ $user->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@include('layouts.modal', ["route" => route('root_delete_clients', 0), 'nom'=>'cet client'])

@endsection

@section('js')
    <script>
        $(document).on('click', '#btn_delete', function(){
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });
    </script>
@endsection
