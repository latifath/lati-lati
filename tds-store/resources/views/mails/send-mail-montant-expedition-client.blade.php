@component('mail::message')

<h2>Cher client, Un montant d'expédition à été ajouté à votre commande.<br>
Veuillez vous connecter à votre espace pour plus de détail en cliquant sur le lien ci-dessous.
</h2>

@component('mail::button', ['url' => route('root_facture', ['id' => $invoice->id])])
    Lien vers la page
@endcomponent

@endcomponent
