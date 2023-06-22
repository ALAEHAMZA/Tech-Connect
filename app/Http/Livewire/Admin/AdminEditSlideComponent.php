<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Slider;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class AdminEditSlideComponent extends Component
{
    use WithFileUploads;
    public $slide_id;

    public $title;
    public $image;
    public $status=0;

    public $newImage;

    public function mount($slide_id){
        $slide = Slider::find($slide_id);
        $this->slid_id = $slide->id;
        $this->title = $slide->title;
        $this->image = $slide->image;
        $this->status = $slide->status;
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'title' => 'required',
        ]);
        if ($this->newImage) {
            $this->validateOnly($fields,[
                'newImage' => 'required|mimes::jpg,png',
            ]);
        };
    }

    public function updateSlide(){
        $this->validate([
            'title' => 'required',
        ]);
        if ($this->newImage) {
            $this->validate([
                'newImage' => 'required|mimes::jpg,png',
            ]);
        };
        $slide = Slider::find($this->slide_id);
        $slide->title = $this->title;

        if ($this->newImage) {
            unlink('images/slider'.'/'.$slide->image);
            $imageName = Carbon::now()->timestamp. '.' .$this->newImage->extension();
            $this->newImage->storeAS('slider',$imageName);
            $slide->image = $imageName;
        }
        $slide->status = $this->status;
        $slide->save();
        session()->flash('message',"Slide has been updated successfully!");
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-slide-component')->layout('layouts.base');
    }
}
