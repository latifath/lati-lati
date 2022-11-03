{{-- adresse facturation --}}
<div class="modal fade" id="ModalEditAdresseFacturation" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalEditAdresseFacturationTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification Adresse Facturation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('root_site_public_edit_adresse_facturation') }}" id="" method="POST">
                @csrf
                <div class="modal-body p-0" style="background-color: #ffff;">
                    <div class="">
                        <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" value="{{ adresseclient($commande->adresse_client_id)->id}}" type="hidden" placeholder="" name="id">
                        <div class="col-md-12 form-group">
                            <label>Nom</label>
                            <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" value="{{ adresseclient($commande->adresse_client_id)->nom}}" type="text" placeholder="" name="nom" >
                            {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Prénom</label>
                            <input class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}" value="{{ adresseclient($commande->adresse_client_id)->prenom }}" type="text" placeholder="" name="prenom">
                            {!! $errors->first('prenom', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label>E-mail</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{  adresseclient($commande->adresse_client_id)->email }}" type="text" placeholder="" name="email">
                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Téléphone</label>
                            <input id="phone1" type="tel"  class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" value="{{ adresseclient($commande->adresse_client_id)->telephone }}"  placeholder="" name="telephone">
                            {!! $errors->first('telephone', '<p class="text-danger">:message</p>') !!}
                        <div class="alert alert-info" style="display: none;"></div>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Pays</label>
                            <select class="custom-select {{ $errors->has('pays') ? 'is-invalid' : '' }}" name="pays">
                                <option  value="{{ adresseclient($commande->adresse_client_id)->pays ?? '' }} ">{{ adresseclient($commande->adresse_client_id)->pays ?? ''}}</option>
                                @foreach(countries() as $country)
                                    <option value="{{ $country->name}}">{{ $country->name}}</option>

                                @endforeach
                            </select>
                            {!! $errors->first('pays', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="col-md-12 form-group">
                            <label>Rue</label>
                            <input class="form-control {{ $errors->has('rue') ? 'is-invalid' : '' }}" value="{{ adresseclient($commande->adresse_client_id)->rue}}" type="text" placeholder="" name="rue">
                            {!! $errors->first('rue', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="col-md-12 form-group">
                            <label>Ville</label>
                            <input class="form-control {{ $errors->has('ville') ? 'is-invalid' : '' }}" value="{{ adresseclient($commande->adresse_client_id)->ville }}" type="text" placeholder="" name="ville">
                            {!! $errors->first('ville', '<p class="text-danger">:message</p>') !!}

                        </div>

                        <div class="col-md-12 form-group">
                            <label>Code postal</label>
                            <input class="form-control {{ $errors->has('code_postal') ? 'is-invalid' : '' }}" value="{{ adresseclient($commande->adresse_client_id)->code_postal }}" type="text" placeholder="" name="code_postal" >
                            {!! $errors->first('code_postal', '<p class="text-danger">:message</p>') !!}

                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="display:block;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-secondary float-right">Modifier</button>

                </div>
            </form>
       </div>
    </div>
</div>

{{-- adresse livraison --}}
<div class="modal fade" id="ModalEditAdresseLivraison" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalEditAdresseLivraisonTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel"> Modification Adresse de Livraison</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('root_site_public_edit_adresse_livraison') }}" id="" method="POST">
            <div class="modal-body p-0" style="background-color: #ffff;" >
                @csrf
                <div class="">
                    <input class="form-control" value="{{ adresselivraison($commande->adresse_livraison_id)->id}}" type="hidden" placeholder="" name="id" >

                    <div class="col-md-12 form-group">
                        <label>Nom</label>
                        <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" value="{{ adresselivraison($commande->adresse_livraison_id)->nom  }}" type="text" placeholder="" name="nom" >
                        {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}

                    </div>

                    <div class="col-md-12 form-group">
                        <label>Prénom</label>
                        <input class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}" value="{{ adresselivraison($commande->adresse_livraison_id)->prenom}}" type="text" placeholder="" name="prenom">
                        {!! $errors->first('prenom', '<p class="text-danger">:message</p>') !!}

                    </div>

                    <div class="col-md-12 form-group">
                        <label>E-mail</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"  value="{{  adresselivraison($commande->adresse_livraison_id)->email }}" type="text" placeholder="" name="email">
                        {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}

                    </div>

                    <div class="col-md-12 form-group">
                        <label>Téléphone</label>
                        <input id="phone1" type="tel"  class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" value="{{ adresselivraison($commande->adresse_livraison_id)->telephone }}"  placeholder="" name="telephone">
                        {!! $errors->first('telephone', '<p class="text-danger">:message</p>') !!}

                    <div class="alert alert-info" style="display: none;"></div>
                    </div>

                    <div class="col-md-12 form-group">
                        <label>Pays</label>
                        <select class="custom-select {{ $errors->has('pays') ? 'is-invalid' : '' }}" name="pays" >
                            <option value="{{ adresselivraison($commande->adresse_livraison_id)->pays ?? '' }} ">{{ adresselivraison($commande->adresse_livraison_id)->pays ?? ''}}</option>
                            @foreach(countries() as $country)
                                <option value="{{ $country->name }}">{{ $country->name }}</option>

                            @endforeach

                        </select>
                        {!! $errors->first('pays', '<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="col-md-12 form-group">
                        <label>Rue</label>
                        <input class="form-control {{ $errors->has('rue') ? 'is-invalid' : '' }}" value="{{ adresselivraison($commande->adresse_livraison_id)->rue }}" type="text" placeholder="" name="rue">
                        {!! $errors->first('rue', '<p class="text-danger">:message</p>') !!}

                    </div>

                    <div class="col-md-12 form-group">
                        <label>Ville</label>
                        <select class="custom-select {{ $errors->has('ville') ? 'is-invalid' : '' }}" style="height: 50px;" name="ville" id="ville1">
                            <option value="{{ adresselivraison($commande->adresse_livraison_id)->ville }}">{{ adresselivraison($commande->adresse_livraison_id)->ville }}</option>
                            @foreach(villes() as $ville)
                                <option value="{{ $ville->ville }}">{{ $ville->ville }}</option>
                            @endforeach
                            <option value="autres">Autres</option>
                        </select>
                        {!! $errors->first('ville', '<p class="text-danger">:message</p>') !!}
                        <br>
                        <div class="form-group ville2" style="display: none">
                            <label>Entrez votre ville</label>
                            <input class="form-control {{ $errors->has('ville2') ? 'is-invalid' : '' }}" type="text" style="height: 50px;" name="ville2">
                            {!! $errors->first('ville2', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-md-12 form-group">
                        <label>Code postal</label>
                        <input class="form-control {{ $errors->has('code_postal') ? 'is-invalid' : '' }}" value="{{ adresselivraison($commande->adresse_livraison_id)->code_postal }}" type="text" placeholder="" name="code_postal" >
                        {!! $errors->first('code_postal', '<p class="text-danger">:message</p>') !!}

                    </div>
                </div>

            </div>
            <div class="modal-footer" style="display:block;">
                <button type="reset" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-secondary float-right">Modifier</button>
            </div>
        </form>
    </div>
    </div>
</div>
