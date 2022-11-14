
@component('mail::message')

Bonjour cher(e) {{ $clt['nom'] }}
<p>Nous avons reçue votre commande!, merci de continuer le processus.</p>

#

@component('mail::panel')

<div class="">
    <h3>Adresse info</h3>
    <p>{{ $clt['nom'] }} {{ $clt['prenom'] }}</p>
    <p> {{ $clt['rue'] }} , {{ $clt['ville'] }} </p>
    <p>{{ $clt['code_postal'] }} {{ $clt['pays'] }}</p>

</div>
<br>
<br>
<div class="">
    <h3>Adresse livraison info</h3>
    <p>{{ $adr['nom'] }} {{ $adr['prenom'] }}</p>
    <p> {{ $adr['rue'] }} , {{ $adr['ville'] }} </p>
    <p>{{ $adr['code_postal'] }} {{ $adr['pays'] }}</p>
    <p>Tel: {{ $adr['telephone'] }}</p>
</div>

@endcomponent


#

@component('mail::table')
<h1>Details commande</h1>

| Produit    |      Qty     |  Prix  |  Sous-total |
| ---------- |------------- | ------ | ------      |
@foreach (detail_commande($commande->id) as $item)
| {{ $item->produit->nom }} | {{ $item->quantite }} | {{ number_format($item->prix, '0', '.', ' ') }} F CFA |  {{number_format($item->prix * $item->quantite, '0', '.', ' ') }} F CFA|
@endforeach

@endcomponent

<div class="card-body">
    <h2>Id commande: {{ $commande->id }}</h2>
    <h2>Date commande: {{ $commande->created_at->format('d-m-Y') }} </h2>
    <h2>Montant Total: {{ number_format(total_commande($commande->id), '0', '.', ' ') }} F CFA</h2>
    @if ($commande->promotion != null)
    <h2>Remise: {{ valeur_coupon_cmde($commande->promotion) != null ? valeur_coupon_cmde($commande->promotion) : 'null' }}</h2>
    @endif
    <h2>Expédition: {{ info_livraison($commande->id)->montant != null ? number_format(info_livraison($commande->id)->montant, '0', '.', ' ' ) . ' F CFA ' : 'À communiquer' }}</h2>
</div>


 {{-- @component('mail::promotion')

    This is a promotion component

@endcomponent --}}

{{--
# Subcopy component:

@component('mail::subcopy')

    This is a subcopy component

@endcomponent  --}}


{{-- Thanks, --}}

{{ config('app.name') }}

@endcomponent
