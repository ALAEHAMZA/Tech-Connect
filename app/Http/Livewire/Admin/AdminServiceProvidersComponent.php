<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ServiceProvider;
use Livewire\WithPagination;

class AdminServiceProvidersComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $sproviders = ServiceProvider::paginate(12);
        return view('livewire.admin.admin-service-providers-component',['sproviders'=>$sproviders])->layout('layouts.base');
    }
}
