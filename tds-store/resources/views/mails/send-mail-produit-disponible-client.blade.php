@component('mail::message')

Bonjour chèr(e) {{ $produit_non_livre->commande->adresse_client->nom }},
<p>Le reste de votre commande n°{{ $produit_non_livre->commande_id}}  vous a été livré avec succès.</p>
<h2>Produits</h2>
<ul style="font-size: 14px;">
        <li>
            {{$produit_non_livre->produit->nom }}:  quantité livrer {{ $produit_non_livre->quantite}}.
        </li>
</ul>

Cordialement!
@endcomponent
