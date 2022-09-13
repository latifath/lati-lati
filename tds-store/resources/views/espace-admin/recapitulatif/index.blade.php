@extends('layouts.master-dashboard')


@section('bilan-vente')

@include('layouts.partials-dashboard.entête-page', [
    'infos1' => 'Tableau de bord',
    'infos2' => 'TDS Store',
    'infos3' => 'Bilan',
])
<br>
<div class="row">
    <div class="col-md-12 ">
        <div class="card m-b-30">
            <div class="card-header bg-light">
                <h4 class="mt-2 header-title text-dark" style="font-size: 24px">Bilan de vente</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('root_espace_admin_recapitutatif_show') }}">
                    @csrf
                    <div class=row>
                        <div class="col-md-4 form-group">
                            <label>Période du :</label>
                            <input class="form-control {{ $errors->has('date_debut') ? 'is-invalid' : '' }}" style="height: 50px;" value="" type="date" placeholder="" name="date_debut" required/>
                            {!! $errors->first('date_debut', '<p class="text-danger">:message</p>') !!}

                        </div>
                        <div class="col-md-4 form-group">
                            <label>Au :</label>
                            <input class="form-control {{ $errors->has('date_fin') ? 'is-invalid' : '' }}" style="height: 50px;" value="" type="date" placeholder="" name="date_fin" required/>
                            {!! $errors->first('date_fin', '<p class="text-danger">:message</p>') !!}
                        </div>
                        <div class="col-md-2 form-group">
                            <button class="btn btn-primary font-weight-bold my-4 py-3 float-right" type="submit">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
    @if ($commandes == " ")

    @else
    <div class="row">
        <div>
            <button class="btn border mb-3 mx-3" onClick="imprimer('Bilan')" style="{{ couleur_background_1() }}; {{ couleur_blanche() }}; text-white;">
                <i class="fa fa-print" aria-hidden="true" input type="button" value="Imprimer"> </i> Imprimer
            </button>
        </div>
        <br>
        <div class="col-12" id="Bilan">
            <div class="card m-b-30">
                <div class="card-body">
                    @if($commandes->count() == 0)
                    <h3 class="text-danger">Aucune commande trouvé pour la période du {{ Carbon\Carbon::parse($date_debut)->format('d-m-Y') }} au {{ Carbon\Carbon::parse($date_fin)->format('d-m-Y') }}</h3>
                    @else
                    <h1 class="mt-0 header-title text-success" style="font-size: 24px; text-align: center;">Commandes du {{ Carbon\Carbon::parse($date_debut)->format('d-m-Y') }} au {{ Carbon\Carbon::parse($date_fin)->format('d-m-Y') }}</h1>
                    <div class="table-responsive">
                        <table  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; {{ couleur_principal() }}">
                            <thead>
                            <tr>
                                <th>N°</th>
                                <th>Id commande</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i= 1;
                                @endphp
                                @foreach($commandes as $commande)

                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $commande->id }}</td>
                                        <td>{{ total_commande($commande->id) }}</td>
                                        <td>{{ $commande->created_at->format('m/d/Y') }}</td>
                                        <td>{{ $commande->status }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
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
