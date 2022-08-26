@component('mail::message')

Bonjour {{ $commande->adresse_client->nom }}
<p>Votre commande n°{{ $commande->id }} a été Annulee avec succès!.</p>

@endcomponent
