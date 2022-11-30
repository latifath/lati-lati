@extends('layouts.master-dashboard')
@section('gestion-paiement')
@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Paiements',
    'infos2' => 'Paiements',
    'infos3' => 'Tous les paiements',
])
<br>
<div class="col-12">
    <div class="card border-secondary mb-5">
            <div class="card-header text-white border-0" style="{{  couleur_background_1()  }}">
                <h4 class="font-weight-semi-bold m-0">Historique paiement</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Date paiement</th>
                                <th>Montant du paiement</th>
                                <th>Type de paiement</th>
                                <th>Numero commande</th>
                                <th style="width: 8%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bills as $invoice)
                                <tr>
                                    <td>{{ $invoice->created_at }}</td>
                                    <td>{{ number_format(($invoice->total), 0, '.', ' ')}} F CFA</td>
                                    <td>{{ $invoice->payment_method }}</td>
                                    <td>{{ commande($invoice->id) ? '#' . commande($invoice->id)->id : 'Néant'}}</td>
                                    <td>
                                        @if (commande($invoice->id))
                                            <a href="{{ route('root_espace_client_commande_show', $invoice->id) }}">
                                                <button class="btn btn-secondary"><i class="fa fa-eye" aria-hidden="true"></i> Voir</button>
                                            </a>
                                        @endif
                                        <a href="{{ route('root_facture', $invoice->id) }}">
                                            <button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Facture</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
@endsection
