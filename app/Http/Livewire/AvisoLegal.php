<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AvisoLegal extends Component
{
    public function render()
    {
        return view('livewire.aviso-legal')->layout('layouts.guest');
    }
}
