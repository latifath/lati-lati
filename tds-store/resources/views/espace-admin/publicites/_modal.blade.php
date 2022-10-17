<div class="modal fade" id="ModalAjoutPublicite" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAjoutPublicite" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ajout publicité</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <form action="{{ route('root_espace_admin_ajouter_publicites') }}"  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="background-color:  #ffff;">

                <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" type="hidden" placeholder="" name="id" id="add_id">

                <div class="form-group">
                    <label for="">Nom</label>
                    <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" type="text" placeholder="" name="nom">
                    {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                </div>

                 <div class="form-group">
                    <label for="">Message</label>
                    <input class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" type="text" placeholder="" name="message">
                    {!! $errors->first('message', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="form-group">
                    <label for="">Image</label>
                    <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" type="file" placeholder="" name="image">
                    {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="modal-footer" style="display:block; padding:0px;">
                    <button id="button" type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: 50px; float:left; margin-right: 310px;">Annuler</button>
                    <button type="submit" class="btn btn-primary" style="float:right">Ajouter</button>
                </div>
                </div>
            </form>
       </div>
    </div>
</div>

<div class="modal fade" id="ModalModifiepublicite" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifiepublicite" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification publicité </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_modifier_publicites') }}"  method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="modal-body" style="background-color:  #ffff;">

                <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" type="hidden" placeholder="" name="id" id="edit_id">

                <div class="form-group">
                    <label for="">Nom</label>
                    <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" type="text" placeholder="" name="nom" id="edit_nom">
                    {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                </div>

                 <div class="form-group">
                    <label for="">Message</label>
                    <input class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" type="text" placeholder="" name="message" id="edit_message">
                    {!! $errors->first('message', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="modal-footer" style="display:block; padding:0px;">
                    <button id="button" type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: 50px; float:left; margin-right: 310px;">Annuler</button>
                    <button type="submit" class="btn btn-primary" style="float:right;">Modifier</button>
                </div>
                </div>
            </form>
       </div>
    </div>
</div>

<div class="modal fade" id="ModalModifieImagepublicite" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifiepublicite" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Upload Image </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_modifier_image_publicites') }}"  method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body" style="background-color:  #ffff;">

                <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px; border: 1px solid;" type="hidden" placeholder="" name="id" id="edit_image_id">

                <div class="form-group">
                    <label for="">image</label>
                    <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" style="height: 50px;" type="file" placeholder="" name="image" id="edit_image">
                    {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="modal-footer" style="display:block; padding:0px;">
                    <button id="button" type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: 50px; float:left; margin-right: 310px;">Annuler</button>
                    <button type="submit" class="btn btn-primary" style="float: right;">Modifier</button>
                </div>
                </div>
            </form>
       </div>
    </div>
</div>
