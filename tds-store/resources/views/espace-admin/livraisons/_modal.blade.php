{{-- Ajout expédition --}}
<div class="modal fade" id="ModalAjoutExpédition" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAjoutExpédition" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajouter une expédition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_store_expedition') }}"  method="POST">
                @csrf
                <div class="modal-body" style="background-color:  #ffff;">
                    <div class="form-group">
                        <label for="">Ville</label>
                        <input class="form-control {{ $errors->has('ville') ? 'is-invalid' : '' }}" style="height: 50px; " type="text" placeholder="" name="ville">
                        {!! $errors->first('ville', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        <label for="">Montant</label>
                        <input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" style="height: 50px; " type="text" placeholder="" name="montant">
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

{{-- update expedition --}}
<div class="modal fade" id="ModalModifieExpedition" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifieExpedition" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification expédition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_update_expedition')}}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body" style="background-color: #ffff;">
                    <div class="">
                        <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;"  type="hidden" placeholder="" name="id" id="edit_id">
                        <div class="form-group">
                            <label for="">Ville</label>
                            <input class="form-control {{ $errors->has('ville') ? 'is-invalid' : '' }}" style="height: 50px;"  type="text" placeholder="" name="ville" id="edit_ville">
                            {!! $errors->first('ville', '<p class="text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label for="">Montant</label>
                            <input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" style="height: 50px;"  type="text" placeholder="" name="montant" id="edit_montant">
                            {!! $errors->first('montant', '<p class="text-danger">:message</p>') !!}
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
