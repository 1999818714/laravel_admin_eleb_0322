<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //权限
    public function __construct()
    {
        $this->middleware('auth',[
//            'only'=>['info'],//（登录后可以查看的）该中间件只对这些方法生效
            'except'=>['index'],//（未登录可以查看的）该中间件除了这些方法，对其他方法生效
        ]);
    }

    //活动列表
    public function index()
    {
        $activity = Activity::paginate(5);//包含分页
        return view('activity/index',compact('activity'));
    }
    //添加活动页面
    public function create()
    {
        return view('activity/create');
    }
    //添加活动功能
    public function store(Request $request)
    {
        //验证数据
        $this->validate($request,[
            'title'=>'required|max:20|unique:activities',
            'content'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ],[
            'title.required'=>'活动名不能为空',
            'title.max'=>'活动名不能大于20个字',
            'title.unique'=>'活动名已存在',
            'content.required'=>'活动内容不能为空',
            'start_time.required'=>'请设置开始时间',
            'end_time.required'=>'请设置结束时间',
            'end_time'=>'请设置结束时间',
        ]);

        $activity = Activity::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
        //设置提示信息
        session()->flash('success','添加活动成功');
        return redirect()->route('activity.index');//跳转到
    }

    //文件接收服务端
    public function upload()
    {
        $storage = \Illuminate\Support\Facades\Storage::disk('oss');
        $fileName = $storage->putFile('eleb/activity',request()->file('file'));//upload,file名字是在控制台错误文件header下找到的
        return [
            'fileName'=>$storage->url($fileName)//fileName作为响应内容名
        ];
    }

}
