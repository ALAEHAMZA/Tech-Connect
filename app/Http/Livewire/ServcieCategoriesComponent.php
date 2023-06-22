<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ServiceCategory;

class ServcieCategoriesComponent extends Component
{
    public function render()
    {
        $scategories = ServiceCategory::all();
        return view('livewire.servcie-categories-component',['scategories'=>$scategories])->layout('layouts.base');
    }
}
