@component('mail::message')

<p>Commande N° {{ $cde_pdt->commande_id}} passée par le client {{ $cde_pdt->commande->adresse_client->nom }} <br>
<h2>Produits</h2>
    <ul style="font-size: 14px;">
        @foreach ($stock_session as $key => $item)
            <li>
                {{ $item['name'] }}:  quantité restant à livrer {{ $item['qte'] }}.
            </li>
        @endforeach
    </ul>

{{ config('app.name') }}

@endcomponent
