<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Slider;
use Livewire\WithPagination;

class AdminSliderComponent extends Component
{
    use WithPagination;

    public function deleteSlide($slide_id){
        $slide = Slider::find($slide_id);
        if ($slide->image) {
            unlink('images/slider'.'/'.$slide->image);
        }
        $slide->delete();
        session()->flash('message',"Service has been deleted successfully!");
    }

    public function render()
    {
        $slides = Slider::paginate(10);
        return view('livewire.admin.admin-slider-component',['slides'=> $slides])->layout('layouts.base');
    }
}
