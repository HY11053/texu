<?php

namespace App\AdminModel;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Brandarticle extends Model
{
    protected $guarded = ['imagepic','xiongzhang','updatetime','image','indexlitpic'];
    public function arctype()
    {
        return $this->belongsTo('App\AdminModel\Arctype','typeid');
    }
}
