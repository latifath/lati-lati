@extends('layouts.master-dashboard')
@section('categorie')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Partenaires',
    'infos2' => 'Partenaire',
    'infos3' => 'Tous les partenaires',
])
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white d-inline-block" style="font-size: 24px;">Tous les partenaires</h4>
                <button id="btn_ajout_partenaire" class="float-right btn d-inline-block text-white border" {{ couleur_background_1() }}><i class="fa fa-plus" aria-hidden="true">Ajouter un partenaire</i></button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Logo</th>
                            <th>Numéro d'ordre</th>
                            <th>Date</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                        </thead>
                        <tbody id="datatablepartenaires">
                            @foreach ($partenaires as $partenaire)

                            <tr class="row1" data-id="{{ $partenaire->id }}">
                                <td>
                                    <div style="color:rgb(124,77,255); padding-left: 10px; float: left; font-size: 20px; cursor: pointer;">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <i class="fa fa-ellipsis-v"></i>
                                    </div>
                                </td>
                                <td>{{ $partenaire->nom }}</td>
                                <td>
                                    <img src="{{ asset(path_image_partenaire() . path_image($partenaire->image_id)->filename )}}" class="figure-img img-fluid rounded" alt="" height="40" width="50">
                                </td>
                                <td>{{ $partenaire->number_order }}</td>
                                <td>{{ $partenaire->created_at }}</td>
                                <td>
                                    <button  id="btn_edit_partenaire" data-id="{{ $partenaire->id }}" data-nom = "{{ $partenaire->nom }}" data-ordre="{{ $partenaire->number_order }}" class="btn btn-primary"><i class="fa fa-edit"></i> Editer</button>
                                    <button  id="btn_edit_image_partenaire" data-id="{{ $partenaire->id }}" class="btn btn-info"><i class="fa fa-image"></i> Upload</button>
                                    <button  id="btn_delete_partenaire" data-id="{{ $partenaire->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i> Supprimer</button>
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

@include('espace-admin.partenaires._modal')
{{-- supprimer --}}
@include('layouts.modal', ["route" => route('root_espace_admin_partenaire_delete', 0), 'nom'=>'cet paretenaire'])

@endsection

@section('js')
<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>

<script>
    $(document).on('click', '#btn_edit_partenaire', function(){
        var id = $(this).attr('data-id');
        var nom = $(this).attr('data-nom');
        var ordre = $(this).attr('data-ordre');

        $('#edit_id').val(id);
        $('#edit_nom').val(nom);
        $('#edit_ordre_de_numero').val(ordre);

        $('#ModalModifiePartenaire').modal('show');
    });

    $(document).on('click', '#btn_edit_image_partenaire', function(){
        var id = $(this).attr('data-id');

        $('#edit_image_id').val(id);

        $('#ModalModifieImagePartenaire').modal('show');
    });

    $(document).on('click', '#btn_delete_partenaire', function(){
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

    $(document).on('click', '#btn_ajout_partenaire', function(){

        $('#ModalAjoutPartenaire').modal('show');
    });
</script>
<script type="text/javascript">
    $(function () {
      $( "#datatablepartenaires" ).sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function() {
            sendOrderToServer();
        }
      });

      function sendOrderToServer() {
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');

        $('tr.row1').each(function(index,element) {
            order.unshift({
                id: $(this).attr('data-id'),
                position: index+1
            });
        });

        $.ajax({
          type: "POST",
          dataType: "json",
          url: "{{ route('root_espace_admin_partenaire_update_order') }}",
          data: {
            order:order,
            _token: token
          },

          success: function(response) {
              if (response.status == "success") {
                console.log(response);
              } else {
                console.log(response);
              }
          }
        });

      }
    });

</script>
@endsection

