<?php

namespace App\Http\Controllers\Admin;

use App\AdminModel\Archive;
use App\AdminModel\Area;
use App\AdminModel\Brandarticle;
use App\AdminModel\Production;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class CheckToolsController extends Controller
{
    public function cheakUrls()
    {
        $archives=Archive::where('ismake',1)->get();
        foreach ($archives as $archive)
        {
            echo str_replace('www.','mip.',config('app.url')).'/index.php/news/'.$archive->id.'/'.'<br/>';
        }

    }
    public function checkarticles()
    {
        $ids=Archive::pluck('id');
        foreach ($ids as $id)
        {
            $thisarticle=Archive::find($id);
            Archive::where('id',$id)->update(['keywords'=>$thisarticle->title,'description'=>str_limit(str_replace(['&nbsp;',' ','　',PHP_EOL,'\t'],'',strip_tags(htmlspecialchars_decode($thisarticle->body))), $limit = 240, $end = '')]);
        }
        $bids=Brandarticle::pluck('id');
        foreach ($bids as $bid)
        {
            $thisarticle=Brandarticle::find($bid);
            Brandarticle::where('id',$bid)->update(['keywords'=>$thisarticle->title,'description'=>str_limit(str_replace(['&nbsp;',' ','　',PHP_EOL,'\t'],'',strip_tags(htmlspecialchars_decode($thisarticle->body))), $limit = 240, $end = '')]);
        }
        $pids=Production::pluck('id');
        foreach ($pids as $pid)
        {
            $thisarticle=Production::find($pid);
            Production::where('id',$pid)->update(['keywords'=>$thisarticle->title,'description'=>str_limit(str_replace(['&nbsp;',' ','　',PHP_EOL,'\t'],'',strip_tags(htmlspecialchars_decode($thisarticle->body))), $limit = 240, $end = '')]);
        }
    }

    public function checkbrandsurls()
    {
        $brandurls=Brandarticle::where('ismake',1)->get();
        foreach ($brandurls as $archive)
        {
            echo str_replace('www.','mip.',config('app.url')).'/index.php/brand/'.$archive->id.'/'.'<br/>';
        }
    }

    public function checkaskurls()
    {
        $asks=Ask::where('is_hidden',1)->get();
        foreach ($asks as $archive)
        {
            echo str_replace('www.','mip.',config('app.url')).'/wenda/'.$archive->id.'/'.'<br/>';
        }
    }
    public function updateBrands()
    {
        set_time_limit(0);
        $brandtime=[1999,2000,2001,2002,2003,2004,2005,2006,2007,2008,2009,2010,2011,2012,2013,2014,2015,2016,2017];
        $genre=['民营企业','私企','个体经营'];
        $brandduty=['需要授权','不限'];
        $registeredcapital=['2000万','500万','1500万','150万'];
        $brandarticles=Brandarticle::all();
        foreach ($brandarticles as $brandarticle) {
            $insertbrandtime = $brandtime[array_rand($brandtime, 1)];
            $brandorigin = $brandarticle->country;
            $brandnum = rand(500, 3600);
            $brandarea = Area::where('type', 2)->inRandomOrder()->take(5)->pluck('regionname')->toArray();
            $insertbrandarea = $this->randArrays($brandarea,5);
            if ($brandarticle->typeid > 7) {
                $brandmap = ["餐饮", '小吃', '中式餐饮', '西式餐饮', '凉菜制作', '烧烤熟肉'];
            } else {
                $brandmap = ["板栗", '炒货', '凉果蜜饯', '肉制品', '零食', '坚果', '饮料', '夏威夷果', '预包装食品', '散装食品', '乳制品'];
            }
            $insertbrandmap=$this->randArrays($brandmap,4,'，');
            $brandperson=['二次创业','工薪阶层','下岗工人','大学生','80后','白领','自由职业者'];
            $insertbrandperson=$this->randArrays($brandperson,4);
            $brandchat=rand(2000,5000);
            $brandattch=rand(1000,2000);
            $brandapply=rand(500,900);
            $insertgenre=$genre[array_rand($genre, 1)];
            $insertbrandduty=$brandduty[array_rand($brandduty, 1)];
            $insertregisteredcapital=$registeredcapital[array_rand($registeredcapital, 1)];
            $acreage=rand(1,5);
            $updates=  [
                "brandtime"=>$insertbrandtime,
                "brandorigin"=>$brandorigin,
                "brandnum"=>$brandnum,
                "brandarea"=>$insertbrandarea,
                "brandmap"=>$insertbrandmap,
                "brandperson"=>$insertbrandperson,
                "brandchat"=>$brandchat,
                "brandattch"=>$brandattch,
                "brandapply"=>$brandapply,
                "genre"=>$insertgenre,
                "brandduty"=>$insertbrandduty,
                "registeredcapital"=>$insertregisteredcapital,
                "acreage"=>$acreage,
                "decorationpay"=>mt_rand (20000,50000),
                "equipmentcost"=>mt_rand (10000,20000),
                "workingcapital"=>20000,
                "laborquarter"=>mt_rand (2000,5000),
                "miscellaneous"=>mt_rand (2000,5000),
                "dailyvolume"=>mt_rand (80,100),
                "unitprice"=>mt_rand (50,100),
                "watercoal"=>mt_rand (200,500),
                "quartersrent"=>mt_rand (2000,5000),
            ];
            Brandarticle::find($brandarticle->id)->update($updates);
        }
        echo '更新完毕！！！';
        }
        private function randArrays(array $arrays,$nums,$falg='、')
        {
            $newarrays=array_rand($arrays,$nums);
            $strs='';
            foreach ($newarrays as $newarray)
            {
                 $strs.=$arrays[$newarray].$falg;
            }
            return $strs;
        }

        public function updateMipCache()
        {
            $api = 'https://c.mipcdn.com/update-ping/refreshcache';
            $postData =array(
                "host"=>'mip.51xxsp.com',
                "path"=>"/",
                "authkey"=>'6f3219a1939ebe41c9ebf4f3daa76de5'
            );
            $postData=json_encode($postData);
            $url = $api;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            $result = curl_exec($ch);
            curl_close($ch);
            Log::info($result);
        }

    /**
     * 文档内容排版处理
     */
        public function updateArticleContent()
        {
            $brandArticleIds=Brandarticle::pluck('id');
            $pattens=[
            '#<p>[\n	]+<br />[\n]+</p>#',
            '#<p >[\n	]+<br />[\n]+</p>#',
            '#<p>[\n	]+<br/>[\n]+</p>#',
            '#<p >[\n	]+<br/>[\n]+</p>#',
            '#<p><br/></p>#',
            '#<p><br /></p>#',
            '#<p ><br/></p>#',
            '#<p ><br /></p>#',
            '#<p><strong><br/></strong></p>#',
            '#<p ><strong><br /></strong></p>#',
            '#<p>[\s| |　]?<strong>[\s| |　]?</strong></p>#',
            '#<p>[\s| |　]?<strong>[\s| |　]+</strong></p>#',
            '#<p>[\s| |　]+<strong>[\s| |　]+</strong></p>#',
            '#<p>[\s| |　|\n\r]?<br/>[\s| |　|\n\r]?</p>#',
            '#<p>[\s| |　|\n\r]+<br/>[\s| |　|\n\r]+</p>#',
            '#<p>[\s| |　|\n\r]+<br />[\s| |　|\n\r]+</p>#',
            '#<p><strong><br/></strong></p>#',
            '#<p><strong><br /></strong></p>#',
            '#<p><strong><br></strong></p>#',
            '#<p><br></p>#',
            '#<p><br ></p>#',
            '#<p><br /></p>#',
            '#<p>[\s| |　]?</p>#',
            '#<p>[\s| |　]+</p>#',
            ];
            foreach ($brandArticleIds as $brandArticleId)
            {
            $brandarticle=Brandarticle::find($brandArticleId);
            $body=preg_replace($pattens,'',$brandarticle->body);
            $jmxq_content=preg_replace($pattens,'',$brandarticle->jmxq_content);
            $ppjs_content=preg_replace($pattens,'',$brandarticle->ppjs_content);
            $lrfx_content=preg_replace($pattens,'',$brandarticle->lrfx_content);
            Brandarticle::where('id',$brandArticleId)->update(['body'=>$body,'jmxq_content'=>$jmxq_content,'ppjs_content'=>$ppjs_content,'lrfx_content'=>$lrfx_content]);
            }
            $articles=Archive::pluck('id');
            foreach ($articles as $article)
            {
                $thisarticle=Archive::find($article);
                $body=preg_replace($pattens,'',$thisarticle->body);
                Archive::where('id',$article)->update(['body'=>$body]);
            }
            echo '更新完成！！！';
        }

        public function updatteFlags()
        {
            $brandArticleIds=Archive::pluck('id');
            foreach ($brandArticleIds as $brandArticleId)
            {
                $brandarticle=Archive::find($brandArticleId);
                $flags=str_split($brandarticle->flags);
                $newflgs='';
                foreach ($flags as $flag)
                {
                    $newflgs.=$flag.',';
                }
                $newflgs=rtrim($newflgs,',');
                Archive::where('id',$brandarticle->id)->update(['flags'=>$newflgs]);
            }
        }

    /**
     * 更新文档对应品牌
     */
        public function checktoolBrandId()
        {
            $nullBrandArticles=Archive::where('brandid',0)->get();
            $brandNmaes=Brandarticle::where('brandname','<>','')->pluck('brandname');
            foreach ($nullBrandArticles as $nullBrandArticle)
            {
                foreach ($brandNmaes as $brandNmae)
                {
                    if (str_contains($nullBrandArticle,$brandNmae))
                    {
                        $thisArticlebdName=$brandNmae;
                        $thisArticlebdId=Brandarticle::where('brandname',$brandNmae)->value('id');
                        Archive::where('id',$nullBrandArticle->id)->update(['bdname'=>$thisArticlebdName,'brandid'=>$thisArticlebdId]);
                    }
                }
            }
            echo '更新完成！！！';

        }
}
