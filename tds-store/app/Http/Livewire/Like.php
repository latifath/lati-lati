<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Like extends Component
{
    public $produit;

    public function addLike(){
        if (auth()->check()) {
            auth()->user()->likes()->toggle($this->produit->id);
        }
    }

    public function render()
    {
        return view('livewire.like');
    }
}
