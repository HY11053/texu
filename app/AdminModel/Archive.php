<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Archive extends Model
{
    protected $guarded = ['xiongzhang','image','updatetime'];
    protected $dates = ['published_at'];

    /**
     * 文档获取后时间格式转换
     * @param date     *
     * @return Carbon时间格式
     *    public function getPublishedAtAttribute($date)
    {

    if (Carbon::now() > Carbon::parse($date)->addDays(10))
    {
    return date('Y-m-d',strtotime($date));
    }

    return Carbon::parse($date)->diffForHumans();
    }
     */


    /**
     * 文档入库之前的时间格式转换
     * @param $date
     */
    public function setPublishedAtAttribute($date)
    {
        if(!empty($date) && strpos($date,':')==false)
        {
            $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d',$date);
        }else{
            $this->attributes['published_at'] =$date?$date : Carbon::now();
        }
    }

    public function scopePublished($query)
    {
        $query->where('published_at','<=',Carbon::now());
    }
    /**
     * Eloquent ORM 关联定义
     * @param
     *
     * @return arraydatas
     */
    public function arctype()
    {
        return $this->belongsTo('App\AdminModel\Arctype','typeid');
    }
    public function article()
    {
        return $this->hasOne('App\AdminModel\Addonarticle','id');
    }
    protected function comments()
    {
        return $this->hasMany('App\AdminModel\Comments','id');
    }
}
