@component('mail::message')

Bonjour cher(e) {{ $cmde->adresse_client->nom }}
<p>Votre commande n°{{ $cmde->id }} a été traitée avec succès.</p>

<h1>Détails commande</h1>
<div class="card-body">
    <p><strong>Id commande</strong>: {{ $cmde->id }}</p>
    <h3>Date commande: {{ $cmde->created_at->format('d-m-Y') }} </h3>
    <h3>Montant Total: {{ number_format(total_commande($cmde->id), '0', '.', ' ') }} F CFA</h3>
    @if ($cmde->promotion != null)
        <h3>Remise: {{ valeur_coupon_cmde($cmde->promotion) != null ? valeur_coupon_cmde($cmde->promotion) : 'null' }}</h3>
    @endif
    <h3>TVA: {{ $cmde->tva == 1 ? '18%' : '0%' }}</h3>
    @if(exist_commande_paiement($cmde->id) != null)
        <h3>Mode de paiement: {{ exist_commande_paiement($cmde->id)->type_paiement }}</h3>
    @endif
    <h3>Expédition: {{ info_livraison($cmde->id)->montant != null ? number_format(info_livraison($cmde->id)->montant, '0', '.', ' ' ) . ' F CFA ' : 'À communiquer' }}</h3>
    <h3>Montant Total TTC: {{ number_format ((montant_ttc(montant_apres_reduction_sans_session(total_commande($cmde->id), $cmde->promotion), $cmde->adresse_livraison_id) + info_livraison($cmde->id)->montant), 0, '.', ' ') }} F CFA</h3>
</div>

<h3> Cordialement !</h3>

{{ config('app.name') }}

@endcomponent
