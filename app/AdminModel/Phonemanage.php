<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Phonemanage extends Model
{
    use Notifiable;
    //
    protected $guarded=['id'];
    public function setPhonenoAttribute($phoneno)
    {
        $this->attributes['phoneno']=encrypt($phoneno);
    }
}
