<?php

namespace App\Http\Controllers\Admin;

use App\AdminModel\Acreagement;
use App\AdminModel\Addonarticle;
use App\AdminModel\Archive;
use App\AdminModel\Arctype;
use App\AdminModel\Brandarticle;
use App\AdminModel\InvestmentType;
use App\AdminModel\Production;
use App\Events\SitemapEvent;
use App\Http\Requests\CreateArticleRequest;
use App\Helpers\UploadImages;
use App\Http\Requests\ImagesUploadRequest;
use App\Notifications\ArticlePublishedNofication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Log;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    /**文档列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function Index()
    {
        //$articles = Archive::where('published_at','<=',Carbon::now())->latest()->paginate(30);
        $articles = Archive::orderBy('id','desc')->paginate(30);
        return view('admin.article',compact('articles'));
    }


    /**普通文档创建
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function Create()
    {
        $allnavinfos=Arctype::where('is_write',1)->where('mid',0)->pluck('typename','id');
        return view('admin.article_create',compact('allnavinfos'));
    }

    /**品牌文档创建
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function BrandCreate()
    {
        $allnavinfos=Arctype::where('is_write',1)->where('mid',1)->pluck('typename','id');
        $investments=InvestmentType::orderBy('id','asc')->pluck('type','id');
        $acreagements=Acreagement::orderBy('id','asc')->pluck('type','id');
        return view('admin.article_brandcreate',compact('allnavinfos','investments','acreagements'));
    }

    /**
     * 产品文档创建
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ProductionCreate()
    {
        $allnavinfos=Arctype::where('is_write',1)->where('mid',2)->pluck('typename','id');
        return view('admin.article_productcreate',compact('allnavinfos'));
    }

    /**文档创建提交数据处理
     * @param CreateArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function PostCreate(CreateArticleRequest $request)
    {
        //自定义文档属性处理
        if(isset($request['flags']))
        {
            $request['flags']=UploadImages::Flags($request['flags']);
        }else{
            $request['flags']='';
        }
        //缩略图处理
        if($request['image'])
        {
            $request['litpic']=UploadImages::UploadImage($request,'image');
            if(empty($request['flags']))
            {
                $request['flags'].='p';
            }else{
                $request['flags'].=',p';
            }
        }elseif (preg_match('/<[img|IMG].*?src=[\' | \"](.*?(?:[\.jpg|\.jpeg|\.png|\.gif|\.bmp]))[\'|\"].*?[\/]?>/i',$request['body'],$match)){
            $request['litpic']=$match[1];
            if(empty($request['flags']))
            {
                $request['flags'].='p';
            }else{
                $request['flags'].=',p';
            }
        }else{
            $request['litpic']='';
        }
        //首页推荐图处理
        if($request['indexlitpic']) {
            $request['indexpic'] = UploadImages::UploadImage($request, 'indexlitpic');
        }
       $request['keywords']=$request['keywords']?$request['keywords']:$request['title'];
        $request['click']=rand(100,900);
        $request['description']=(!empty($request['description']))?str_limit($request['description'],180,''):str_limit(str_replace(['&nbsp;',' ','　',PHP_EOL,'\t'],'',strip_tags(htmlspecialchars_decode($request['body']))), $limit = 180, $end = '');
        $request['write']=auth('admin')->user()->name;
        $request['dutyadmin']=auth('admin')->id();
        //图片alt信息及title替换
        //$request['body']=str_replace(['&nbsp;'],'',$this->ImageInformation($request->input('body'),$request->input('shorttitle')?$request->input('shorttitle'):$request->input('brandname'),$request->input('title')));
        $token=config('app.api', '');
        $mip_api=config('app.mip_api', '');
        $mip_history=config('app.mip_history', '');
        //不同文档类型分类入库
        if ($request->input('mid')==0)
        {
            //重复文档监测
            if(Archive::where('title',$request['title'])->where('created_at','>',Carbon::today())->value('id'))
            {
                exit('标题重复，禁止发布');
            }
            $request['brandid']= !empty($request['bdname'])?Brandarticle::where('brandname','like','%'.$request['bdname'].'%')->value('id'):0;
            $request['brandid']=!empty($request['brandid'])?$request['brandid']:0;
            Archive::create($request->all());
            $request['id']=Archive::max('id');
            Addonarticle::create($request->all());
            //百度主动推送
            $thisarticle=Archive::where('id',Archive::max('id'))->find(Archive::max('id'));
            $thisarticleurl='https://www.51xxsp.com/news/'.$thisarticle->id.'/';
            $miparticleurl='https://mip.51xxsp.com/index.php/news/'.$thisarticle->id.'/';
            if($thisarticle->created_at>Carbon::now()){
                return redirect(action('Admin\ArticleController@Index'));
                auth('admin')->user()->notify(new ArticlePublishedNofication(Archive::latest() ->first()));
            }else{
                $this->BaiduCurl($thisarticleurl,$token,'百度PC提交');
                if ($request->xiongzhang)
                {
                    $this->BaiduCurl($miparticleurl,$mip_api,'熊掌号实时提交');
                }else{
                    $this->BaiduCurl($miparticleurl,$mip_history,'熊掌号历史提交');
                }
                auth('admin')->user()->notify(new ArticlePublishedNofication(Archive::latest() ->first()));
                return redirect(action('Admin\ArticleController@Index'));
            }
        }elseif ($request->input('mid')==2){
            //重复文档监测
            if(Production::where('title',$request['title'])->where('created_at','>',Carbon::today())->value('id'))
            {
                exit('标题重复，禁止发布');
            }
            $request['brandid']= !empty($request['bdname'])?Brandarticle::where('brandname','like','%'.$request['bdname'].'%')->value('id'):0;
            $request['brandid']=!empty($request['brandid'])?$request['brandid']:0;
            Production::create($request->all());
            //百度主动推送
            $thisarticle=Production::where('id',Production::max('id'))->find(Production::max('id'));
            $thisarticleurl='https://www.51xxsp.com/item/'.$thisarticle->id.'/';
            $miparticleurl='https://mip.51xxsp.com/index.php/item/'.$thisarticle->id.'/';
            $this->BaiduCurl($thisarticleurl,$token,'百度PC提交');
            if ($request->xiongzhang)
            {
                $this->BaiduCurl($miparticleurl,$mip_api,'熊掌号实时提交');
            }else{
                $this->BaiduCurl($miparticleurl,$mip_history,'熊掌号历史记录提交');
            }

            //auth('admin')->user()->notify(new ArticlePublishedNofication(Production::latest() ->first()));
            return redirect(action('Admin\ArticleController@ProdctionList'));
        }
        else{
            //重复文档监测
            if(Brandarticle::where('title',$request['title'])->where('created_at','>',Carbon::today())->value('id'))
            {
                exit('标题重复，禁止发布');
            }
            $request['brandpay']=InvestmentType::where('id',$request->input('tzid'))->value('type');
            $request['jmxq_content']=str_replace(['&nbsp;'],'',$this->ImageInformation($request->input('jmxq_content'),$request->input('shorttitle')?$request->input('shorttitle'):$request->input('brandname'),$request->input('title')));
            $request['gsjs_content']=str_replace(['&nbsp;'],'',$this->ImageInformation($request->input('gsjs_content'),$request->input('shorttitle')?$request->input('shorttitle'):$request->input('brandname'),$request->input('title')));
            $request['lrfx_content']=str_replace(['&nbsp;'],'',$this->ImageInformation($request->input('lrfx_content'),$request->input('shorttitle')?$request->input('shorttitle'):$request->input('brandname'),$request->input('title')));
            Brandarticle::create($request->all());
            //百度主动推送
            $thisarticle=Brandarticle::where('id',Brandarticle::max('id'))->find(Brandarticle::max('id'));
            $thisarticleurl='https://www.51xxsp.com/brand/'.$thisarticle->id.'/';
            $miparticleurl='https://mip.51xxsp.com/index.php/brand/'.$thisarticle->id.'/';
            $this->BaiduCurl($thisarticleurl,$token,'百度PC提交');
            if ($request->xiongzhang)
            {
                $this->BaiduCurl($miparticleurl,$mip_api,'熊掌号实时提交');
            }else{
                $this->BaiduCurl($miparticleurl,$mip_history,'熊掌号历史提交');
            }
            //auth('admin')->user()->notify(new ArticlePublishedNofication(Brandarticle::latest() ->first()));
            return redirect(action('Admin\ArticleController@Brands'));
        }
    }

    /**普通文档文档编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function Edit($id)
    {
        $articleinfos=Archive::findOrfail($id);
        $allnavinfos=Arctype::where('is_write',1)->where('mid',0)->pluck('typename','id');
        $pics=explode(',',Archive::where('id',$id)->value('imagepics'));
        return view('admin.article_edit',compact('id','articleinfos','allnavinfos','pics'));
    }
    public function BrandEdit($id)
    {
        $allnavinfos=Arctype::where('is_write',1)->where('mid',1)->pluck('typename','id');
        $pics=explode(',',Brandarticle::where('id',$id)->value('imagepics'));
        $articleinfos=Brandarticle::where('id',$id)->first();
        $investments=InvestmentType::orderBy('id','asc')->pluck('type','id');
        $acreagements=Acreagement::orderBy('id','asc')->pluck('type','id');
        return view('admin.article_brandedit',compact('id','articleinfos','allnavinfos','pics','investments','acreagements'));
    }
    public function ProductEdit($id)
    {
        $allnavinfos=Arctype::where('is_write',1)->where('mid',2)->pluck('typename','id');
        $pics=explode(',',Addonarticle::where('id',$id)->value('imagepics'));
        //$articleinfos=Archive::find($id);
        $articleinfos=Production::where('id',$id)->first();;
        return view('admin.articleproduct_edit',compact('id','articleinfos','allnavinfos','pics'));
    }

    /**文档编辑提交处理
     * @param CreateArticleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function PostEdit(CreateArticleRequest $request,$id)
    {
        if(isset($request['flags']))
        {
            $request['flags']=UploadImages::Flags($request['flags']);
        }else{
            $request['flags']='';
        }
        if($request['image'])
        {
            $request['litpic']=UploadImages::UploadImage($request,'image');
            if(empty($request['flags'])){
                $request['flags'].='p';
            }else{
                $request['flags'].=',p';
            }
        }elseif (isset($request['litpic']) && !empty($request['litpic']))
        {
            $request['litpic']=$request['litpic'];
        }elseif (preg_match('/<[img|IMG].*?src=[\' | \"](.*?(?:[\.jpg|\.jpeg|\.png|\.gif|\.bmp]))[\'|\"].*?[\/]?>/i',$request['body'],$match)){
            $request['litpic']=$match[1];
            if(empty($request['flags']))
            {
                $request['flags'].='p';
            }else{
                $request['flags'].=',p';
            }
        }else{
            $request['litpic']='';
        }
        if ($request['indexlitpic'])
        {
            $request['indexpic']=UploadImages::UploadImage($request,'indexlitpic');
        }
        $request['description']=(!empty($request['description']))?str_limit($request['description'],180,''):str_limit(str_replace(['&nbsp;',' ','　',PHP_EOL],'',strip_tags(htmlspecialchars_decode($request['body']))), $limit = 180, $end = '');
        if (empty($request['imagepics']))
        {
            $request['imagepics']=' ';
        }

        if ($request->updatetime)
        {
            $request['created_at']=Carbon::now();
        }
        if ($request->input('mid')==0)
        {
            $request['brandid']= !empty($request['bdname'])?Brandarticle::where('brandname','like','%'.$request['bdname'].'%')->value('id'):0;
            $request['brandid']=!empty($request['brandid'])?$request['brandid']:0;
            Archive::findOrFail($id)->update($request->all());
            return redirect(action('Admin\ArticleController@Index'));
        }elseif ($request->input('mid')==2)
        {
            $request['brandid']= !empty($request['bdname'])?Brandarticle::where('brandname','like','%'.$request['bdname'].'%')->value('id'):0;
            $request['brandid']=!empty($request['brandid'])?$request['brandid']:0;
            Production::findOrFail($id)->update($request->all());
            return redirect(action('Admin\ArticleController@ProdctionList'));
        }else{
            $request['brandpay']=InvestmentType::where('id',$request->input('tzid'))->value('type');
            Brandarticle::findOrFail($id)->update($request->all());
            return redirect(action('Admin\ArticleController@Brands'));
        }
    }

    /**当前用户发布的文档
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function OwnerShip()
    {
        $articles = Archive::where('dutyadmin',auth('admin')->user()->id)->latest()->paginate(30);
        return view('admin.article',compact('articles'));
    }

    /**等待审核的文档
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function PendingAudit()
    {
        $articles = Archive::where('ismake','<>',1)->latest()->paginate(30);
        return view('admin.article',compact('articles'));
    }

    /**等待发布的文档
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function PedingPublished(){
        $articles = Archive::where('published_at','>',Carbon::now())->latest()->paginate(30);
        return view('admin.article',compact('articles'));
    }

    /**文档预览
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function PreViewArticle($id){
        $articleinfos=DB::table('addonarticles')->join('arctypes','addonarticles.typeid','=','arctypes.id')->join('archives','addonarticles.id','=','archives.id')->where('addonarticles.id','=',$id)->first();
        return view('admin.article_preview',compact('articleinfos'));
    }

    /**普通文档删除
     * @param $id
     * @return string
     */
    function DeleteArticle($id)
    {
        if(auth('admin')->user()->id)
        {
            Archive::where('id',$id)->delete();
            Addonarticle::where('id',$id)->delete();
            return '删除成功';
        }else{
            return '无权限执行此操作！';
        }


    }

    /**品牌文档删除
     * @param $id
     * @return string
     */
    public function DeleteBrandArticle($id)
    {
        if(auth('admin')->user()->id)
        {
            Brandarticle::where('id',$id)->delete();
            return '删除成功';
        }else{
            return '无权限执行此操作！';
        }
    }

    public function DeleteProductionArticle($id)
    {
        if(auth('admin')->user()->id)
        {
            Production::where('id',$id)->delete();
            return '删除成功';
        }else{
            return '无权限执行此操作！';
        }
    }

    /**文档搜索
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function PostArticleSearch(Request $request)
    {
        $articles=Archive::where('title','like','%'.$request->input('title').'%')->latest()->paginate(30);
        return view('admin.article',compact('articles'));
    }

    /**图集上传处理
     * @param ImagesUploadRequest $request
     */
    function UploadImages(ImagesUploadRequest $request){
        UploadImages::UploadImage($request);
    }

    /**品牌文档查看
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function Brands()
    {
        $articles=Brandarticle::where('mid',1)->latest()->paginate(30);
        return view('admin.brandarticle',compact('articles'));
    }

    public function ProdctionList()
    {
        $articles=Production::where('mid',2)->latest()->paginate(30);
        return view('admin.productarticle',compact('articles'));
    }

    /** 栏目文章查看
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function Type(Request $request,$id)
    {
        switch (Arctype::where('id',$id)->value('mid'))
        {
            case 0:
                $articles=Archive::where('typeid',$id)->latest()->paginate(30);
                $view='admin.article';
                break;
            case 1:
                $articles=Brandarticle::where('typeid',$id)->latest()->paginate(30);
                $view='admin.brandarticle';
                break;
            case 2:
                $articles=Production::where('typeid',$id)->latest()->paginate(30);
                $view='admin.productarticle';
                break;
        }
        return view($view,compact('articles'));
    }

    /**文章图片信息修改
     * @param $content
     * @param $title
     * @param $fulltitle
     * @return mixed
     */
    function ImageInformation($content,$title,$fulltitle)
    {
        preg_match('/<img.+(title=\".*?\").+>/i',$content,$match);
        if (empty($match))
        {
            return $content;
        }
        preg_match('/<img.+(alt=\".*?\").+>/i',$content,$match2);
        //dd($match2);
        if (empty($match2))
        {
            return $content;
        }

        $patterns=array();
        $replacement=array();
        $patterns[0]=$match[1];
        $patterns[1]=$match2[1];
        $title=empty($title)?$fulltitle:$title;
        $replacement[0]='title="'.$title.'"';
        $replacement[1]='alt="'.$title.'"';
        //dd($patterns[0]);
        $content=str_replace($patterns[0],$replacement[0],$content);
        $content=str_replace($patterns[1],$replacement[1],$content);
        return $content;
    }

    /**百度主动推送
     * @param $thisarticleurl
     * @param $token
     * @param $type
     */
    private function BaiduCurl($thisarticleurl,$token,$type)
    {
        $urls = array(
            $thisarticleurl
        );
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL =>$token,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        Log::info($thisarticleurl.$type);
        Log::info($result);
    }

    /**重复标题检测
     * @param Request $request
     * @return int
     */
    public function ArticletitleCheck(Request $request)
    {
        $title=Archive::where('title',$request->input('title'))->count();
        if (!$title)
        {
            $title=Brandarticle::where('title',$request->input('title'))->value('title');
            if (!$title)
            {
                $title=Production::where('title',$request->input('title'))->value('title');
            }
        }
        return $title?1:0;
    }

}
