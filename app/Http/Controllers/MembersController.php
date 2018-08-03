<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    //权限
    public function __construct()
    {
        $this->middleware('auth',[
//            'only'=>['info'],//（登录后可以查看的）该中间件只对这些方法生效
            'except'=>['index'],//（未登录可以查看的）该中间件除了这些方法，对其他方法生效
        ]);
    }

    //会员列表
    public function index(Request $request)
    {
        //搜索
        $keyword = '';//商家ID
        if($request->keyword){
            $keyword = $request->keyword;
            $members = Member::where('username','like','%'.$keyword.'%')->paginate(5);//包含功能分页搜索
        }else{
            $members = Member::paginate(5);//包含功能分页
        }
        return view('member/index',compact(['members','keyword']));
    }


    //查看会员
    public function show(Member $member)
    {
        return view('member/show',compact('member'));
    }


    //商家审核信息修改功能
    public function status(Member $member)
    {
        $status = $member->status;
//        dd($status);
        if($status == 1){
            $status = 0;//禁止
        }elseif($status == 0){
            $status = 1;//启动
        }
        $member->update([
            'status'=>$status
        ]);

        //设置提示信息
        if($status == 1){//启动改为禁止
            session()->flash('success','已设置为禁止');
        }elseif ($status == 0){//禁止改为启动
            session()->flash('success','恢复正常');
        }
        return redirect()->route('members.index');//跳转到
    }


}
