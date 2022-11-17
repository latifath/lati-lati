<div class="modal fade" id="ModalModifie" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifie" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_edit')}}"  method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="">
                        <input id="edit_id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;"  type="hidden" placeholder="" name="id">
                        <div class="form-group">

                            <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;"  type="text" placeholder="entrez la catégorie" name="nom" id="edit_nom">
                            {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="button" type="reset" class="btn btn-secondary mr-auto" data-dismiss="modal">Annuler</button>
                   <button type="submit" class="btn" style="{{ couleur_background_1() }}; {{ couleur_blanche() }};" >Modifier</button>
                </div>
            </form>
       </div>
    </div>
</div>

{{-- ajout categorie --}}
<div class="modal fade" id="ModalAjoutCategorie" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAjoutCategorie" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajouter une nouvelle catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_store')}}"  method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px; " type="text" placeholder="Entrez la catégorie" name="nom">
                        {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="button" type="reset" class="btn btn-secondary mr-auto" data-dismiss="modal">Annuler</button>
                   <button type="submit" class="btn" style="{{ couleur_background_1() }}; {{ couleur_blanche() }};">Ajouter</button>
                </div>
            </form>
       </div>
    </div>
</div>
