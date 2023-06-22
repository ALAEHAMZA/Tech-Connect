<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Slider;
use Illuminate\Support\STR;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class AdminAddSlideComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $image;
    public $status=0;

    public function updated($fields){
        $this->validateOnly($fields,[
            'title' => 'required',
            'image' => 'required|mimes::jpeg,png,jpg',
        ]);
    }

    public function addNewSlide(){
        $this->validate([
            'title' => 'required',
            'image' => 'required|mimes::jpeg,png,jpg',
        ]);
        $slide = new Slider();
        $slide->title = $this->title;
        $imageName = Carbon::now()->timestamp. '.' .$this->image->extension();
        $this->image->storeAS('slider',$imageName);
        $slide->image = $imageName;
        $slide->status = $this->status;
        $slide->save();
        session()->flash('message',"Slide has been created successfully!");
    }

    public function render()
    {
        return view('livewire.admin.admin-add-slide-component')->layout('layouts.base');
    }
}
