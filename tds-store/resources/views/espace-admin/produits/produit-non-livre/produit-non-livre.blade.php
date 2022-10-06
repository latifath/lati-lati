@extends('layouts.master-dashboard')

@section('produit-non-livrer')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Produit',
    'infos2' => 'Produit',
    'infos3' => 'Produits non livrés',
])
<br>
<div class="row mt-2">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white text-center " style="font-size: 24px;">Produits non livrés</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Id commande</th>
                            <th>Id produit</th>
                            <th>quantite</th>
                            <th>Status</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                    $i= 1;
                                @endphp
                                @foreach ($produits_non_livre as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->commande_id }}</td>
                                <td>{{ $item->produit_id }}</td>
                                <td>{{ $item->quantite }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ route('root_espace_admin_modifie_produits_non_livre', $item->id) }}">
                                        <button data-toggle="tooltip" title="Livré" id="btn_delete_produit" class="btn bg-success text-white" ><i class="fa fa-check" aria-hidden="true"></i> Livrée</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                                @php
                                    $i++;
                                @endphp
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white text-center " style="font-size: 24px;">Produits déjà livrés</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable2" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Id commande</th>
                            <th>Id produit</th>
                            <th>Quantité</th>
                            <th>Status</th>
                            <th style="width: 8%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                    $i = 1;
                                @endphp
                                @foreach ($produits_livre as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->commande_id }}</td>
                                <td>{{ $item->produit_id }}</td>
                                <td>{{ $item->quantite}}</td>
                                <td>{{ $item->status}}</td>
                                <td>
                                    <a href="{{ route('root_espace_admin_retirer_produits_non_livre', $item->id) }}">
                                        <button data-toggle="tooltip" title="Non Livré" id="btn_delete_produit" class="btn" style="{{ couleur_background_2() }}; {{ couleur_blanche() }}"><i class="fa fa-trash" aria-hidden="true"></i> Non Livrée</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                                @php
                                    $i++;
                                @endphp
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @if($produits_non_livre != null)
<div class="modal fade" id="ConfirmationModalCenter" aria-labelledby="ConfirmationModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Livraison</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_modifie_produits_non_livre', $item->id ) }}"  method="POST
                ">
                @csrf
                @method('put')
                <div class="modal-body">
                    <input  class="form-control"  type="hidden" id="item_id" placeholder="" name="id">
                    <h5 class="text-center">Etes-vous sûr de vouloir livrer le produit? </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-danger">Oui, livrer</button>
                </div>
            </form>
       </div>
    </div>
</div>
@else
@endif --}}

{{-- @if($produits_livre != " ")
<div class="modal fade" id="ConfirmationNonLivrerModalCenter" aria-labelledby="ConfirmationNonLivrerModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_retirer_produits_non_livre', $item->id) }}"  method="POST">
                @csrf
                <div class="modal-body">
                    <input  class="form-control"  type="hidden" id="item_id" placeholder="" name="id" >
                    <h5 class="text-center">Etes-vous sûr de vouloir mettre le produit à non livrer? </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-danger">Oui, mettre</button>
                </div>
            </form>
       </div>
    </div>
</div>
@else
@endif --}}
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#datatable2').DataTable();
    });
</script>

{{-- <script>
    $(document).on('click', '#confirmation', function(){
       var ID = $(this).attr('data-id');

       $('#item_id').val(ID);

       $('#ConfirmationModalCenter').modal('show');
   });

   $(document).on('click', '#confirmation_non_livrer', function(){
       var id = $(this).attr('data-id');

       $('#item_id').val(id);

       $('#ConfirmationNonLivrerModalCenter').modal('show');
   });
</script> --}}
@endsection

