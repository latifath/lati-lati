@component('mail::message')

Bonjour cher(e) {{ $cde_pdt->commande->adresse_client->nom }}
<br>
 <p> Vous venez de passer une commande dont la quantité du produit est insuffisante.</p>
<h3>Commande N° {{ $cde_pdt->commande_id }}</h3>
<h2>Produits</h2>

<ul style="font-size: 14px;">
    @foreach ($stock_session as $key => $item)
        <li>
            {{ $item['name'] }}:  quantité restant à livrer {{ $item['qte'] }}.
        </li>
    @endforeach
</ul>
<p>Nous vous tiendrons informé dès que le produit sera de nouveau disponible.</p>

Cordialemment!
<br>
<br>
{{ config('app.name') }}

@endcomponent
