<div class="form-group">
    <label for="">Nom</label>
    <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="nom" value="{{ old('nom') ?? $produit->nom }}">
    {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
</div>
<div class="form-group">
    <label for="">Quantité</label>
    <input class="form-control {{ $errors->has('quantite') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="quantite" value="{{ old('quantite') ?? $produit->quantite}}">
    {!! $errors->first('quantite', '<p class="text-danger">:message</p>') !!}
</div>

<div class="form-group">
    <label for="">Prix</label>
    <input class="form-control {{ $errors->has('prix') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="prix" value="{{ old('prix') ?? $produit->prix }}">
    {!! $errors->first('prix', '<p class="text-danger">:message</p>') !!}
</div>

<div class=" form-group">
    <label for="">Sous-Catégorie</label>
    <select class="custom-select {{ $errors->has('sous_categorie') ? 'is-invalid' : '' }}" name="sous_categorie" style="height: 50px; border:">
        <option value="{{ old('sous_categorie') ? old('sous_categorie') : ($produit->sous_categorie->id ?? '') }}"> {{ old('sous_categorie') ? old('sous_categorie') : ($produit->sous_categorie->nom ?? 'Choississez une sous catégorie' ) }}</option>
        @foreach ($categories as $item)
        @if (all_sub_categorie_by_category($item->id)->count() > 0)
            <optgroup label="{{ $item->nom }}">
                @foreach (all_sub_categorie_by_category($item->id) as $valeur )
                <option value="{{ $valeur->id }}">{{ $valeur->nom }}</option>
                @endforeach
            </optgroup>
        @endif
        @endforeach
    </select>
    {!! $errors->first('sous_categorie', '<p class="text-danger">:message</p>') !!}
</div>

@if($SubmitName  == 'Modifier')

@else
<div class="form-group">
    <label for="">Image</label>
    <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" style="height: 50px;" type="file" placeholder="" name="image" value="{{ old('image') ?? $produit->image}}">
    {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}
</div>
@endif

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="elm1 form-control {{ $errors->has('description') ? 'is-invalid' : '' }} " name="description">
        {!! old('description') ?? $produit->description !!}
    </textarea>
    {!! $errors->first('description', '<p class="text-danger">:message</p>') !!}
</div>

<div class="float-right">
    <button type="submit" class="btn btn-primary">{{ $SubmitName }}</button>
</div>
