<?php

namespace App\Http\Controllers\Admin;

use App\AdminModel\Acreagement;
use App\AdminModel\Addonarticle;
use App\AdminModel\Archive;
use App\AdminModel\Arctype;
use App\AdminModel\Brandarticle;
use App\AdminModel\InvestmentType;
use App\AdminModel\Production;
use App\Http\Requests\CreateArticleRequest;
use App\Helpers\UploadImages;
use App\Http\Requests\CreateBrandArticleRequest;
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
        $articles = Archive::orderBy('id','desc')->paginate(30);
        return view('admin.article',compact('articles'));
    }

    /**品牌文档查看
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function Brands()
    {
        $articles=Brandarticle::where('mid',1)->latest()->paginate(30);
        return view('admin.brandarticle',compact('articles'));
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


    /**文档创建提交数据处理
     * @param CreateArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function PostCreate(CreateArticleRequest $request)
    {
        if(Archive::where('title',$request->title)->where('created_at','>',Carbon::today())->value('id'))
        {
            exit('标题重复，禁止发布');
        }
        $request['brandid']= !empty($request['bdname'])?Brandarticle::where('brandname','like','%'.$request['bdname'].'%')->value('id'):0;
        $this->RequestProcess($request);
        Archive::create($request->all());
        //百度相关数据提交
        $thisarticle=Archive::where('id',Archive::max('id'))->find(Archive::max('id'));
        $thisarticleurl=config('app.url').'/'.$thisarticle->arctype->real_path.'/'.$thisarticle->id.'.html';
        $miparticleurl=str_replace('www.','mip.',config('app.url')).'/'.$thisarticle->arctype->real_path.'/'.$thisarticle->id.'.html';
        $this->BaiduCurl(config('app.api'),$thisarticleurl,'百度主动提交');
        if ($request->xiongzhang)
        {
            $this->BaiduCurl(config('app.mip_api'),$miparticleurl,'熊掌号实时推送');
        }else{
            $this->BaiduCurl(config('app.$mip_history'),$miparticleurl,'熊掌号历史提交');
        }
        auth('admin')->user()->notify(new ArticlePublishedNofication(Archive::latest() ->first()));
        return redirect(action('Admin\ArticleController@Index'));
    }

    /**
     * 品牌文档提交处理
     * @param CreateBrandArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function PostBrandArticle(CreateBrandArticleRequest $request)
    {
        if(Brandarticle::where('title',$request->title)->where('created_at','>',Carbon::today())->value('id'))
        {
            exit('标题重复，禁止发布');
        }
        $request['brandpay']=InvestmentType::where('id',$request->input('tzid'))->value('type');
        $this->RequestProcess($request);
        Brandarticle::create($request->all());
        $thisarticle=Brandarticle::where('id',Brandarticle::max('id'))->find(Brandarticle::max('id'));
        $thisarticleurl=config('app.url').'/'.$thisarticle->arctype->real_path.'/'.$thisarticle->id.'/';
        $this->BaiduCurl(config('app.api'),$thisarticleurl,'百度主动提交');
        $miparticleurl=config('app.url').'/'.$thisarticle->arctype->real_path.'/'.$thisarticle->id.'/';
        if ($request->xiongzhang)
        {
            $this->BaiduCurl(config('app.mip_api'),$miparticleurl,'熊掌号实时推送');
        }else{
            $this->BaiduCurl(config('app.$mip_history'),$miparticleurl,'熊掌号历史提交');
        }
        return redirect(action('Admin\ArticleController@Brands'));
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

    /**文档编辑提交处理
     * @param CreateArticleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function PostEdit(CreateArticleRequest $request,$id)
    {
        $request['brandid']= !empty($request['bdname'])?Brandarticle::where('brandname','like','%'.$request['bdname'].'%')->value('id'):0;
        $this->RequestProcess($request);
        if ($request->updatetime)
        {
            $request['created_at']=Carbon::now();
        }
        Archive::findOrFail($id)->update($request->all());
        return redirect(action('Admin\ArticleController@Index'));
    }

    public function PostBrandArticleEditor(CreateBrandArticleRequest $request,$id)
    {
        $this->RequestProcess($request);
        $request['brandpay']=InvestmentType::where('id',$request->input('tzid'))->value('type');
        Brandarticle::findOrFail($id)->update($request->all());
        return redirect(action('Admin\ArticleController@Brands'));
    }

    /**
     *自定义文档属性及缩略图处理
     * @param Request $request
     * @return Request
     */
    private function RequestProcess(Request $request)
    {
        $request['keywords']=$request['keywords']?$request['keywords']:$request['title'];
        $request['click']=rand(100,900);
        $request['description']=(!empty($request['description']))?str_limit($request['description'],180,''):str_limit(str_replace(['&nbsp;',' ','　',PHP_EOL,'\t'],'',strip_tags(htmlspecialchars_decode($request['body']))), $limit = 180, $end = '');
        $request['write']=auth('admin')->user()->name;
        $request['dutyadmin']=auth('admin')->id();
        //自定义文档属性处理
        if(isset($request['flags']))
        {
            $request['flags']=UploadImages::Flags($request['flags']);
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
        }
        //首页推荐图处理
        if($request['indexlitpic']) {
            $request['indexpic'] = UploadImages::UploadImage($request, 'indexlitpic');
        }
        //图集处理
        $request['imagepics']=rtrim($request->input('imagepics'),',');
        return $request;
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


    /**文档搜索
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function PostArticleSearch(Request $request)
    {
        $articles=Archive::where('title','like','%'.$request->input('title').'%')->latest()->paginate(30);
        return view('admin.article',compact('articles'));
    }


    /** 栏目文章查看
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function Type($id)
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
        }
        return view($view,compact('articles'));
    }


    /**百度主动推送
     * @param $thisarticleurl
     * @param $token
     * @param $type
     */
    private function BaiduCurl($thisarticleurl,$token,$type)
    {
        $urls = array($thisarticleurl);
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
        }
        return $title?1:0;
    }

}
