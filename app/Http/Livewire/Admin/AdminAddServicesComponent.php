<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Support\STR;
use Carbon\Carbon;
use Livewire\WithFileUploads;


class AdminAddServicesComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $tagline;
    public $service_category_id;
    public $price;
    public $discount;
    public $discount_type;
    public $image;
    public $thumbnail;
    public $description;
    public $inclusion;
    public $exclusion;

    public function generateSlug(){
        $this->slug = STR::slug($this->name,'-');
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'service_category_id' => 'required',
            'price' => 'required',
            'image' => 'required|mimes::jpeg,png',
            'thumbnail' => 'required|mimes::jpeg,png',
            'description' => 'required',
            'inclusion' => 'required',
        ]);
    }

    public function createService(){
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'service_category_id' => 'required',
            'price' => 'required',
            'image' => 'required|mimes::jpeg,png',
            'thumbnail' => 'required|mimes::jpeg,png',
            'description' => 'required',
            'inclusion' => 'required',
        ]);
        $service = new Service();
        $service->name = $this->name;
        $service->slug = $this->slug;
        $service->tagline = $this->tagline;
        $service->service_category_id = $this->service_category_id;
        $service->price = $this->price;
        $service->discount = $this->discount;
        $service->discount_type = $this->discount_type;
        $imageName = Carbon::now()->timestamp. '.' .$this->image->extension();
        $this->image->storeAS('services',$imageName);
        $service->image = $imageName;
        $thumbnailName = Carbon::now()->timestamp. '.' .$this->thumbnail->extension();
        $this->thumbnail->storeAS('services/thumbnails',$thumbnailName);
        $service->thumbnail = $thumbnailName;
        $service->description = $this->price;
        $service->inclusion = str_replace("\n",'|',trim($this->inclusion));
        $service->exclusion = str_replace("\n",'|',trim($this->exclusion));


        $service->save();
        session()->flash('message',"Service has been created successfully!");
    }

    public function render()
    {
        $categories = ServiceCategory::all();
        return view('livewire.admin.admin-add-services-component',['categories'=>$categories])->layout('layouts.base');
    }
}
