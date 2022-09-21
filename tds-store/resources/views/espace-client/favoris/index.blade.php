@extends('layouts.master-dashboard')

@section('client-favoris')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Favoris',
    'infos2' => 'Favoris',
    'infos3' => 'Tous les favoris',
])
<br>
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Favoris</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>Identifiant produit</th>
                        <th style="width: 20%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($favoris as $favori)
                        <tr>
                            <td>{{ $favori->produit_id }}</td>
                            <td>
                                <button data-toggle="tooltip" data-id={{ $favori->id }} title="Supprimer" id="btn_delete_favoris"  class="btn text-white" style="{{ couleur_background_2() }}"><i class="fa fa-trash" aria-hidden="true"></i>Supprimer</button>
                           </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

 @include('layouts.modal', ["route" => route('root_site_public_favoris_delete', 0), 'nom'=>'cet favoris'])

@endsection

@section('js')
<script>
    $(document).on('click', '#btn_edit_user', function(){
        var ID = $(this).attr('data-id');

        $('#id').val(ID);

        $('#ModalEditUser').modal('show');
    });

    $(document).on('click', '#btn_delete_favoris', function(){
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

</script>
@endsection
