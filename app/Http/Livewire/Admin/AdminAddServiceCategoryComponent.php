<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\STR;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use Livewire\WithFileUploads;


class AdminAddServiceCategoryComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $image;

    public function generateSlug(){
        $this->slug = STR::slug($this->name,'-');
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|mimes::jpeg,png',
        ]);
    }

    public function createNewCategory(){
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|mimes::jpeg,png',
        ]);
        $scategory = new ServiceCategory();
        $scategory->name = $this->name;
        $scategory->slug = $this->slug;
        $imageName = Carbon::now()->timestamp. '.' .$this->image->extension();
        $this->image->storeAS('categories',$imageName);
        $scategory->image = $imageName;
        $scategory->save();
        session()->flash('message',"Category has been created successfully!");
    }

    public function render()
    {
        return view('livewire.admin.admin-add-service-category-component')->layout('layouts.base');
    }
}
