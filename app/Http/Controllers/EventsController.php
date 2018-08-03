<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventsController extends Controller
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
        $events = Event::paginate(5);
        return view('event/index',compact('events'));
    }


    //添加抽奖活动页面
    public function create()
    {
        //获取角色
//        $roles = Event::get();
        return view('event/create',compact('roles'));
    }
    //添加抽奖活动功能
    public function store(Request $request)
    {
        //验证数据
        $this->validate($request,[
            'title'=>'required|max:20|unique:events',
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
        $events = Event::create([
            'name'=>$request->name,
            'title'=>$request->title,
            'content'=>$request->content,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>$request->is_prize,
        ]);
        //设置提示信息
        session()->flash('success','添加抽奖活动成功');
        return redirect()->route('events.index');//跳转到
    }


    //修改抽奖活动页面
    public function edit(Event $event)
    {
        return view('event/edit',compact('event'));
    }


    //添加抽奖活动功能
    public function update(Event $event,Request $request)
    {
        //验证数据
        $this->validate($request,[
            'title'=>['required','max:20',Rule::unique('events')->ignore($event->id)],
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
        $event->update([
            'name'=>$request->name,
            'title'=>$request->title,
            'content'=>$request->content,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>$request->is_prize,
        ]);
        //设置提示信息
        session()->flash('success','修改抽奖活动成功');
        return redirect()->route('events.index');//跳转到
    }

    //删除抽奖活动
    public function destroy(Event $event)
    {
        $event->delete();
        session()->flash('success','删除成功');
        return redirect()->route('events.index');//跳转
    }


    //查看
    public function show(Event $event)
    {
        return view('event/show',compact('event'));//跳转
    }
}
