<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
        $eventPrizes = EventPrize::paginate(5);
        return view('eventPrize/index',compact('eventPrizes'));
    }


    //添加抽奖活动页面
    public function create()
    {
        //获取所有活动
        $events = Event::get();
        return view('eventPrize/create',compact('events'));
    }
    //添加抽奖活动功能
    public function store(Request $request)
    {
        //验证数据
        $this->validate($request,[
            'events_id'=>'required',
            'name'=>'required|max:10|unique:event_prizes',
            'description'=>'required',
        ],[
            'events_id.required'=>'活动不能为空',
            'name.required'=>'奖品名不能为空',
            'name.max'=>'奖品名不能大于10个字',
            'name.unique'=>'该奖品已存在',
            'description.required'=>'奖品详情不能为空',
        ]);
//        dd($request->name);
        $eventPrize = EventPrize::create([
            'name'=>$request->name,
            'events_id'=>$request->events_id,
            'description'=>$request->description,
            'member_id'=>0,
        ]);
        //设置提示信息
        session()->flash('success','添加活动奖品成功');
        return redirect()->route('eventPrizes.index');//跳转到
    }


    //修改抽奖活动页面
    public function edit(EventPrize $eventPrize)
    {
        //获取所有活动
        $events = Event::get();
        return view('eventPrize/edit',compact(['eventPrize','events']));
    }


    //修改抽奖活动功能
    public function update(EventPrize $eventPrize,Request $request)
    {
        //验证数据
        $this->validate($request,[
            'events_id'=>'required',
            'name'=>['required','max:10',Rule::unique('event_prizes')->ignore($eventPrize->id)],
            'description'=>'required',
        ],[
            'events_id.required'=>'活动不能为空',
            'name.required'=>'奖品名不能为空',
            'name.max'=>'奖品名不能大于10个字',
            'name.unique'=>'该奖品已存在',
            'description.required'=>'奖品详情不能为空',
        ]);

        $eventPrize->update([
            'name'=>$request->name,
            'events_id'=>$request->events_id,
            'description'=>$request->description,
            'member_id'=>$eventPrize->member_id,
        ]);
        //设置提示信息
        session()->flash('success','修改抽奖活动成功');
        return redirect()->route('eventPrizes.index');//跳转到
    }

    //删除抽奖活动
    public function destroy(EventPrize $eventPrize)
    {
        $eventPrize->delete();
        session()->flash('success','删除成功');
        return redirect()->route('eventPrizes.index');//跳转
    }

    //查看活动奖品详情
    public function show(EventPrize $eventPrize)
    {
        return view('eventPrize/show',compact('eventPrize'));
    }







}
