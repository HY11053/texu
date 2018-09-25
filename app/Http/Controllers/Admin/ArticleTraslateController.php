<?php

namespace App\Http\Controllers\Admin;
use App\AdminModel\Archive;
use App\AdminModel\Arctype;
use App\AdminModel\Area;
use App\AdminModel\Brandarticle;
use App\AdminModel\Production;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleTraslateController extends Controller
{

    public function getArticles()
    {
        //$articles=DB::connection('51xxsp')->select('SELECT * FROM is_news  WHERE nid>? ',[0]);
        $articles=DB::connection('xiuxianshipin')->select('SELECT * FROM is_news  WHERE nid> ?',[0]);
        foreach ($articles as $article)
        {
            $inserarticle=[];
            $inserarticle['id']=$article->nid;
            $inserarticle['typeid']=$article->nsort_id?:5;
            $inserarticle['brandid']=$article->npro_id;
            $inserarticle['title']=$article->nname;
            $inserarticle['litpic']=$article->ncover;
            $inserarticle['tags']=$article->ntag;
            $inserarticle['keywords']=$article->nkeys;
            $inserarticle['description']=$article->ndes;
            $inserarticle['body']=$article->ncontent;
            $inserarticle['click']=$article->ncount;
            $inserarticle['flags']=$article->ncommend?'c':'';
            $inserarticle['flags'].=$article->npoint?'a':'';
            $inserarticle['flags'].=$article->nheadline?'h':'';
            $inserarticle['ismake']=$article->checked;
            $inserarticle['mid']=0;
            $inserarticle['write']='梁李良';
            $inserarticle['dutyadmin']=1;
            $inserarticle['shorttitle']=$article->nname;
            $inserarticle['created_at']=Carbon::createFromTimestamp($article->ntime,'PRC');;
            $inserarticle['updated_at']=$inserarticle['created_at'];
            $inserarticle['published_at']=$inserarticle['created_at'];
            Archive::create($inserarticle);
        }
        echo '导入成功！';
    }

    public function getBrandArticles()
    {
        //$articles=DB::connection('51xxsp')->select('SELECT * FROM is_news  WHERE nid>? ',[0]);
        $articles=DB::connection('xiuxianshipin')->select('SELECT * FROM is_project  WHERE pid>?',[0]);
        //dd($articles);
        foreach ($articles as $article)
        {
            $inserarticle=[];
            $inserarticle['id']=$article->pid;
            $inserarticle['typeid']=DB::connection('xiuxianshipin')->select('SELECT bsid FROM is_project_to_sort  WHERE bpid=?',[$article->pid])[0]->bsid;
            //$inserarticle['brandid']=$article->npro_id;
            $inserarticle['brandname']=$article->pname;
            $inserarticle['tags']=$article->ptag;
            $inserarticle['title']=$article->pname.'加盟_'.$article->pname.'加盟费用_'.$article->pname.'代理批发';
            $inserarticle['keywords']=$article->pkeys;
            $inserarticle['description']=$article->pdes;
            $inserarticle['ismake']=$article->checked;
            $inserarticle['body']=$article->pinfo;
            $inserarticle['ppjs_content']=$article->pcom_intr;
            $inserarticle['jmxq_content']=$article->pjoin;
            $inserarticle['lrfx_content']=$article->profit;
            $inserarticle['brandgroup']=$article->pcom_name;
            $inserarticle['brandphone']=$article->pcom_tel;
            $inserarticle['brandaddr']=$article->pcom_addr;
            $inserarticle['imagepic']=\GuzzleHttp\json_decode($article->pics);
            $inserarticle['imagepics']='';
            for ($j=0;$j<count($inserarticle['imagepic']);$j++)
            {
                $inserarticle['imagepics'].=$inserarticle['imagepic'][$j].',';
            }
            $inserarticle['imagepics']=substr($inserarticle['imagepics'],0,-1);
            $inserarticle['litpic']=$article->pcover;
            $inserarticle['brandpsp']=str_limit($article->psp,300,'');
            $inserarticle['country']=$article->pcity;
            if ($article->plevel==1){
                $brandpay='3万以下';
            }elseif ($article->plevel==2)
            {
                $brandpay='3万~5万';

            }elseif ($article->plevel==3){
                $brandpay='5万~8万';
            }elseif ($article->plevel==4){
                $brandpay='8万~12万';
            }elseif ($article->plevel==5){
                $brandpay='12万~15万';
            }elseif ($article->plevel==6){
                $brandpay='15万以上';
            }
            $inserarticle['brandpay']=$brandpay;
            $inserarticle['click']=$article->pcount;
            $inserarticle['flags']=$article->pcommend?'c':'';
            $inserarticle['flags'].=$article->ppoint?'a':'';
            $inserarticle['flags'].=$article->pheadline?'h':'';
            $inserarticle['flags'].=$article->ptopten?'s':'';
            $inserarticle['mid']=1;
            $inserarticle['write']='梁李良';
            $inserarticle['dutyadmin']=1;
            $inserarticle['shorttitle']=$inserarticle['brandname'];
            $inserarticle['created_at']=Carbon::createFromTimestamp($article->padd_time,'PRC');;
            $inserarticle['updated_at']=$inserarticle['created_at'];
            $inserarticle['published_at']=$inserarticle['created_at'];
            //dd($inserarticle);
            Brandarticle::create($inserarticle);
            //Archive::create($inserarticle);
            //Addonarticle::create($inserarticle);
        }
        Brandarticle::where('typeid',10)->update(['typeid'=>16]);
        Brandarticle::where('typeid',9)->update(['typeid'=>15]);
        Brandarticle::where('typeid',8)->update(['typeid'=>14]);
        Brandarticle::where('typeid',7)->update(['typeid'=>13]);
        Brandarticle::where('typeid',6)->update(['typeid'=>12]);
        Brandarticle::where('typeid',5)->update(['typeid'=>11]);
        Brandarticle::where('typeid',4)->update(['typeid'=>10]);
        Brandarticle::where('typeid',3)->update(['typeid'=>9]);
        Brandarticle::where('typeid',2)->update(['typeid'=>8]);
        Brandarticle::where('typeid',1)->update(['typeid'=>7]);
    }

    public function getarctypes()
    {
        $arctypes=DB::connection('xiuxianshipin')->select('SELECT * FROM is_product_sort  WHERE sid>?',[0]);
        foreach ($arctypes as $arctype)
        {
            $insertarctypes=[];
            $insertarctypes['typename']=$arctype->sname;
            $insertarctypes['title']=$arctype->saka;
            $insertarctypes['keywords']=$arctype->skey;
            $insertarctypes['description']=$arctype->sdes;
            $insertarctypes['reid']=$arctype->parent_id;
            $insertarctypes['topid']=17;
            $insertarctypes['typedir']=$arctype->short.'_'.$arctype->sid;
            $insertarctypes['real_path']=$arctype->short.'_'.$arctype->sid;
            $insertarctypes['mid']=2;
            $insertarctypes['is_write']=1;
            $insertarctypes['dirposition']=1;
            $insertarctypes['updated_at']=Carbon::now();
            $insertarctypes['created_at']=Carbon::now();
            Arctype::create($insertarctypes);
        }
        echo '导入成功';

    }
    //栏目导入
    public function getProductions()
    {

        $articles=DB::connection('xiuxianshipin')->select('SELECT * FROM is_product  WHERE pdid>?',[0]);
       foreach ($articles as $article)
       {
           $inserarticle=[];
           $inserarticle['id']=$article->pdid;
           $inserarticle['brandid']=$article->pid;
           $inserarticle['typeid']=DB::connection('xiuxianshipin')->select('SELECT sid FROM is_product_to_sort  WHERE pdid=?',[$article->pdid])[0]->sid;
           $inserarticle['mid']=2;
           $inserarticle['ismake']=$article->checked;
           $inserarticle['productionname']=$article->pdname;
           $inserarticle['litpic']=$article->pdcover;
           $inserarticle['price']=$article->pdprice;
           $inserarticle['flags']=$article->pdcommend?'p':''.$article->pdpoint?'a':''.$article->pdheadline?'h':'';
           $inserarticle['click']=$article->pdcount;
           $inserarticle['pdintr']=str_limit($article->pdintr,300,'');
           $inserarticle['body']=$article->pdinfo;
           $inserarticle['write']='梁李良';
           $inserarticle['dutyadmin']=1;
           $inserarticle['keywords']=unserialize($article->pdseo)['key'];
           $inserarticle['title']=unserialize($article->pdseo)['aka'];
           $inserarticle['description']=unserialize($article->pdseo)['des'];
           $inserarticle['created_at']=Carbon::createFromTimestamp($article->pdtime,'PRC');
           $inserarticle['updated_at']=Carbon::createFromTimestamp($article->pdtime,'PRC');
           //dd($inserarticle);
           Production::create($inserarticle);

       }
            Production::where('typeid',58)->update(['typeid'=>68]);
            Production::where('typeid',56)->update(['typeid'=>67]);
            Production::where('typeid',55)->update(['typeid'=>66]);
            Production::where('typeid',54)->update(['typeid'=>65]);
            Production::where('typeid',53)->update(['typeid'=>64]);
            Production::where('typeid',52)->update(['typeid'=>63]);
            Production::where('typeid',51)->update(['typeid'=>62]);
            Production::where('typeid',50)->update(['typeid'=>61]);
            Production::where('typeid',49)->update(['typeid'=>60]);
            Production::where('typeid',48)->update(['typeid'=>59]);
            Production::where('typeid',47)->update(['typeid'=>58]);
            Production::where('typeid',46)->update(['typeid'=>57]);
            Production::where('typeid',45)->update(['typeid'=>56]);
            Production::where('typeid',44)->update(['typeid'=>55]);
            Production::where('typeid',43)->update(['typeid'=>54]);
            Production::where('typeid',42)->update(['typeid'=>53]);
            Production::where('typeid',41)->update(['typeid'=>52]);
            Production::where('typeid',40)->update(['typeid'=>51]);
            Production::where('typeid',39)->update(['typeid'=>50]);
            Production::where('typeid',38)->update(['typeid'=>49]);
            Production::where('typeid',37)->update(['typeid'=>48]);
            Production::where('typeid',36)->update(['typeid'=>48]);
            Production::where('typeid',35)->update(['typeid'=>46]);
            Production::where('typeid',34)->update(['typeid'=>30]);
            Production::where('typeid',33)->update(['typeid'=>31]);
            Production::where('typeid',31)->update(['typeid'=>33]);
            Production::where('typeid',30)->update(['typeid'=>34]);
            Production::where('typeid',29)->update(['typeid'=>45]);
            Production::where('typeid',28)->update(['typeid'=>44]);
            Production::where('typeid',27)->update(['typeid'=>43]);
            Production::where('typeid',26)->update(['typeid'=>42]);
            Production::where('typeid',25)->update(['typeid'=>41]);
            Production::where('typeid',24)->update(['typeid'=>40]);
            Production::where('typeid',23)->update(['typeid'=>39]);
            Production::where('typeid',22)->update(['typeid'=>38]);
            Production::where('typeid',21)->update(['typeid'=>37]);
            Production::where('typeid',20)->update(['typeid'=>36]);
            Production::where('typeid',19)->update(['typeid'=>35]);
            Production::where('typeid',17)->update(['typeid'=>26]);
            Production::where('typeid',11)->update(['typeid'=>29]);
            Production::where('typeid',10)->update(['typeid'=>28]);
            Production::where('typeid',9)->update(['typeid'=>27]);
            Production::where('typeid',8)->update(['typeid'=>25]);
            Production::where('typeid',7)->update(['typeid'=>24]);
            Production::where('typeid',6)->update(['typeid'=>23]);
            Production::where('typeid',5)->update(['typeid'=>22]);
            Production::where('typeid',4)->update(['typeid'=>21]);
            Production::where('typeid',3)->update(['typeid'=>20]);
            Production::where('typeid',2)->update(['typeid'=>19]);
            Production::where('typeid',1)->update(['typeid'=>18]);

        $pids=Production::where('title','')->pluck('id');
        foreach ($pids as $pid)
        {
            Production::where('id',$pid)->update(['title'=>Brandarticle::where('id',Production::where('id',$pid)->value('brandid'))->value('brandname').Production::where('id',$pid)->value('productionname').'【进货 批发 加盟】']);

        }
        $kids=Production::where('keywords','')->pluck('id');
        foreach ($kids as $kid)
        {
            Production::where('id',$kid)->update(['keywords'=>str_limit(Production::where('id',$kid)->value('productionname').'批发,'.Production::where('id',$kid)->value('productionname').'加盟,',300,'')]);

        }
        $dids=Production::where('description','')->pluck('id');
        foreach ($dids as $did)
        {
            Production::where('id',$did)->update(['description'=>str_limit(mb_substr(strip_tags(str_replace(PHP_EOL,'',Production::where('id',$did)->value('body'))),0,210,'utf-8'),200,'')]);
        }
    }

    public function AreaTranslate()
    {

        $brands=Brandarticle::where('id','>',0)->pluck('id');
        foreach ($brands as $brand)
        {
            Brandarticle::where('id',$brand)->update(['country'=>Area::where('id',Brandarticle::where('id',$brand)->value('country'))->value('regionname')]);
        }

    }
}
