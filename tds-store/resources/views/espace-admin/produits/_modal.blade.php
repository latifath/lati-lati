
<div class="modal fade" id="ModalAjoutStock" data-backdrop="static" data-keyboasrd="false" tabindex="-1" aria-labelledby="ModalAjoutStock" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajouter un nouveau stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_stock_create') }}"  method="POST">
                @csrf
                <div class="modal-body">

                    <input class="form-control {{ $errors->has('produit') ? 'is-invalid' : '' }}" style="height: 50px;" type="hidden" placeholder="" name="produit" id="add_stock_id">

                    <div class="form-group">
                        <label for="">Prix Unitaire</label>
                        <input class="form-control {{ $errors->has('prix_unitaire') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="prix_unitaire">
                        {!! $errors->first('prix_unitaire', '<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <label for="">Quantité</label>
                        <input class="form-control {{ $errors->has('quantite') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="quantite">
                        {!! $errors->first('quantite', '<p class="text-danger">:message</p>') !!}
                    </div>
                </div>

                <div class="modal-footer" style="display:block;">
                    <button id="button" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary float-right">Ajouter</button>
                </div>
            </form>
       </div>
    </div>
</div>

<div class="modal fade" id="ModalModifieImageProduit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifieImageProduit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Upload Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_modifie_image_produit') }}"  method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body" style="background-color: #ffff;">
                    <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;" type="hidden" placeholder="" name="id" id="edit_image_id">

                    <div class="form-group">
                        <label for="">Image</label>
                        <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" style="height: 50px;" type="file" placeholder="" name="image">
                        {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
                    </div>
                </div>
                <div class="modal-footer" style="display:block;">
                    <button id="button" type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary float-right">Modifier</button>
                </div>
            </form>
       </div>
    </div>
</div>


<div class="modal fade" id="ModalAjoutFiche" data-backdrop="static" data-keyboasrd="false" tabindex="-1" aria-labelledby="ModalAjoutFiche" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajouter une fiche Technique au produit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_produit_fiche_technique') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">

                    <input class="form-control {{ $errors->has('produit') ? 'is-invalid' : '' }}" style="height: 50px;" type="hidden" placeholder="" name="id" id="btn_add_fiche_id">
                    <div class="form-group">
                        <label for="">Fiche Technique</label>
                        <input class="form-control {{ $errors->has('fichier') ? 'is-invalid' : '' }}" style="height: 50px;" type="file" placeholder="" name="fichier">
                        {!! $errors->first('fichier', '<p class="text-danger">:message</p>') !!}
                    </div>

                </div>

                <div class="modal-footer" style="display:block;">
                    <button id="button" type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary float-right">Ajouter</button>
                </div>
            </form>
       </div>
    </div>
</div>
