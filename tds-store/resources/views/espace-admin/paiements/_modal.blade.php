<div class="modal fade" id="DetailsModalCommande" tabindex="-1" aria-labelledby="DetailsModalCommandeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Détails commande #<span id='id_com'></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="datatable1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; border: 1ps solid">
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td><span id='date_com'></span></td>
                        </tr>
                        <tr>
                            <td>status</td>
                            <td><span id='statut'></span></td>
                        </tr>

                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalModifiePaiement" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalModifiePaiement aria-hidden=" true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification paiement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_espace_admin_edit_paiement')}}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body" style="background-color:  #ffff;">
                    <div class="">
                        <input id="edit_id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" type="hidden" placeholder="" name="id">
                        <div class="form-group">
                            <label for="">Montant</label>
                            <input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="montant" id="edit_montant">
                            {!! $errors->first('montant', '<p class="text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <label for="">Date</label>
                            <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="date" id="edit_date">
                            {!! $errors->first('date', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            <label for="">Type_paiement</label>
                            <select class="custom-select {{ $errors->has('type_paiement') ? 'is-invalid' : '' }}" style="height: 50px;" name="type_paiement" id="">
                                <option value="">Choisir le type de paiement</option>
                                <option value="momo">MoMo</option>
                                <option value="carte_bancaire">Carte Bancaire</option>
                                <option value="paypal">PayPal</option>
                            </select>
                            {!! $errors->first('type_paiement', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="form-group">
                            <label for="">Id commande</label>
                            <select class="custom-select {{ $errors->has('commande_id') ? 'is-invalid' : '' }}" style="height: 50px;" name="commande_id" id="edit_cmde_id">
                                <option value="">Choisir une commande</option>
                                @foreach ($cmdes as $cmde)
                                    @if (exist_commande_paiement($cmde->id) != null)
                                        <option value="{{ $cmde->id }}">#{{ $cmde->id }}</option>
                                    @endif
                                @endforeach
                            </select>
                            {!! $errors->first('commande_id', '<p class="text-danger">:message</p>') !!}

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
