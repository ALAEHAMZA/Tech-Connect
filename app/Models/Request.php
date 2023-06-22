<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function sprovider(){
        return $this->belongsTo(ServiceProvider::class,'service_provider_id');
    }

    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
}
