@extends('layouts.master-dashboard')


@section('bilan-paiement')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Récapitulatif paiement',
    'infos2' => 'TDS Store',
    'infos3' => 'Bilan',
])
<br>
<div class="row">
    <div class="col-md-12 ">
        <div class="card m-b-30">
            <div class="card-header bg-light">
                <h4 class="mt-2 header-title text-dark" style="font-size: 24px">Bilan des paiements entrés </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('root_espace_admin_recapitutatif_paiement_show') }}">
                    @csrf
                    <div class="row col-md-12">
                        <div class="col-md-5">
                            <label>Période du :</label>
                            <input class="form-control {{ $errors->has('date_de_debut') ? 'is-invalid' : '' }}" style="height: 50px;" value="" type="date" placeholder="" name="date_de_debut" required/>
                            {!! $errors->first('date_de_debut', '<p class="text-danger">:message</p>') !!}

                        </div>
                        <div class="col-md-5">
                            <label>Au :</label>
                            <input class="form-control {{ $errors->has('date_de_fin') ? 'is-invalid' : '' }}" style="height: 50px;" value="" type="date" placeholder="" name="date_de_fin" required/>
                            {!! $errors->first('date_de_fin', '<p class="text-danger">:message</p>') !!}
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary font-weight-bold my-4 py-3 " type="submit" style="width: inherit">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
    @if ($payment)
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        @if($payment->count() == 0)
                        <h3 class="text-danger">Aucun paiement trouvé pour la période du {{ Carbon\Carbon::parse( $date_d)->format('d-m-Y') }} au {{ Carbon\Carbon::parse($date_f)->format('d-m-Y') }} </h3>
                        @else
                        {{-- Bouton pour l'impression --}}
                        <div>
                            <button class="btn border mb-3 mx-3" onClick="imprimer('bilan-paiement')" style="{{ couleur_background_1() }}; {{ couleur_blanche() }}; text-white;">
                                <i class="fa fa-print" aria-hidden="true" input type="button" value="Imprimer"></i> Imprimer
                            </button>
                        </div>
                        <div class="" id="bilan-paiement">
                            <h1 class="mt-0 header-title text-success" style="font-size: 30px; text-align: center;"> Etat des paiements du {{ Carbon\Carbon::parse( $date_d)->format('d-m-Y') }} au {{ Carbon\Carbon::parse($date_f)->format('d-m-Y') }}</h1>
                            <br>
                            <div class="table-responsive">
                                <table  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Reference</th>
                                            <th>Montant</th>
                                            <th>Commande N°</th>
                                            <th>Type paiement</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach($payment as $key => $paid)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $paid->reference }}</td>
                                                <td>{{ number_format($paid->total, '0', '.', ' ' )}} F CFA</td>
                                                <td>{{ $paid->id }}</td>
                                                <td>{{ $paid->payment_method }}</td>
                                                <td>{{ $paid->date_paid }}</td>
                                            </tr>
                                            @php
                                                $total = $total + $paid->total;
                                            @endphp

                                        @endforeach
                                        <tr class="">
                                            <td colspan="5" class="text-right" style="font-size:20px;"><strong>Total</strong></td>
                                            <td class="">{{ number_format($total, '0', '.', ' ') }} F CFA</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    @endif
@endsection
@section('js')
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

