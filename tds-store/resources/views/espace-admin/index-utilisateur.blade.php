@extends('layouts.master-dashboard')

@section('index-utilisateur')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Utilisateurs',
    'infos2' => 'Utilisateurs',
    'infos3' => 'Tous les utilisateurs',
])
<br>
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
            <div class="card-header bg-success">
                <h4 class="mt-0 header-title text-white" style="font-size: 24px; text-align: center;">Utilisateurs</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th>Rôle</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->role}}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                               @if(auth()->user()->id == $user->id)

                                @else
                                    <button data-toggle="tooltip" title="Editer" id='btn_edit_user' data-id="{{ $user->id }}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></button>

                                    <button data-toggle="tooltip" title="Supprimer" id="btn_delete_user" data-id="{{ $user->id }}" class="btn text-white" style="{{ couleur_background_2() }}"><i class="fa fa-trash" aria-hidden="true"></i></button>

                                @endif
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

<div class="modal fade" id="ModalEditUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalEditUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification des informations utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_edit_utilisateur') }}"  method="POST">
                @csrf
                @method('put')
                <div class="modal-body" style="background-color: #f0f0f0;">
                    <div class="">
                        <input  class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}"  type="hidden" id="id" placeholder="" name="id" >
                        <div class="col-md-12 form-group">
                            <select class="custom-select {{ $errors->has('role') ? 'is-invalid' : '' }}" style="height: 50px;" name="role" >
                                <option>Choisir un Role</option>
                                <option value="client">Client</option>
                                <option value="admin"> Admin</option>
                            </select>
                            {!! $errors->first('role', '<p class="text-danger">:message</p>') !!}
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

@include('layouts.modal', ["route" => route('root_espace_admin_delete_utilisateur', 0), 'nom'=>'cet utilisateur'])


@endsection

@section('js')
<script>
    $(document).on('click', '#btn_edit_user', function(){
        var ID = $(this).attr('data-id');

        $('#id').val(ID);

        $('#ModalEditUser').modal('show');
    });

    $(document).on('click', '#btn_delete_user', function(){
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

</script>
@endsection
