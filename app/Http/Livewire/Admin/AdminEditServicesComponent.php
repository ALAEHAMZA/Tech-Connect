<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Support\STR;
use Carbon\Carbon;
use Livewire\WithFileUploads;


class AdminEditServicesComponent extends Component
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

    public $newImage;
    public $newThumbnail;

    public $service_id;

    public $featured;

    public function generateSlug(){
        $this->slug = STR::slug($this->name,'-');
    }

    public function mount($service_slug){
        $service = Service::where('slug',$service_slug)->first();
        $this->service_id = $service->id;
        $this->name = $service->name;
        $this->slug = $service->slug;
        $this->tagline = $service->tagline;
        $this->service_category_id = $service->service_category_id;
        $this->price = $service->price;
        $this->discount = $service->discount;
        $this->discount_type = $service->discount_type;
        $this->featured = $service->featured;
        $this->image = $service->image;
        $this->thumbnail = $service->thumbnail;
        $this->description = $service->description;
        $this->inclusion = str_replace("\n",'|',trim($service->inclusion));
        $this->exclusion = str_replace("\n",'|',trim($service->exclusion));
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'service_category_id' => 'required',
            'price' => 'required',
            'image' => 'required|mimes::jpeg,png',
            'description' => 'required',
            'inclusion' => 'required',
        ]);
        if ($this->newThumbnail) {
            $this->validateOnly($fields,[
                'newThumbnail' => 'required|mimes::jpeg,png',
            ]);
        };
        if ($this->newImage) {
            $this->validateOnly($fields,[
                'newImage' => 'required|mimes::jpeg,png',
            ]);
        };
    }

    public function updateService(){
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'service_category_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'inclusion' => 'required',
        ]);
        if ($this->newThumbnail) {
            $this->validate([
                'newThumbnail' => 'required|mimes::jpeg,png',
            ]);
        };
        if ($this->newImage) {
            $this->validate([
                'newImage' => 'required|mimes::jpeg,png',
            ]);
        };
        $service = Service::find($this->service_id);
        $service->name = $this->name;
        $service->slug = $this->slug;
        $service->tagline = $this->tagline;
        $service->service_category_id = $this->service_category_id;
        $service->price = $this->price;
        $service->discount = $this->discount;
        $service->discount_type = $this->discount_type;
        $service->featured = $this->featured;

        if ($this->newImage) {
            unlink('images/services'.'/'.$services->image);
            $imageName = Carbon::now()->timestamp. '.' .$this->newImage->extension();
            $this->newImage->storeAS('services',$imageName);
            $service->newImage = $imageName;
        }
        if ($this->newThumbnail) {
            unlink('images/services/thumbnails'.'/'.$services->thumbnail);
            $thumbnailName = Carbon::now()->timestamp. '.' .$this->newThumbnail->extension();
            $this->newThumbnail->storeAS('services/thumbnails',$thumbnailName);
            $service->newThumbnail = $thumbnailName;
        }


        $service->description = $this->price;
        $service->inclusion = str_replace("\n",'|',trim($this->inclusion));
        $service->exclusion = str_replace("\n",'|',trim($this->exclusion));


        $service->save();
        session()->flash('message',"Service has been updated successfully!");
    }

    public function render()
    {
        $categories = ServiceCategory::all();
        return view('livewire.admin.admin-edit-services-component',['categories'=>$categories])->layout('layouts.base');
    }
}
