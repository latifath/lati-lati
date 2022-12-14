@extends('layouts.master-dashboard')
@section('categorie')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Catégories',
    'infos2' => 'Catégories',
    'infos3' => 'Toutes les catégories',
])
<br>
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white d-inline-block " style="font-size: 24px;">Toutes les categories</h4>
                <button id="btn_ajout_categorie" class="float-right btn d-inline-block text-white border" style="font-size: 24px; {{ couleur_background_1() }}"><i class="fa fa-plus" aria-hidden="true"> Ajouter une catégorie</i></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Priorité</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                    </thead>
                    <tbody id="datatablecategories">
                        @foreach ($categories as $categorie)
                        <tr class="row1" data-id="{{ $categorie->id }}">
                            <td>
                                <div style="color:rgb(124,77,255); padding-left: 10px; float: left; font-size: 20px; cursor: pointer;">
                                <i class="fa fa-ellipsis-v"></i>
                                <i class="fa fa-ellipsis-v"></i>
                                </div>
                            </td>
                            <td>{{ $categorie->nom }}</td>
                            <td>{{ $categorie->priority_order }}</td>
                            <td>
                                <a href="{{ route('root_espace_admin_details_categorie', $categorie->id) }}">
                                    <button  data-toggle="tooltip" title="Voir" class="btn" style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-eye"></i></button>
                                 </a>
                                <button  data-toggle="tooltip" title="Editer" id="btn_edit_categorie" data-id="{{ $categorie->id }}" data-nom = "{{ $categorie->nom }}" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                <button  data-toggle="tooltip" title="Supprimer" id="btn_delete_categorie" data-id="{{ $categorie->id }}" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
@include('espace-admin.categories._form');

{{-- supprimer --}}
@include('layouts.modal', ["route" => route('root_espace_admin_delete_categorie', 0), 'nom'=>'cette catégorie'])

@endsection

@section('js')

<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>

<script>
    $(document).on('click', '#btn_edit_categorie', function(){
        var ID = $(this).attr('data-id');
        var nom = $(this).attr('data-nom');
        var priority = $(this).attr('data-priority');

        $('#edit_id').val(ID);
        $('#edit_nom').val(nom);
        $('#edit_priority').val(priority);

        $('#ModalModifie').modal('show');
    });

    $(document).on('click', '#btn_delete_categorie', function(){
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

    $(document).on('click', '#btn_ajout_categorie', function(){

        $('#ModalAjoutCategorie').modal('show');
    });
</script>
<script type="text/javascript">
    $(function () {
      $( "#datatablecategories" ).sortable({
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
          url: "{{ route('root_espace_admin_update_order') }}",
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
