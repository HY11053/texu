<?php

namespace App\AdminModel;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Brandarticle extends Model
{
    protected $guarded = ['imagepic','xiongzhang','updatetime','image','indexlitpic'];

    public function setTitleAttribute($title)
    {
        //重复文档监测
        if(Brandarticle::where('title',$title)->where('created_at','>',Carbon::today())->value('id'))
        {
            exit('标题重复，禁止发布');
        }else{
            $this->attributes['title'] =$title;
        }
    }
    public function arctype()
    {
        return $this->belongsTo('App\AdminModel\Arctype','typeid');
    }
}
