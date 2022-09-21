<div class="inline-block relative " x-data="{ open: true}" >
    <form action="">
        <div class="input-group">
            <input @click.away="open = false; @this.resetIndex();" @click="open = true" type="text" class="form-control focus:outline-none " placeholder="Recherche" wire:model="query"
            wire:keydown.arrow-down.prevent="incrementIndex"
            wire:keydown.arrow-up.prevent="decrementIndex"
            wire:keydown.backspace="resetIndex"
            wire:keydown.enter.prevent="showproduit"
             style="border: 1px solid #EDF1FF !important">
            <div class="input-group-append" style="{{ couleur_background_1() }}">
                <span class="input-group-text bg-transparent text-primary pt-2">
                    <i class="fa fa-search" ></i>
                </span>
            </div>
        </div>
    </form>

    @if (strlen($query) > 2)
    <div class="col-12 border rounded bg-secondary text-md w-56 mt-1" style="z-index: 1; position: absolute; font-size:13px;"
     x-show="open">
        @if(count($produits) > 0)
        @foreach($produits as $index => $produit)
            <h4  class="{{ $index == $selectedIndex  ? 'text-success' : ''}} "> {{ $produit->nom }}</h4>
            <p class="{{ $index == $selectedIndex ? 'text-success' : '' }}"> {{ Str::substr($produit->description, 0, 100) }} {{ Str::length($produit->description) > 100 ? '...' : ''}} <span ></span></p>
        @endforeach
        @else
        <span class=" p-1 ">0 résultats pour "{{ $query }}"</span>
        @endif
    </div>
    @endif
</div>
{{-- <style>
@media(max-width:480px){  /* For mobile phones: */

  [class*="col-sm"] {

  }
}
</style> --}}
