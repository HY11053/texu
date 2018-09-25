<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;

class Weachtopenid extends Model
{
    protected $fillable=['openid','subscribe','nickname','sex','language','city','province','country','headimgurl','subscribe_time','remark','groupid'];
}
