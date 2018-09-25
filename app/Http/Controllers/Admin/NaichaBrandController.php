<?php

namespace App\Http\Controllers\Admin;

use App\AdminModel\BrandType;
use App\AdminModel\Naichabrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
class NaichaBrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }
    /**品牌导入视图 txt
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function brandsImport()
    {
        $brandtypes=BrandType::pluck('brandname','brandtype');
        return view('admin.import_brands',compact('brandtypes'));
    }

    /**品牌数据导入处理 txt
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postBrandsImport(Request $request)
    {
        $brands=explode(PHP_EOL,trim($request->input('content')));
        foreach ($brands as $brand)
        {
            if(!empty($brand) && empty(Naichabrand::where('brand',$brand)->value('brand')))
            {
                Naichabrand::create(['brand'=>$brand,'type'=>$request->input('type'),'num'=>1]);
            }else{
                Naichabrand::where('brand',Naichabrand::where('brand',$brand)->value('brand'))->update(['num'=>Naichabrand::where('brand',$brand)->value('num')+1]);
            }
        }
        return redirect(action('Admin\NaichaBrandController@brandListsView'));
    }

    /**
     * 品牌导入
     */
    public function importBrands()
    {
        $contents = Storage::get('zhaji.txt');
        $brands = explode(PHP_EOL,$contents);
        foreach ($brands as $brand)
        {
            if(!empty($brand) && empty(Naichabrand::where('brand',$brand)->value('brand')))
            {
                Naichabrand::create(['brand'=>$brand,'type'=>'jipai','num'=>1]);
                //dd(BrandDatas::where('brands','like','%'.$arr.'%')->value('brands'));
            }else{
                Naichabrand::where('brand',Naichabrand::where('brand',$brand)->value('brand'))->update(['num'=>Naichabrand::where('brand',$brand)->value('num')+1]);
            }
        }
        echo 'SUCCESS';
    }

    /**品牌视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function brandListsView(Request $request)
    {
        $arguments=$request->all();
        $brandtypes=BrandType::pluck('brandname','brandtype');
        $datas=Naichabrand::when($request->input('type'), function ($query) use ($request) {
            return $query->where('type', $request->input('type'));
        })->when($request->input('status'), function ($query) use ($request) {
            $status=$request->input('status');
            if ($status==2)
            {
                $status=0;
            }
            return $query->where('status', $status);
        })->orderBy('num','desc')->paginate(50);
        return view('admin.brands',compact('datas','arguments','brandtypes'));
    }



    /**品牌状态操作
     * @param Request $request
     * @return string
     */
    public function Status(Request $request)
    {
        Naichabrand::where('id',$request->id)->update(['status'=>1]);
        return '已使用';
    }

    /**删除品牌
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Delete($id)
    {
        Naichabrand::where('id',$id)->delete();
        return redirect()->back();
    }
}
