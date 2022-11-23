<div class="modal fade" id="ModalModifiefacture" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifiefacture" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification Facture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_facture_update')}}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body" style="background-color: #ffff;">
                    <div class="">
                        <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;"  type="hidden" placeholder="" name="id" id="edit_id">
                        <div class="form-group">
                            <label for="">Désignation</label>
                            <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" style="height: 50px;"  type="text" placeholder="" name="description" id="edit_description">
                            {!! $errors->first('description', '<p class="text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label for="">Prix Unitaire</label>
                            <input class="form-control {{ $errors->has('prix') ? 'is-invalid' : '' }}" style="height: 50px;"  type="text" placeholder="" name="prix" id="edit_prix">
                            {!! $errors->first('prix', '<p class="text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label for="">Quantité</label>
                            <input class="form-control {{ $errors->has('quantite') ? 'is-invalid' : '' }}" style="height: 50px;"  type="text" placeholder="" name="quantite" id="edit_quantite">
                            {!! $errors->first('quantite', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="display:block;">
                    <button id="button" type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                   <button type="submit" class="btn float-right" style="{{ couleur_background_1() }}; {{ couleur_blanche() }};" >Modifier</button>
                </div>
            </form>
       </div>
    </div>
</div>


<div class="modal fade" id="ModalConfirmationFacture" aria-labelledby="ModalConfirmationFacture" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Livraison</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_facture_validate', 0) }}"  method="POST">
                @csrf
                <div class="modal-body">
                    <input  class="form-control"  type="hidden" id="item_id" placeholder="" name="id">
                    <h5 class="text-center">Etes-vous sûr de vouloir valider la facture </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-success">Oui, Confirmer</button>
                </div>
            </form>
       </div>
    </div>
</div>
