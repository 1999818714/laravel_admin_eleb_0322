<?php

namespace App\Http\Controllers;

use App\Models\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventPrizesController extends Controller
{
    //权限
    public function __construct()
    {
        $this->middleware('auth',[
//            'only'=>['info'],//（登录后可以查看的）该中间件只对这些方法生效
            'except'=>['index'],//（未登录可以查看的）该中间件除了这些方法，对其他方法生效
        ]);
    }

    //活动抽奖列表页面
    public function index()
    {
        //获得活动数据
        $eventPrize = EventPrize::paginate(5);
        return view('eventPrize/index',compact('eventPrize'));
    }


    //添加抽奖活动页面
    public function create()
    {
        //获取角色
        return view('eventPrize/create');
    }
    //添加抽奖活动功能
    public function store(Request $request)
    {
        //验证数据
        $this->validate($request,[
            'title'=>'required|max:20|unique:event_prizes',
            'content'=>'required',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required',
            'is_prize'=>'required',
        ],[
            'title.required'=>'抽奖活动名不能为空',
            'title.max'=>'抽奖活动名不能大于20个字',
            'title.unique'=>'抽奖活动名已存在',
            'content.required'=>'详情不能为空',
            'signup_start.required'=>'报名开始时间不能为空',
            'signup_end.required'=>'报名结束时间不能为空',
            'prize_date.required'=>'开奖日期不能为空',
            'signup_num.required'=>'报名人数限制不能为空',
            'is_prize.required'=>'是否开奖不能为空',
        ]);
//        dd($request->signup_start);
        $eventPrize = EventPrize::create([
            'name'=>$request->name,
            'title'=>$request->title,
            'content'=>$request->content,
            'signup_start'=>$request->signup_start,
            'signup_end'=>$request->signup_end,
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>$request->is_prize,
        ]);
        //设置提示信息
        session()->flash('success','添加抽奖活动成功');
        return redirect()->route('eventPrize.index');//跳转到
    }


    //修改抽奖活动页面
    public function edit(EventPrize $eventPrize)
    {
        return view('eventPrize/edit',compact('event'));
    }


    //添加抽奖活动功能
    public function update(EventPrize $eventPrize,Request $request)
    {
        //验证数据
        $this->validate($request,[
            'title'=>['required','max:20',Rule::unique('event_prizes')->ignore($eventPrize->id)],
            'content'=>'required',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required',
            'is_prize'=>'required',
        ],[
            'title.required'=>'抽奖活动名不能为空',
            'title.max'=>'抽奖活动名不能大于20个字',
            'title.unique'=>'抽奖活动名已存在',
            'content.required'=>'详情不能为空',
            'signup_start.required'=>'报名开始时间不能为空',
            'signup_end.required'=>'报名结束时间不能为空',
            'prize_date.required'=>'开奖日期不能为空',
            'signup_num.required'=>'报名人数限制不能为空',
            'is_prize.required'=>'是否开奖不能为空',
        ]);

        $eventPrize->update([
            'name'=>$request->name,
            'title'=>$request->title,
            'content'=>$request->content,
            'signup_start'=>$request->signup_start,
            'signup_end'=>$request->signup_end,
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>$request->is_prize,
        ]);
        //设置提示信息
        session()->flash('success','修改抽奖活动成功');
        return redirect()->route('eventPrize.index');//跳转到
    }

    //删除抽奖活动
    public function destroy(EventPrize $eventPrize)
    {
        $eventPrize->delete();
        session()->flash('success','删除成功');
        return redirect()->route('eventPrize.index');//跳转
    }
}
