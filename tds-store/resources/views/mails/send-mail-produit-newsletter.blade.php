@component('mail::message')

Bonjour cher(e) Abonné(e),

<p>Nouveau produit disponible</p>
<p>{{ $produit->nom }}</p>
<p>{{ number_format($produit->prix, '0', '.', ' ') }} F CFA</p>
<p>{{ $produit->sous_categorie->nom }}</p>

@component('mail::button', ['url' => route('root_sitepublic_show_produit_par_sous_categorie', [$produit->sous_categorie->categorie->slug, $produit->sous_categorie->slug, $produit->slug ]) ])
    Lien vers la page
@endcomponent

@endcomponent
