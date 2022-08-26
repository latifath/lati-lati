@extends('layouts.master-dashboard')

@section('détail-sous-categorie')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Sous-catégories',
    'infos2' => 'Toutes les Sous-catégories',
    'infos3' => 'Détails sous-catégorie',
])
<br>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white "  style="font-size: 24px; text-align: center;">Détails des produits associés à la sous-catégorie # </h4>
            </div>
           <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Slug</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($sous_cat_pdt as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nom }}</td>
                            <td>{{ $item->description}}</td>
                            <td>{{ $item->slug}}</td>
                            <td>{{ $item->quantite }}</td>
                            <td>{{ $item->prix }}</td>
                            <td>{{ $item->created_at }}</td>

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
    </div>
</div>
@endsection
