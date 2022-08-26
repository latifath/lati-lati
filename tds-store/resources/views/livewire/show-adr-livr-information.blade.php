<div class="mb-4 col-12">
    <fieldset class="border p-2 mr-auto ml-2" style="border-color: #212529!important;">
        <legend>
            <h4 class="font-weight-semi-bold mb-4">Adresse de livraison</h4>
        </legend>
        <div class="col-sm-offset-3 col-sm-9">
            <div class="form-check">
                <label class="form-check-label check-form-livraison" >
                    {{-- <input type="checkbox" class="form-check-input" value=""  onchange="valueChanged()">Adresse de livraison différente de adresse de facturation --}}
                    <input type="checkbox" class="form-check-input" value="" name="check" wire:click = change>Adresse de livraison différente de adresse de facturation
                </label>
            </div>
        </div>
        @if($check == 1)
        <div class="row form-livraison">
            <div class="col-md-6 form-group">
                <label>Nom</label>
                <input class="form-control {{ $errors->has('nomLivraison') ? 'is-invalid' : '' }}" style="height: 50px;"  type="text" placeholder="" name="nomLivraison" >
                {!! $errors->first('nomLivraison', '<p class="text-danger">:message</p>') !!}

           </div>

            <div class="col-md-6 form-group">
                <label>Prénom</label>
                <input class="form-control {{ $errors->has('prenomLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="prenomLivraison">
                {!! $errors->first('prenomLivraison', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="col-md-6 form-group">
                <label>E-mail</label>
                <input class="form-control {{ $errors->has('emailLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="emailLivraison">
                {!! $errors->first('emailLivraison', '<p class="text-danger">:message</p>') !!}
            </div>


            <div class="col-md-6 form-group">
                <label>Téléphone</label>
                <input id="phone2" type="tel" class="form-control {{ $errors->has('telephoneLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" placeholder="" name="telephoneLivraison">
                {!! $errors->first('telephoneLivraison', '<p class="text-danger">:message</p>') !!}
                <div class="alert alert-info" style="display: none;"></div>
            </div>

            <div class="col-md-6 form-group">
                <label>Pays</label>
                <select class="custom-select {{ $errors->has('paysLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" name="paysLivraison">
                    <option  value="{{ old('paysLivraison') ?? '' }}">{{ old('paysLivraison') ?? 'Choisissez le pays' }}</option>
                    @foreach(pays() as $item)
                        <option value="{{ $item->nom }}">{{ $item->nom }}</option>

                    @endforeach
                </select>
                {!! $errors->first('paysLivraison', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="col-md-6 form-group">
                <label>Rue</label>
                <input class="form-control {{ $errors->has('rueLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="Numero de la voie et nom de la rue" name="rueLivraison">
                {!! $errors->first('rueLivraison', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="col-md-6 form-group">
                <label>Ville</label>
                <input  style="border: 1px, solid" class="form-control {{ $errors->has('villeLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="villeLivraison">
                {!! $errors->first('villeLivraison', '<p class="text-danger">:message</p>') !!}
            </div>

            <div class="col-md-6 form-group">
                <label>Code postal</label>
                <input class="form-control {{ $errors->has('code_postalLivraison') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="123" name="code_postalLivraison" >
                {!! $errors->first('code_postalLivraison', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>


    @endif

    </fieldset>
</div>

