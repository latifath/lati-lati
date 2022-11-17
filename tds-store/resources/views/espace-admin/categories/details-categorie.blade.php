@extends('layouts.master-dashboard')

@section('détail-categorie')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Catégories',
    'infos2' => 'Toutes les categories',
    'infos3' => 'Détails catégorie',
])
<br>
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card m-b-30">
           <div class="card-header bg-success">
                <h4 class="mt-3 header-title text-white "  style="font-size: 24px; text-align: center;"> Liste des sous-catégories associées à la catégorie {{ $categorie->nom }} </h4>
            </div>
           <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail_cat as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->nom }}</td>
                                <td>{{ $item->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
