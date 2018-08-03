<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    //权限列表
    public function index()
    {
        //获取权限数据
        $permissions = Permission::paginate(5);//带分页
        return view('permission/index',compact('permissions'));
    }
    //添加权限页面
    public function create()
    {
        return view('permission/create');
    }
    //添加权限功能
    public function store(Request $request)
    {
//        dd($request->name);
        //验证数据
        $this->validate($request,[
            'name'=>'required|min:1|unique:permissions',
        ],[
            'name.required'=>'权限名不能为空',
            'name.min'=>'权限名不能小于1个字',
            'name.unique'=>'权限名已存在',
        ]);

        $permission = Permission::create([
            'name'=>$request->name,
        ]);
        //设置提示信息
        session()->flash('success','添加权限成功');
        return redirect()->route('permissions.index');//跳转到
    }
    //修改权限页面
    public function edit(Permission $permission)
    {
        return view('permission/edit',compact('permission'));
    }
    //修改权限功能
    public function update(Permission $permission,Request $request)
    {
        //验证数据
        $this->validate($request,[
            'name'=>['required','min:1',Rule::unique('permissions')->ignore($permission->id)],
        ],[
            'name.required'=>'权限名不能为空',
            'name.min'=>'权限名不能小于1个字',
            'name.unique'=>'权限名已存在',
        ]);

        $permission->update([
            'name'=>$request->name,
        ]);
        //设置提示信息
        session()->flash('success','修改权限成功');
        return redirect()->route('permissions.index');//跳转到
    }

    //查看权限
    public function show(Permission $permission)
    {
        return view('permission/show',compact('permission'));
    }
    //删除权限
    public function destroy(Permission $permission){
        $permission->delete();
        //设置提示信息
        session()->flash('success','修改权限成功');
        return redirect()->route('permissions.index');//跳转到
    }

}
