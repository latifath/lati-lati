<?php

namespace App\Http\Livewire;

use App\Models\Produit;
use Livewire\Component;

class Search extends Component
{
    public string $query = '';

    public $produits = [];

    public Int $selectedIndex = 0;

    public function incrementIndex() {
        if($this->selectedIndex == count($this->produits) - 1){
            $this->selectedIndex = 0;
            return;
        }
        $this->selectedIndex++;
    }

    public function decrementIndex() {
        if ($this->selectedIndex == 0){
            $this->selectedIndex = (count($this->produits) - 1);
        }
        $this->selectedIndex--;
    }


    public function showproduit() {
        // dd($this->produits[$this->selectedIndex]['id']);
        if(count($this->produits) > 0){
            return redirect()->route('root_sitepublic_show_produit_par_sous_categorie', [one_categorie(one_sous_categorie($this->produits[$this->selectedIndex]['sous_categorie_id'])->categorie_id)->slug, one_sous_categorie($this->produits[$this->selectedIndex]['sous_categorie_id'])->slug,$this->produits[$this->selectedIndex]['slug']]);
        }
    }



    public function updatedQuery() {
        // stocker dans une variable et accepter le terme qui sont au tour du mot clé
        $words= '%' . $this->query . '%';
        // fin

        if (strlen($this->query) > 2) {
            $this->produits = Produit::where('nom', 'like', $words)
            ->orwhere('description', 'like', $words)
            ->get();
            // dd($this->produits);
        }
    }

    public function resetIndex() {
        $this->reset('selectedIndex');
    }

    public function render()
    {
        return view('livewire.search');
    }
}
