<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    //权限
    public function __construct()
    {
        $this->middleware('auth',[
//            'only'=>['info'],//（登录后可以查看的）该中间件只对这些方法生效
            'except'=>['index'],//（未登录可以查看的）该中间件除了这些方法，对其他方法生效
        ]);
    }

    //商家账号列表
    public function index()
    {
        $users = Users::paginate(5);//包含功能分页
        return view('users/index',compact('users'));
    }
    //商家账号添加页面
    public function create()
    {
        //获取店铺分类ID和分类名
        $shopCategory = DB::table('shop_categories')->select('id','name')->get();
        return view('users/create',compact('shopCategory'));
    }
    //商家账号添加功能
    public function store(Request $request)
    {
//        dd($request->on_time);
        //验证数据
        $this->validate($request,[
            'name'=>'required|max:20|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|confirmed',

            'shop_name'=>'required',
            'shop_rating'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'notice'=>'required',
            'discount'=>'required',
        ],[
            'name.required'=>'商家账号名不能为空',
            'name.max'=>'商家账号名不能大于20个字',
            'name.unique'=>'商家账号名已存在',
            'email.required'=>'邮箱名不能为空',
            'email.email'=>'邮箱不能重复',
            'email.unique'=>'邮箱已存在',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码不能小于5位',
            'password.confirmed'=>'密码和确认密码不相同',

            'shop_name.required'=>'名称不能为空',
            'shop_rating.required'=>'评分不能为空',
            'start_send.required'=>'起送金额(元)不能为空',
            'send_cost.required'=>'配送费(元)不能为空',
            'notice.required'=>'店公告不能为空',
            'discount.required'=>'优惠信息不能为空',
        ]);

        //处理上传文件
        $file = $request->shop_img;
        //使用这个要开启storage   php artisan storage:link
        $fileName = $file->store('public/shop_img');//获得保存图片路径，返回地址
        $img = Storage::url($fileName);//这样商户的图片前台也可以访问

        //开启事务
        DB::beginTransaction();
        try{
        //先添加商家信息
        $shop = Shop::create([
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
            'status'=>1//平台添加默认审核通过
        ]);
        //后添加商家账号
        $shop_id = $shop->id;//获取所属商家
        Users::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'status'=>1,//平台添加默认审核通过
            'shop_id'=>$shop_id
        ]);
            //提交事务
            DB::commit();
            //设置提示信息
            session()->flash('success','添加商家账号成功');
            return redirect()->route('users.index');//跳转到
        }catch (QueryException $ex){
            //设置提示信息
            session()->flash('danger','添加商家账号是失败');
            //回滚事务
            DB::rollback();
            return redirect()->route('users.create');//跳转到
        }


    }

    //商家账号修改页面
    public function edit(Users $user)
    {
        $shops = DB::table('shops')->select('id','shop_name')->get();
        return view('users/edit',compact(['user','shops']));
    }
    //商家账号修改功能
    public function update(Users $user,Request $request)
    {
//        dd($user->id);
        ///验证数据
        $this->validate($request,[
            'name'=>['required','max:20',Rule::unique('users')->ignore($user->id)],
            'email'=>['required','email',Rule::unique('users')->ignore($user->id)],
//            'email'=>'required|email',
        ],[
            'name.required'=>'商家账号名不3能为空',
            'name.max'=>'商家账号名不能大于20个字',
            'name.unique'=>'商家账号名已存在',
            'email.required'=>'邮箱名不能为空',
            'email.email'=>'邮箱不能重复',
            'email.unique'=>'邮箱已存在',
        ]);
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'shop_id'=>$request->shop_id
        ]);
        //设置提示信息
        session()->flash('success','修改商家账号信息成功');
        return redirect()->route('users.index');//跳转到
    }

    //商家审核信息修改功能
    public function status(Users $user)
    {
        $status = $user->status;
        if($status == 1){
            $status = 0;//禁止
        }elseif($status == 0){
            $status = 1;//启动
        }
        $user->update([
            'status'=>$status//平台添加默认审核通过
        ]);
        if($status == 1){
            //商家审核通过后，给商家发送邮件
            $_GET['email'] = $user->email;
            \Illuminate\Support\Facades\Mail::send('welcome', [], function ($message) {//welcome是视图
                $message->from('17313227001@163.com','liu');//邮箱，发送方姓名
                $message->to([$_GET['email']])->subject('商家审核通过');});//接收方

//            $r = \Illuminate\Support\Facades\Mail::raw('恭喜你的商家审核通过啦，快去看看吧！',function ($message){
//                $message->subject('商家审核通过');//标题
//                $message->to($_GET['email']);//发给别人的邮箱
//                $message->from('17313227001@163.com','liu后台管理员');//邮箱，发送方姓名
//            });
        }
//        dd($r);

        //设置提示信息
        if($status == 1){//禁止改为启动
            session()->flash('success','已设置为启动');
        }elseif ($status == 0){//启动改为禁止
            session()->flash('success','已设置为禁止');
        }
        return redirect()->route('users.index');//跳转到
    }


    //商家账号修改页面
    public function reset(Users $user)
    {
        return view('users/reset',compact('user'));
    }
    //商家账号修改功能
    public function confirm(Users $user,Request $request)
    {
//        dd(222);
        ///验证数据
        $this->validate($request,[
            'password'=>'required|min:5|confirmed',
        ],[
            'password.required'=>'密码不能为空',
            'password.min'=>'密码不能小于5位',
            'password.confirmed'=>'密码和确认密码不相同',
        ]);
        $password = bcrypt($request->password);
        $user->update([
            'password'=>$password,
        ]);
        //设置提示信息
        session()->flash('success','修改商家用户成功');
        return redirect()->route('users.index');//跳转到
    }


}
