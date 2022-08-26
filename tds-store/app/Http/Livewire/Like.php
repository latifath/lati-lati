<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Like extends Component
{

    public function addLike(){
        auth()->user()->favoris()->toggle(1);
    }

    public function render()
    {
        return view('livewire.like');
    }
}
