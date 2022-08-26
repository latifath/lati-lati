@extends('layouts.master-dashboard')
@section('newsletter')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Newsletter',
    'infos2' => 'Newsletter',
    'infos3' => 'Toutes les newsletter',
])
<br>

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white d-inline-block" style="font-size: 24px; text-align: center;;">Liste des abonné(e)s active</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>E-mail</th>
                        <th>Date</th>
                        <th style="width: 16%">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp

                        @foreach($newsletter_act  as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="{{ route('root_espace_admin_bloquer_newsletter', $item->id) }}">
                                    <button  id="btn_edit_newsletter" data-id="{{ $item->id }}" class="btn btn-primary"><i class="fa fa-unlock-alt"> Bloquer</i></button>
                                </a>
                                <button  id="btn_delete_partenaire" data-id="{{ $item->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"> Supprimer</i></button>

                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                         @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Liste des abonné(e)s bloqués</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>E-mail</th>
                        <th>Date</th>
                        <th style="width: 16%">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp

                        @foreach($newsletter_desa  as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="{{ route('root_espace_admin_debloquer_newsletter', $item->id) }}">
                                    <button  id="btn_edit_newsletter" data-id="{{ $item->id }}" class="btn btn-primary"><i class="fa fa-unlock"> Debloquer</i></button>
                                </a>
                                <button id="btn_delete_partenaire" data-id="{{ $item->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"> Supprimer</i></button>

                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                         @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>

@include('layouts.modal', ["route" => route('root_espace_admin_newsletter_delete', 0), 'nom'=>'cette newsletter'])

@endsection

@section('js')
<script>
    $(document).on('click', '#btn_edit_newsletter', function(){
        var ID = $(this).attr('data-id');
        var email = $(this).attr('data-email');

        $('#edit_id').val(ID);
        $('#edit_email').val(email);

        $('#ModalModifie').modal('show');
    });

    $(document).on('click', '#btn_ajout_newsletter', function(){

    $('#ModalAjoutNewsletter').modal('show');
    });

    $(document).on('click', '#btn_delete_partenaire', function(){
            var ID = $(this).attr('data-id');

            $('#item_id').val(ID);

            $('#DeleteModalCenter').modal('show');
        });
</script>
@endsection

