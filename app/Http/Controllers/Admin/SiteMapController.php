<?php

namespace App\Http\Controllers\Admin;

use App\AdminModel\Archive;
use App\AdminModel\Arctype;
use App\AdminModel\Brandarticle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SiteMapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    /**PC端地图生成
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function Index()
    {
        ini_set("memory_limit","-1");
        $index=1;
        $appurl=config('app.url');
        $typedirs=Arctype::pluck('real_path');
        $newsurllinks=Archive::where('ismake',1)->orderBy('id','desc')->get();
        $brandlinks=Brandarticle::where('ismake',1)->orderBy('id','desc')->get();
        $mainsitemap="<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
        $urlset='<urlset>';
        $urlset2='</urlset>';
        $urlsets='';
        $lastcontents='';
        $sitemapindex='<sitemapindex>';
        $sitemapindex2='</sitemapindex>';
        $files=Storage::files('public');
        foreach ($files as $file)
        {
            if (str_contains($file,'sitemap'))
            {
                Storage::delete($file);
            }
        }
        //news地图生成
        for ($i=0;$i<count($newsurllinks);$i++)
        {
          $urlsets.="
<url>
    <loc>$appurl/news/{$newsurllinks[$i]->id}/</loc>
    <lastmod>".date('Y-m-d',strtotime($newsurllinks[$i]->created_at))."</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
</url>
            ";
          if ($i!=0 && $i%2000==0)
          {
              $contents=$mainsitemap.$urlset.$urlsets.$urlset2;
              Storage::disk('public')->append('sitemapnews'.$index.'.xml', $contents);
              $index++;
              $urlsets='';
              $contents='';
          }elseif($i>(int)(2000*(ceil(count($newsurllinks)/2000)-1))){
              $lastcontents=$urlsets;
          }
        }
        $contents=$mainsitemap.$urlset.$lastcontents.$urlset2;
        Storage::disk('public')->append('sitemapnews'.$index.'.xml', $contents);
        $urlsets='';
        $contents='';
        $lastcontents='';
        $index=1;
        #-------------------------------------------------------------------------------------------
        for ($i=0;$i<count($brandlinks);$i++)
        {
            $urlsets.="
<url>
    <loc>$appurl/brand/{$brandlinks[$i]->id}/</loc>
    <lastmod>".date('Y-m-d',strtotime($brandlinks[$i]->created_at))."</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
</url>
            ";
            if ($i!=0 && $i%1000==0)
            {
                $contents=$mainsitemap.$urlset.$urlsets.$urlset2;
                Storage::disk('public')->append('sitemapbrands'.$index.'.xml', $contents);
                $index++;
                $urlsets='';
                $contents='';
            }elseif($i>(int)(1000*(ceil(count($brandlinks)/1000)-1))){
                $lastcontents=$urlsets;
            }
        }
        $contents=$mainsitemap.$urlset.$lastcontents.$urlset2;
        Storage::disk('public')->append('sitemapbrands'.$index.'.xml', $contents);
        $urlsets='';
        $contents='';
        $lastcontents='';
        $index=1;
        #------------------------------------------------------------------------------------------
        foreach ($typedirs as $typedir){
    $urlsets.="
<url>
        <loc>$appurl/$typedir/</loc>
        <changefreq>daily</changefreq>                
        <priority>1.0</priority>
    </url>";
        }
        $indexurl="
    <url>
        <loc>$appurl</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>";
        $contents=$mainsitemap.$urlset.$indexurl.$urlsets.$urlset2;
        Storage::disk('public')->append('sitemap_x.xml', $contents);
        $contents='';
        $urlsets='';
        $newfiles=Storage::files('public');
        foreach ($newfiles as $newfile)
        {
            if (str_contains($newfile,'sitemap'))
            {
                $urlsets.="
<sitemap>
    <loc>{$appurl}/storage/".str_replace('public/','',$newfile)."</loc>
    <lastmod>".date('Y-m-d',strtotime(Carbon::now()))."</lastmod>
</sitemap>
";
            }
        }
        $contents=$mainsitemap.$sitemapindex.$urlsets.$sitemapindex2;
        Storage::disk('public')->append('sitemap.xml', $contents);
        $contents='';
        $msg='XML文件生成成功';
        return view('admin.sitemapcreate',compact('msg'));
    }

    /**
     * 移动端地图生成
     * @param
     *
     * @return
     */

    function MobileSitemap()
    {
        $appurl=config('app.url');
        $mappurl=str_replace('http://www.','http://m.',$appurl);
        $typedirs=Arctype::pluck('real_path');
        $urllinks=Archive::where('published_at','<=',Carbon::now())->where('ismake',1)->get();
        $sitemapinfos="<?xml version=\"1.0\" encoding=\"UTF-8\" ?> 
        <urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
        xmlns:mobile=\"http://www.baidu.com/schemas/sitemap-mobile/1/\"> 
        <url> 
        <loc>$mappurl</loc> 
        <mobile:mobile type=\"mobile\"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
        </url> 
        <url> 
        <loc>$appurl</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
        </url>
        ";
        foreach ($typedirs as $typedir){
            $sitemapinfos.="<url> 
            <loc>$mappurl/$typedir/</loc> 
            <mobile:mobile type=\"mobile\"/>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
            </url> 
            <url>
                <loc>$appurl/index.php/$typedir/</loc>
                <changefreq>daily</changefreq>                
                <priority>1.0</priority>
            </url>          
            ";
        }

        foreach ($urllinks as $urllink){
            $sitemapinfos.="<url> 
            <loc>$mappurl/index.php/news/{$urllink->id}/</loc> 
            <mobile:mobile type=\"mobile\"/>
            <lastmod>".date('Y-m-d',strtotime($urllink->updated_at))."</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
            </url> 
            <url>
                <loc>$appurl/inex.php/news/{$urllink->id}/</loc>
                <lastmod>".date('Y-m-d',strtotime($urllink->updated_at))."</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.8</priority>
            </url>
            ";

        }
        $sitemapinfos.='</urlset>';
        if(Storage::disk('public')->put('mobilesitemap.xml', $sitemapinfos)){
            $msg= 'XML文件生成成功';
        }else{
            $msg= '文件生成失败@';
        }
        return view('admin.sitemapcreate',compact('msg'));
    }
}
