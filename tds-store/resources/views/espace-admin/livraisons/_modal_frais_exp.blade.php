<div class="modal fade" id="ModalEditFraisExpédition" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalEditFraisExpédition" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajout Frais Exp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_livraison_update') }}"  method="POST">
                @csrf
                @method('put')
                <div class="modal-body" style="background-color:  #ffff;">
                    <input id="edit_id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;"  type="hidden" placeholder="" name="id">
                    <div class="form-group">
                        <label for="">Montant Exp</label>
                        <input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" style="height: 50px; " type="text" placeholder="" name="montant" id="edit_montant">
                        {!! $errors->first('montant', '<p class="text-danger">:message</p>') !!}
                    </div>
                </div>
                <div class="modal-footer"  style="display:block;">
                    <button id="button" type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                   <button type="submit" class="btn float-right" style="{{ couleur_background_1() }}; {{ couleur_blanche() }};">Ajouter</button>
                </div>
            </form>
       </div>
    </div>
</div>

{{-- pour la livraison --}}
<div class="modal fade" id="ModalConfirmationLivraison" aria-labelledby="ModalConfirmationLivraison" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Livraison</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_modification_statut_livraison', 0) }}"  method="POST">
                @csrf
                <div class="modal-body">
                    <input  class="form-control"  type="hidden" id="item_id" placeholder="" name="id">
                    <h5 class="text-center">Etes-vous sûr de vouloir confirmer que la livraison à été effectuée ? </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-danger">Oui, Confirmer</button>
                </div>
            </form>
       </div>
    </div>
</div>


<div class="modal fade" id="ModalGenerateFacture" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalGenerateFacture" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajout Frais Exp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_generate_facture') }}"  method="POST">
                @csrf
                <div class="modal-body" style="background-color:  #ffff;">
                    <input type="hidden" name="user_id" id="user_id">
                    <input type="hidden" name="livraison_id" id="livraison_id">
                    <div class="form-group">
                        <label for="">Assujetti a la tva ?</label>
                        <select class="custom-select {{ $errors->has('tva') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" name="tva" >
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                        {!! $errors->first('tva', '<p class="text-danger">:message</p>') !!}
                    </div>
                </div>
                <div class="modal-footer"  style="display:block;">
                    <button id="button" type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn float-right" style="{{ couleur_background_1() }}; {{ couleur_blanche() }};">Ajouter</button>
                </div>
            </form>
       </div>
    </div>
</div>
