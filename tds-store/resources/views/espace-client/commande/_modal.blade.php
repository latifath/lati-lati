<div class="modal fade" id="ModalAjoutPaiement" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAjoutPaiement" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Payement de la commande #<span class="text-danger">{{ $item->id }}</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <form action=""  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="background-color: #f0f0f0;">

                <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" style="height: 50px;" type="hidden" placeholder="" name="id" id="add_id">

                <div class="form-group">
                    <label for="">Montant</label>
                    <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="nom" id="add_montant">
                    {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                </div>

                 <div class="form-group">
                    <label for="">Type Paiement</label>
                     <select
                        class="custom-select {{ $errors->has('type_paiement') ? 'is-invalid' : '' }}"
                        style="height: 50px;" name="type_paiement">
                        <option value="">Choisir le type de paiement</option>
                        <option value="momo">MoMo</option>
                        <option value="carte_bancaire">Carte Bancaire</option>
                        <option value="paypal">PayPal</option>
                    </select>
                    {!! $errors->first('type_paiement', '<p class="text-danger">:message</p>') !!}
                </div>

                <div class="modal-footer float-right">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
                </div>
            </form>
       </div>
    </div>
</div>
