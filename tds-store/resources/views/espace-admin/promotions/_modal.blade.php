<div class="modal fade" id="ModalAjoutPromotion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAjoutPromotion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajout d'une promotion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <form action="{{ route('root_espace_admin_promotion_ajouter') }}"  method="POST">
                @csrf
                <div class="modal-body" style="background-color: #ffff;">

                    <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;" type="hidden" placeholder="" name="id" >

                    <label for="">Code coupon</label>
                    <div class="form-group">
                        <input id="coupon" class="form-control {{ $errors->has('code_coupon') ? 'is-invalid' : '' }} text-uppercase" style="height: 50px; display: inline-block; width: 70%;"  type="text" placeholder="" name="code_coupon">
                        {!! $errors->first('code_coupon', '<p class="text-danger">:message</p>') !!}
                        <button id="generate" class="btn btn-success float-right" type="button" style="height: 50px; display: inline-block; width: 28%;"><i class="fa fa-refresh" aria-hidden="true"> Generate</i></button>
                    </div>

                    <div class="form-group">
                        <label for="">Type coupon</label>
                        <select class="custom-select {{ $errors->has('type') ? 'is-invalid' : '' }}" style="height: 50px;" name="type" >
                            <option value="fixed">fixed</option>

                            <option value="percent_of">percent_of</option>

                        </select>
                        {!! $errors->first('type', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        <label for="">Valeur coupon</label>
                        <input class="form-control {{ $errors->has('valeur') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="valeur" >
                        {!! $errors->first('valeur', '<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select class="custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}" style="height: 50px;" name="status" >
                            <option value="en cours">En cours </option>
                            <option value="termine">Termine</option>
                        </select>
                        {!! $errors->first('status', '<p class="text-danger">:message</p>') !!}
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

<div class="modal fade" id="ModalModifiePromotion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifiePromotion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification coupon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_promotion_update')}}"  method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="modal-body" style="background-color:  #ffff;">

                    <input id="edit_id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" type="hidden" placeholder="" name="id">

                    <label for="">Code coupon</label>
                    <div class="form-group">
                        <input id="coupon_edit" class="form-control {{ $errors->has('code_coupon') ? 'is-invalid' : '' }} text-uppercase" style="height: 50px; display: inline-block; width: 70%;"  type="text" placeholder="" name="code_coupon">
                        {!! $errors->first('code_coupon', '<p class="text-danger">:message</p>') !!}
                        <button id="generate_edit" class="btn btn-success float-right" type="button" style="height: 50px; display: inline-block; width: 28%;"><i class="fa fa-refresh" aria-hidden="true"> Generate</i></button>
                    </div>

                    <div class="form-group">
                        <label for="">Type coupon</label>
                        <select class="custom-select {{ $errors->has('type') ? 'is-invalid' : '' }}" style="height: 50px;" name="type" id='edit_type'>
                            <option value="fixed">fixed</option>

                            <option value="percent_of">percent_of</option>

                        </select>
                        {!! $errors->first('type', '<p class="text-danger">:message</p>') !!}
                    </div>

                     <div class="form-group">
                        <label for="">Valeur coupon</label>
                        <input class="form-control {{ $errors->has('valeur') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="valeur" id='edit_valeur'>
                        {!! $errors->first('valeur', '<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select class="custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}" style="height: 50px;" name="status" id='edit_status'>
                            <option value="en cours">En cours </option>
                            <option value="termine">Termine</option>
                        </select>
                        {!! $errors->first('status', '<p class="text-danger">:message</p>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="button" type="reset" class="btn btn-secondary mr-auto" data-dismiss="modal">Annuler</button>
                   <button type="submit" class="btn float-right" style="{{ couleur_background_1() }}; {{ couleur_blanche() }};">Modifier</button>
                </div>
            </form>
       </div>
    </div>
</div>
