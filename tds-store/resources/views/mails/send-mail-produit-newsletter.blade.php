@component('mail::message')

Bonjour cher(e) Abonné(e),

<p>Nouveau produit disponible</p>
<p>{{ $produit->nom }}</p>
<p>{{ number_format($produit->prix, '0', '.', ' ') }} F CFA</p>
<p>{{ $produit->sous_categorie->nom }}</p>

@endcomponent
