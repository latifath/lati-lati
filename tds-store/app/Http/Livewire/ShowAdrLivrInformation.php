<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowAdrLivrInformation extends Component
{
    public $check = -1 ;

    public function change(){
        $this->check = - $this->check ;
    }

    public function render()
    {
        return view('livewire.show-adr-livr-information');
    }
}
