<?php

namespace App\Http\Livewire\Sprovider;

use Livewire\Component;
use App\Models\Request;
use App\Models\ServiceProvider;

class SproviderRequestComponent extends Component
{
    public $user_id;
    public $sprovider_id;
    public $request_id;

    public function mount($user_id){
        $this->user_id = $user_id;
    }

    public function acceptRequest(){
        $request = Request::find($this->request_id);
        $request->status = 'Accepted';
        $request->save();
        session()->flash('message','Request has been accepted successfully');
    }

    public function refuseRequest(){
        $request = Request::find($this->request_id);
        $request->status = 'Refused';
        $request->save();
        session()->flash('message','Request has been refused successfully');
    }

    public function render()
    {   $sprovider = ServiceProvider::where('user_id',$this->user_id)->first();
        $requests = Request::where('service_provider_id',$sprovider->id)->get();
        return view('livewire.sprovider.sprovider-request-component',['requests'=>$requests])->layout('layouts.base');
    }
}
