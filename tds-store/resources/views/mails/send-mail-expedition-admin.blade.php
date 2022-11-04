@component('mail::message')

<p>Montant d'expédition à communiquer au client {{ $clt->nom }} {{ $clt->prenom }}</p>
<div class="">
    <h3>Informations de livraison</h3>
    <p>{{ $adresseLivraison['nom'] }} {{ $adresseLivraison['prenom'] }}</p>
    <p> {{ $adresseLivraison['rue'] }} , {{ $adresseLivraison['ville'] }} </p>
    <p>{{ $adresseLivraison['code_postal'] }} {{ $adresseLivraison['pays'] }}</p>
    <p>Tel: {{ $adresseLivraison['telephone'] }}</p>
</div>
@endcomponent
