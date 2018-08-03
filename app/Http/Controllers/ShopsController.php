<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ShopsController extends Controller
{
    //权限
    public function __construct()
    {
        $this->middleware('auth',[
//            'only'=>['info'],//（登录后可以查看的）该中间件只对这些方法生效
            'except'=>['index'],//（未登录可以查看的）该中间件除了这些方法，对其他方法生效
        ]);
    }

    //商家信息列表
    public function index()
    {
        $shops = Shop::paginate(5);//包含功能分页
        return view('shops/index',compact('shops'));
    }

    //商家信息修改页面
    public function edit(Shop $shop)
    {
        //获取店铺分类ID和分类名
        $shopCategory = DB::table('shop_categories')->select('id','name')->get();
        return view('shops/edit',compact(['shop','shopCategory']));
    }
    //商家信息修改功能
    public function update(Shop $shop,Request $request)
    {
//        dd($request->shop_name);
        ///验证数据
        $this->validate($request,[
            'shop_name'=>['required','max:20',Rule::unique('shops')->ignore($shop->id)],
            'shop_rating'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'notice'=>'required',
            'discount'=>'required',
        ],[
            'shop_name.required'=>'名称不能为空',
            'shop_name.max'=>'名称不能大于20个字',
            'shop_name.unique'=>'名称已存在',
            'shop_rating.required'=>'评分不能为空',
            'start_send.required'=>'起送金额(元)不能为空',
            'send_cost.required'=>'配送费(元)不能为空',
            'notice.required'=>'店公告不能为空',
            'discount.required'=>'优惠信息不能为空',
        ]);

        //处理上传文件
        if($request->shop_img){
            //处理上传文件
//            $file = $request->shop_img;
//            //使用这个要开启storage   php artisan storage:link
//            $fileName = $file->store('public/shop_img');//获得保存图片路径，返回地址
//            $img = Storage::url($fileName);//这样商户的图片后台也可以访问

            $img = $request->shop_img;//因为使用了阿里云上传图片，返回的也是完整路径，所以不需要再获取路径
        }else{
            $img = $shop->shop_img;
        }

        $shop->update([
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$img,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>$shop->status//平台添加默认审核通过
        ]);
        //设置提示信息
        session()->flash('success','修改商家信息成功');
        return redirect()->route('shops.index');//跳转到
    }

    //查看商家信息并修改状态
    public function show(Shop $shop)
    {
        //获取店铺分类ID和分类名
        $shopCategory = DB::table('shop_categories')->select('id','name')->get();
        return view('shops/show',compact(['shop','shopCategory']));
    }

    //商家审核信息修改功能
    public function status(Shop $shop,Request $request)
    {
//        dd($request->status);
        $status = $request->status;
        $shop->update([
            'status'=>$status//平台添加默认审核通过
        ]);

            //设置提示信息
        if($status == 1){//正常
            session()->flash('success','已设置为审核成功');
        }elseif ($status == 0){
            session()->flash('success','已设置为未审核');
        }elseif ($status == -1){
            session()->flash('success','已设置为禁用');
        }
        return redirect()->route('shops.index');//跳转到
    }


    //文件接收服务端
    public function upload()
    {
        $storage = \Illuminate\Support\Facades\Storage::disk('oss');
        $fileName = $storage->putFile('eleb/shops',request()->file('file'));//upload,file名字是在控制台错误文件header下找到的
        return [
            'fileName'=>$storage->url($fileName)//fileName作为响应内容名
        ];
    }

}
