@component('mail::message')

Bonjour {{ $cmde->adresse_client->nom }}
<p>Votre commande a été traitée avec succès!!.</p>

@endcomponent
