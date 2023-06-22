<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\STR;
use App\Models\ServiceCategory;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class AdminEditServiceCategoryComponent extends Component
{
    use WithFileUploads;

    public $category_id;
    public $name;
    public $slug;
    public $image;
    public $newImage;

    public $featured;


    public function mount($category_id){
        $scategory = ServiceCategory::find($category_id);
        $this->name = $scategory->name;
        $this->slug = $scategory->slug;
        $this->image = $scategory->image;
        $this->featured = $scategory->featured;
    }

    public function generateSlug(){
        $this->slug = STR::slug($this->name,'-');
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required',
        ]);
        if ($this->newImage) {
            $this->validateOnly($fields,[
                'newImage' => 'required|mimes::jpeg,png',
            ]);
        }
    }

    public function updateServiceCategory(){
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        if ($this->newImage) {
            $this->validate([
                'newImage' => 'required|mimes::jpeg,png',
            ]);
        }
        $scategory = ServiceCategory::find($this->category_id);
        $scategory->name = $this->name;
        $scategory->slug = $this->slug;
        if ($this->newImage) {
            $imageName = Carbon::now()->timestamp. '.' .$this->newImage->extension();
            $this->newImage->storeAS('categories',$imageName);
            $scategory->image = $imageName;
        }
        $scategory->featured = $this->featured;
        $scategory->save();
        session()->flash('message',"Category has been updated successfully!");
    }


    public function render()
    {
        return view('livewire.admin.admin-edit-service-category-component')->layout('layouts.base');
    }
}
