<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class NavsController extends Controller
{
    //权限
    public function __construct()
    {
        $this->middleware('auth',[
//            'only'=>['info'],//（登录后可以查看的）该中间件只对这些方法生效
            'except'=>['index'],//（未登录可以查看的）该中间件除了这些方法，对其他方法生效
        ]);
    }

    //菜单列表
    public function index(){
        //获取所有菜单
//        $navs = Nav::get();
        $navs = Nav::paginate(20);
        return view('nav/index',compact('navs'));
    }

    //添加管理员页面
    public function create()
    {
        //获取所有权限
        $permissions = Permission::get();
        //获取所有权限
        $navs = Nav::get();
        return view('nav/create',compact(['permissions','navs']));
    }
    //添加管理员功能
    public function store(Request $request)
    {
        //验证数据
        $this->validate($request,[
            'name'=>'required|max:20|unique:navs',
//            'url'=>'required',
//            'permission'=>'required',
        ],[
            'name.required'=>'菜单名不能为空',
            'name.max'=>'菜单名不能大于20个字',
            'name.unique'=>'菜单名已存在',
//            'url.required'=>'地址不能为空',
//            'permission.required'=>'权限不能为空',
        ]);
        Nav::create([
            'name'=>$request->name,
            'url'=>$request->url??'',
            'permission_id'=>$request->permission_id??'',
            'pid'=>$request->pid
        ]);
        //设置提示信息
        session()->flash('success','添加菜单成功');
        return redirect()->route('navs.index');//跳转到
    }


    //修改管理员页面
    public function edit(Nav $nav)
    {
        //获取所有权限
        $permissions = Permission::get();
        //获取角色
        $navs = Nav::get();
        return view('nav/edit',compact(['permissions','nav','navs']));
    }
    //修改管理员功能
    public function update(Nav $nav,Request $request)
    {
        //验证数据
        $this->validate($request,[
            'name'=>['required','max:20',Rule::unique('navs')->ignore($nav->id)],
        ],[
            'name.required'=>'菜单名不能为空',
            'name.max'=>'菜单名不能大于20个字',
            'name.unique'=>'菜单名已存在',
        ]);
        $nav->update([
            'name'=>$request->name,
            'url'=>$request->url??'',
            'permission_id'=>$request->permission_id??0,
            'pid'=>$request->pid
        ]);
        //设置提示信息
        session()->flash('success','修改菜单成功');
        return redirect()->route('navs.index');//跳转到
    }

    //删除管理员
    public function destroy(Nav $nav)
    {
        $nav->delete();
        session()->flash('success','删除成功');
        return redirect()->route('navs.index');//跳转
    }






}
