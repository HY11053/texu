<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $fillable=[
      'id','mid','typeid','brandid','ismake','title','bdname','litpic','price','flags','click','pdintr','keywords','description','productionname','imagepics','body','created_at','updated_at','write','dutyadmin','nid'
    ];
    public function arctype()
    {
        return $this->belongsTo('App\AdminModel\Arctype','typeid');
    }
    public function brandinfo()
    {
        return $this->belongsTo('App\AdminModel\Brandarticle','brandid');
    }
}
