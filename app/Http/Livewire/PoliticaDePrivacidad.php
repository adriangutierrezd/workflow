<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PoliticaDePrivacidad extends Component
{
    public function render()
    {
        return view('livewire.politica-de-privacidad')->layout('layouts.guest');
    }
}
