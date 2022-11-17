<div class="modal fade" id="ModalModifieSousCategorie" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifieSousCategorie" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification une sous-catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_edit_sous_categorie')}}"  method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="">
                        <input id="edit_id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;" type="hidden" placeholder="" name="id" >
                        <div class="form-group">
                            <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="entrez la sous-catégorie" name="nom" id="edit_nom">
                            {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="button" type="reset" class="btn btn-secondary mr-auto" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn float-right" style="{{ couleur_background_1() }}; {{ couleur_blanche() }};" >Modifier</button>

                </div>
            </form>
       </div>
    </div>
</div>

<div class="modal fade" id="ModalAjoutSousCategorie" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAjoutSousCategorie" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajouter une sous-catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_create_sous_categorie')}}"  method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nom</label>
                        <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="Entrez la sous-catégorie" name="nom">
                        {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <div class=" form-group">
                        <label for="">Catégorie</label>
                        <select class="custom-select {{ $errors->has('categorie') ? 'is-invalid' : '' }}" style="height: 50px;" name="categorie" >
                            <option value="">Choisir une catégorie</option>
                            @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('categorie', '<p class="text-danger">:message</p>') !!}
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="button" type="reset" class="btn btn-secondary mr-auto" data-dismiss="modal">Annuler</button>
                   <button type="submit" class="btn float-right" style="{{ couleur_background_1() }}; {{ couleur_blanche() }};" >Ajouter</button>

                </div>
            </form>
       </div>
    </div>
</div>
