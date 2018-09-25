<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Phonemanage extends Model
{
    use Notifiable;
    //
    protected $fillable=['phoneno','name','gender','address','ip','note','host','referer'];
}
