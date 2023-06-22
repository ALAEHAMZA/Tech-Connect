<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Auth;
use App\Models\ServiceProvider;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Request;


class ChooseServiceProviderComponent extends Component
{
    public $service_id;

    public function mount($service_id){
        $this->service_id = $service_id;
    }

    public function sendRequest($user_id , $sprovider_id){
        $request = new Request();
        $request->user_id = $user_id;
        $request->service_provider_id = $sprovider_id;
        $request->service_id = $this->service_id;
        $request->status = 'Waiting';
        $request->save();
        session()->flash('message','Request has been sended');
    }

    public function render()
    {
        $service = Service::where('id',$this->service_id)->first();
        $sproviders = ServiceProvider::where('service_category_id',$service->id)->get();
        return view('livewire.choose-service-provider-component',['sproviders'=>$sproviders])->layout('layouts.base');
    }
}
