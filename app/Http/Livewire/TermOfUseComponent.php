<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TermOfUseComponent extends Component
{
    public function render()
    {
        return view('livewire.term-of-use-component')->layout('layouts.base');
    }
}
