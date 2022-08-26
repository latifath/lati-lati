<div class="form-group">
    <label for="">Nom</label>
    <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="nom" value="{{ old('nom') ?? $produit->nom }}">
    {!! $errors->first('nom', '<p class="text-danger">:message</p>') !!}
</div>
<div class="form-group">
    <label for="">Quantité</label>
    <input class="form-control {{ $errors->has('quantite') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="quantite" value="{{ old('quantite') ?? $produit->quantite}}">
    {!! $errors->first('quantie', '<p class="text-danger">:message</p>') !!}
</div>

<div class="form-group">
    <label for="">Prix</label>
    <input class="form-control {{ $errors->has('prix') ? 'is-invalid' : '' }}" style="height: 50px;" type="text" placeholder="" name="prix" value="{{ old('prix') ?? $produit->prix }}">
    {!! $errors->first('prix', '<p class="text-danger">:message</p>') !!}
</div>

 <div class=" form-group">
    <label for="">Catégorie</label>
    <select class="custom-select {{ $errors->has('categorie') ? 'is-invalid' : '' }}" style="height: 50px;" name="categorie"  >
        <option value="{{ old('categorie') ? old('categorie') : ($produit->sous_categorie->categorie->id ?? '') }}">{{ old('categorie') ? old('categorie') : ($produit->sous_categorie->categorie->nom ?? 'Choississez une catégorie') }}</option>
        @foreach ($categories as $item)
        <option value="{{ $item->id }}">{{ $item->nom }}</option>
        @endforeach
    </select>
    {!! $errors->first('categorie', '<p class="text-danger">:message</p>') !!}
</div>

<div class=" form-group">
    <label for="">Sous-Catégorie</label>
    <select class="custom-select {{ $errors->has('sous_categorie') ? 'is-invalid' : '' }}" style="height: 50px;" name="sous_categorie" >
        <option value="{{ old('sous_categorie') ? old('sous_categorie') : ($produit->sous_categorie->id ?? '') }}"> {{ old('sous_categorie') ? old('sous_categorie') : ($produit->sous_categorie->nom ?? 'Choississez une sous catégorie' ) }}</option>
        @foreach ($sous_categories as $item)
        <option value="{{ $item->id }}">{{ $item->nom }}</option>
        @endforeach
    </select>
    {!! $errors->first('sous_categorie', '<p class="text-danger">:message</p>') !!}
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="elm1 form-control {{ $errors->has('description') ? 'is-invalid' : '' }} " name="description">
        {!! old('description') ?? $produit->description !!}
    </textarea>
    {!! $errors->first('descriprion', '<p class="text-danger">:message</p>') !!}
</div>

<div class="float-right">
    <button type="submit" class="btn btn-primary">{{ $SubmitName }}</button>
</div>
