<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Request;

class CustomerRequestComponent extends Component
{

    public $user_id;

    public function mount($user_id){
        $this->user_id = $user_id;
    }

    public function render()
    {
        $requests = Request::where('user_id',$this->user_id)->get();
        return view('livewire.customer.customer-request-component',['requests'=>$requests])->layout('layouts.base');
    }
}
