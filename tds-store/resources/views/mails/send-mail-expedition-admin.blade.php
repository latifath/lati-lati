@component('mail::message')

<p>Montant d'expédition à communiquer au client {{ $clt->nom }} {{ $clt->prenom }}</p>
<div class="">
    <p>Commande N° {{ $commande->id }}</p>
    <div class="">
        <h2>Informations de livraison</h2>
        <p>{{ $adresseLivraison['nom'] }} {{ $adresseLivraison['prenom'] }}</p>
        <p> {{ $adresseLivraison['rue'] }} {{ $adresseLivraison['ville'] }} </p>
        <p>{{ $adresseLivraison['code_postal'] }} {{ $adresseLivraison['pays'] }}</p>
        <p>Tel: {{ $adresseLivraison['telephone'] }}</p>
    </div>
</div>
@endcomponent
