<?php

namespace App\Http\Controllers\Admin;

use App\AdminModel\Archive;
use App\AdminModel\Brandarticle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }
    public function Index(){
        $archiveUsers=array_unique(Archive::where('created_at','>',Carbon::today())->where('created_at','<',Carbon::now())->pluck('write')->toArray());
        $brandUsers=array_unique(Brandarticle::where('created_at','>',Carbon::today())->where('created_at','<',Carbon::now())->pluck('write')->toArray());
        $articleUsers=array_unique(array_merge($archiveUsers,$brandUsers));
        if (count($archiveUsers)>4)
        {
            $articleUsers=array_random($archiveUsers,4);
        }
        $colorStyle=['aqua','green','blue','red','yellow'];
        $newArticles=Archive::take(6)->orderByDesc('id')->get();
        $labelStyle=['label-danger','label-info','label-warning','label-success','label-primary','label-default'];
        return view('admin.admin_index',compact('articleUsers','colorStyle','newArticles','labelStyle'));
    }
}
