
@component('mail::message')

#
<h2>Une commande passée par Mlle/Mr <strong> {{ $clt->nom }}</strong></h2>
@component('mail::panel')

<div class="">
    <h3>Adresse info</h3>
    <p>{{ $clt['nom'] }} {{ $clt['prenom'] }}</p>
    <p>{{ $clt['rue'] }} , {{ $clt['ville'] }}</p>
    <p>{{ $clt['code_postal'] }} {{ $clt['pays'] }}</p>

</div>
<br>
<br>
<div class="">
    <h3>Adresse livraison info</h3>
    <p>{{ $adr['nom'] }} {{ $adr['prenom'] }}</p>
    <p>{{ $adr['rue'] }} , {{ $adr['ville'] }}</p>
    <p>{{ $adr['code_postal'] }} {{ $adr['pays'] }}</p>
    <p>Tel: {{ $adr['telephone'] }}</p>
</div>
@endcomponent

#

@component('mail::table')
<h1>Détails commande</h1>

| Produit    |      Qty     |  Prix  |  Sous-total |
| ---------- |------------- | ------ | ------      |
@foreach (detail_commande($commande->id) as $item)
| {{ $item->produit->nom }} | {{ $item->quantite }} | {{ number_format($item->prix, '0', '.', ' ') }} F CFA |  {{number_format($item->prix * $item->quantite, '0', '.', ' ') }} F CFA|
@endforeach

@endcomponent

<div class="card-body">
<h2>Id commande: {{ $commande->id }}</h2>
<h2>Date de commande: {{ $commande->created_at->format('d-m-Y') }} </h2>
<h2>Montant Total TTC: </h2>
</div>

<div class="card-body">
<h2>Remise: {{ $commande->remise }}</h2>

 @if(exist_commande_paiement($commande->id) != null)
<h2>Mode de paiement: {{ $commande->paiements->type_paiement }}</h2>
<h2>Montant Total TTC: {{ $commande->paiements->montant }}</h2>
@else

@endif
</div>



{{ config('app.name') }}

@endcomponent
