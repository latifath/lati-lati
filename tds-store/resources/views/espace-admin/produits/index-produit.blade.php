@extends('layouts.master-dashboard')

@section('produits')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Produits',
    'infos2' => 'Produits',
    'infos3' => 'Tous les produits',
])
<br>
<button   data-toggle="tooltip" title="Imprimer liste des produits en ruptures de stock" class="btn border" onClick="imprimer('rupture_stock')" style="{{ couleur_background_1() }}; {{ couleur_blanche() }}; text-white;"> Produit en rupture de stock
</button>
<button   data-toggle="tooltip" title="Imprimer liste des produits" class="btn border" onClick="imprimer('les_produits')" style="{{ couleur_background_1() }}; {{ couleur_blanche() }}; text-white;"> Liste des produits
</button>
<br>
<div class="row mt-2">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white text-center " style="font-size: 24px;">Tous les produits</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Sous-catégorie</th>
                            <th>Fiche technique</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($produits as $key => $produit)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $produit->nom }}</td>
                                    <td>{{ $produit->quantite }}</td>
                                    <td>{{ $produit->prix }}</td>
                                    <td>{{ $produit->sous_categorie->nom }}</td>
                                    @if($produit->file_id != null)
                                    <td>#</td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td>
                                        <a href="{{ route('root_espace_admin_show_produit', $produit->id) }}">
                                            <button   data-toggle="tooltip" title="voir produit" class="btn btn-primary"><i class="fa fa-eye"></i></button>
                                        </a>

                                        <a href="{{ route('root_espace_admin_show_images', $produit->id) }}">
                                            <button   data-toggle="tooltip" title="Galerie images" id="btn_add_image"  class="btn"  style="background-color:#ffc107; border: #ffc107; color: white;"><i class="fa fa-imdb"></i></button>
                                        </a>
                                        <button data-toggle="tooltip" title="Ajouter stock" id="btn_add_stock" class="btn" data-id={{ $produit->id}} style="background-color: #007bff; border: #007bff; color: white;"><i class="fa fa-plus"></i></button>

                                        <button data-toggle="tooltip" title="Ajouter la fiche technique" id="btn_add_fiche_technique" class="btn btn-secondary" data-id={{ $produit->id}} data-nom={{ $produit->nom }}><i class="fa fa-plus"></i></button>
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


{{-- impression --}}
<div class="d-none">
    <div id='rupture_stock'>
        <br>
        <h3  class="text-center">Produits en rupture de stock</h3>
        <table class="table table-striped table-bordered dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
            <thead>
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Quantite</th>
                <th>Prix</th>
                <th>Sous-catégorie</th>
                <th>Catégorie</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp

                @foreach($produits_rupture as $produit)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->quantite }}</td>
                    <td>{{ number_format($produit->prix, '0', '.', ' ')}} F CFA</td>
                    <td>{{ $produit->sous_categorie->nom}}</td>
                    <td>{{ $produit->sous_categorie->categorie->nom}}</td>
                </tr>
                @php
                $i++;
            @endphp
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- les produits --}}

<div class="d-none">
    <div id='les_produits'>
        <h3  class="text-center">Tous les produits</h3>
        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
            <thead>
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Quantite</th>
                <th>Prix</th>
                <th>Sous-catégorie</th>
                <th>Catégorie</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp

                @foreach($produits as $produit)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->quantite }}</td>
                    <td>{{ number_format($produit->prix, '0', '.', ' ')}} F CFA</td>
                    <td>{{ $produit->sous_categorie->nom}}</td>
                    <td>{{ $produit->sous_categorie->categorie->nom}}</td>

                </tr>
                @php
                $i++;
            @endphp
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('espace-admin.produits._modal');

@include('layouts.modal', ["route" => route('root_espace_admin_produit_delete', 0), 'nom'=>'cet produit'])

@endsection

@section('js')
<script>
    $(document).on('click', '#btn_edit_produit', function(){
        var ID = $(this).attr('data-id');
        var nom = $(this).attr('data-nom');
        var quantite = $(this).attr('data-quantite');
        var prix = $(this).attr('data-prix');
        var description = $(this).attr('data-description');

        $('#edit_id').val(ID);
        $('#edit_nom').val(nom);
        $('#quantite').val(quantite);
        $('#prix').val(prix);
        $('#description').val(description);

        $('#ModalModifieProduit').modal('show');
    });

    $(document).on('click', '#btn_delete_produit', function(){
        var ID = $(this).attr('data-id');

        $('#item_id').val(ID);

        $('#DeleteModalCenter').modal('show');
    });

    // ajout stock
    $(document).on('click', '#btn_add_stock', function(){

        var ID = $(this).attr('data-id');

        $('#add_stock_id').val(ID);

       $('#ModalAjoutStock').modal('show');
    });

    // ajout fiche technique
    $(document).on('click', '#btn_add_fiche_technique', function(){

        var id = $(this).attr('data-id');

        var nom = $(this).attr('data-nom');


        $('#btn_add_fiche_id').val(id);

        $('#btn_add_fiche_nom').val(nom);

        $('#ModalAjoutFiche').modal('show');
    });

</script>
<script>
    function imprimer(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload();
    }
</script>
@endsection
