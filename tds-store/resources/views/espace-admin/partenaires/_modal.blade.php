<div class="modal fade" id="ModalModifiePartenaire" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifiePartenaire" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Modifier un partenaire</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{ route('root_espace_admin_edit_partenaire')}}"  method="POST">
               @csrf
               @method('put')
               <div class="modal-body" style="">
                   <div class="">
                       <input id="edit_id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;"  type="hidden" placeholder="" name="id" >
                       <div class="form-group">
                           <label for="">Nom</label>
                           <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;"  type="text" placeholder="entrez le nom" name="nom" id="edit_nom">
                           {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                       </div>

                       <div class="form-group">
                        <label for="">Numéro d'ordre</label>
                        <input class="form-control {{ $errors->has('ordre_de_numero') ? 'is-invalid' : '' }}" style="height: 50px;"  type="text" placeholder="entrez le numéro d'ordre" name="ordre_de_numero" id="edit_ordre_de_numero">
                        {!! $errors->first('ordre_de_numero', '<p class="text-danger">:message</p>') !!}
                    </div>
                   </div>
               </div>
               <div class="modal-footer">
                   <button id="button" type="reset" class="btn btn-secondary mr-auto" data-dismiss="modal">Annuler</button>
                   <button type="submit" class="btn float-right" style="{{ couleur_background_1() }}; {{ couleur_blanche() }}">Modifier</button>
               </div>
           </form>
      </div>
   </div>
</div>

<div class="modal fade" id="ModalModifieImagePartenaire" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifieImagePartenaire" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Upload Image</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{ route('root_espace_admin_edit_image_partenaire') }}"  method="POST" enctype="multipart/form-data">
               @csrf
               @method('put')
               <div class="modal-body" style="background-color:  #ffff;">
                    <input id="edit_image_id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;"  type="hidden" placeholder="" name="id" >
                    <div class="form-group">
                        <label for="">Logo</label>
                        <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" style="height: 50px;"  type="file" placeholder="" name="image" id="edit_image">
                        {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
                    </div>
                </div>
               <div class="modal-footer">
                    <button id="button" type="reset" class="btn btn-secondary mr-auto" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn float-right" style="{{ couleur_background_1() }}; {{ couleur_blanche() }};">Upload</button>
               </div>
           </form>
      </div>
   </div>
</div>


<div class="modal fade" id="ModalAjoutPartenaire" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAjoutPartenaire" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Ajouter un partenaire</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <form action="{{ route('root_espace_admin_partenaire_create')}}"  method="POST" enctype="multipart/form-data">
               @csrf
               <div class="modal-body" style="background-color:  #ffff;">
                   <div class="form-group">
                       <label for="">Nom</label>
                       {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="Entrez le nom" name="nom">

                    <div class="form-group">
                        <label for="">Numéro d'ordre</label>
                        <input class="form-control {{ $errors->has('ordre_de_numero') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="Entrez le numéro d'ordre" name="ordre_de_numero">
                        {!! $errors->first('ordre_de_numero', '<p class="text-danger">:message</p>') !!}
                    </div>

                <div class="form-group">
                    <label for="">Logo</label>
                    <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" style="height: 50px;" type="file" placeholder="Entrez l'image" name="image">
                    {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
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
