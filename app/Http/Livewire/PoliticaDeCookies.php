<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PoliticaDeCookies extends Component
{
    public function render()
    {
        return view('livewire.politica-de-cookies')->layout('layouts.guest');
    }
}
