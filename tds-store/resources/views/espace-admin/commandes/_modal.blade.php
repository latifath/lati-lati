<div class="modal fade" id="ConfirmationModalCenter" aria-labelledby="ConfirmationModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Acceptation commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_valider_commande', $commande->id) }}"  method="POST">
                @csrf
                <div class="modal-body">
                    <input  class="form-control"  type="hidden" id="item_id" placeholder="" name="id" >
                    <h5 class="text-center">Etes-vous sûr de vouloir marquer la commande comme terminée ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-success">Oui, Accepter</button>
                </div>
            </form>
       </div>
    </div>
</div>

<div class="modal fade" id="AnnulerModalCenter" aria-labelledby="AnnulerModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Annuler commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_annuler_commande', $commande->id) }}"  method="POST">
                @csrf
                <div class="modal-body">
                    <input  class="form-control"  type="hidden" id="item_id" placeholder="" name="id" >
                    <h5 class="text-center">Etes-vous sûr de vouloir annuler la commande ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-success">Oui, Annuler</button>
                </div>
            </form>
       </div>
    </div>
</div>

<div class="modal fade" id="CommandeAttenteModalCenter" aria-labelledby="CommandeAttenteModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Mettre commande en ettente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_en_attente_commande', $commande->id) }}"  method="POST">
                @csrf
                <div class="modal-body">
                    <input  class="form-control"  type="hidden" id="item_id" placeholder="" name="id" >
                    <h5 class="text-center">Etes-vous sûr de vouloir mettre la commande en attente?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-success">Oui, Accepter</button>
                </div>
            </form>
       </div>
    </div>
</div>

