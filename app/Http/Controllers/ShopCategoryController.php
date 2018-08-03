<?php

namespace App\Http\Controllers;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ShopCategoryController extends Controller
{
    //权限
    public function __construct()
    {
        $this->middleware('auth',[
//            'only'=>['info'],//（登录后可以查看的）该中间件只对这些方法生效
            'except'=>['index'],//（未登录可以查看的）该中间件除了这些方法，对其他方法生效
        ]);
    }

    //商家分类列表
    public function index()
    {
        $shopCategory = ShopCategory::paginate(5);//包含功能分页
        return view('shopCategory/index',compact('shopCategory'));
    }
    //商家分类添加页面
    public function create()
    {
        return view('shopCategory/create');
    }
    //商家分类添加功能
    public function store(Request $request)
    {
        //验证数据
        $this->validate($request,[
            'name'=>'required|max:20|unique:shop_categories',
            'img'=>'required'
        ],[
            'name.required'=>'商家分类名不能为空',
            'name.max'=>'商家分类名不能大于20个字',
            'img.required'=>'图片不能为空',
        ]);

//        //处理上传文件
//        $file = $request->img;
//        //使用这个要开启storage   php artisan storage:link
//        $fileName = $file->store('public/img');//获得保存图片路径，返回地址
//        $img = Storage::url($fileName);//这样商户的图片后台也可以访问
        $img = $request->img;//因为使用了阿里云上传图片，返回的也是完整路径，所以不需要再获取路径

        $model = ShopCategory::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'img'=>$img,
        ]);
        //设置提示信息
        session()->flash('success','添加商家分类名成功');
        return redirect()->route('shopCategory.index');//跳转到
    }

    //商家分类修改页面
    public function edit(ShopCategory $shopCategory)
    {
        return view('shopCategory/edit',compact('shopCategory'));
    }
    //商家分类修改功能
    public function update(ShopCategory $shopCategory,Request $request)
    {
//        dd(222);
        ///验证数据
        $this->validate($request,[
            'name'=>['required','max:20',Rule::unique('shop_categories')->ignore($shopCategory->id)],
        ],[
            'name.required'=>'商家分类名不能为空',
            'name.max'=>'商家分类名不能大于20个字',
            'name.unique'=>'商家分类名已存在',
        ]);

        //处理上传文件
        if($request->img){
            //处理上传文件
//            $file = $request->img;
//            //使用这个要开启storage   php artisan storage:link
//            $fileName = $file->store('public/img');//获得保存图片路径，返回地址
//            $img = Storage::url($fileName);//这样商户的图片后台也可以访问

            $img = $request->img;//因为使用了阿里云上传图片，返回的也是完整路径，所以不需要再获取路径
        }else{
            $img = $shopCategory->img;
        }

        $shopCategory->update([
            'name'=>$request->name,
            'status'=>$request->status,
            'img'=>$img
        ]);
        //设置提示信息
        session()->flash('success','修改分类名成功');
        return redirect()->route('shopCategory.index');//跳转到
    }

    //删除商家分类
    public function destroy(ShopCategory $shopCategory)
    {
        $shopCategory->delete();
        session()->flash('success','删除成功');
        return redirect()->route('shopCategory.index');//跳转
    }

    //文件接收服务端
    public function upload()
    {
        $storage = \Illuminate\Support\Facades\Storage::disk('oss');
        $fileName = $storage->putFile('eleb/shopCategory',request()->file('file'));//upload,file名字是在控制台错误文件header下找到的
        return [
            'fileName'=>$storage->url($fileName)//fileName作为响应内容名
        ];
    }

}
