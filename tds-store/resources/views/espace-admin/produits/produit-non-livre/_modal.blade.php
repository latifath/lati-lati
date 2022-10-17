<div class="modal fade" id="ModalConfirmLivraison" aria-labelledby="ModalConfirmLivraison" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Livraison</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_modifie_produits_non_livre', 0) }}"  method="POST
                ">
                @csrf
                <div class="modal-body">
                    <input  class="form-control"  type="hidden" id="item_id" placeholder="" name="id">
                    <h5 class="text-center">Etes-vous sûr de vouloir confirmer cette livraison ? </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-danger">Oui, livrer</button>
                </div>
            </form>
       </div>
    </div>
</div>

<div class="modal fade" id="ConfirmationNonLivrerModalCenter" aria-labelledby="ConfirmationNonLivrerModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_retirer_produits_non_livre', 0) }}"  method="POST">
                @csrf
                <div class="modal-body">
                    <input  class="form-control"  type="hidden" id="id_item" placeholder="" name="id" >
                    <h5 class="text-center">Etes-vous sûr de vouloir mettre le produit à non livrer? </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-danger">Oui, mettre</button>
                </div>
            </form>
       </div>
    </div>
</div>
