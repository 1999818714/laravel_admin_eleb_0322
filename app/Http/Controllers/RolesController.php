<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use \Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    //角色列表
    public function index()
    {
        //获取角色数据
        $roles = Role::paginate(5);//带分页
        return view('role/index',compact('roles'));
    }
    //添加角色页面
    public function create()
    {
        //获得权限，给角色赋值
        $permissions = Permission::get();//带分页
        return view('role/create',compact('permissions'));
    }
    //添加角色功能
    public function store(Request $request)
    {
//        dd($request->permission);
        //验证数据
        $this->validate($request, [
            'name' => 'required|min:1|unique:roles',
            'permission' => 'required',
        ], [
            'name.required' => '角色名不能为空',
            'name.min' => '角色名不能小于1个字',
            'name.unique' => '角色名已存在',
            'permission.required' => '权限名不能为空',
        ]);
        //开启事务
        DB::beginTransaction();
        try {
            $roles = Role::create([
                'name' => $request->name
            ]);

            //赋予权限
            //$role = Role::findByName($request->name);//找到角色
            $roles->givePermissionTo($request->permission);//赋于权限
            //提交事务
            DB::commit();
            //设置提示信息
            session()->flash('success', '添加角色成功');
            return redirect()->route('roles.index');//跳转到
        } catch (\Exception $ex) {
            //回滚事务
            DB::rollback();
            //设置提示信息
            session()->flash('danger', '添加角色失败');
            return redirect()->route('roles.create');//跳转到
        }
    }
    //修改角色页面
    public function edit(Role $role)
    {
        //获得权限，给角色赋值
        $permissions = Permission::get();//带分页
        return view('role/edit',compact(['role','permissions']));
    }

    //修改角色功能
    public function update(Role $role,Request $request)
    {
        //验证数据
        $this->validate($request,[
            'name'=>['required','min:1',Rule::unique('roles')->ignore($role->id)],
            'permission'=>'required',
        ],[
            'name.required'=>'角色名不能为空',
            'name.min'=>'角色名不能小于1个字',
            'name.unique'=>'角色名已存在',
            'permission.required'=>'权限名不能为空',
        ]);

        //开启事务
        DB::beginTransaction();
        try {
            $role->update([
                'name'=>$request->name
            ]);
            //赋予权限
             $role->syncPermissions($request->permission);//修改赋于权限
            //提交事务
            DB::commit();
            //设置提示信息
            session()->flash('success','修改角色成功');
            return redirect()->route('roles.index');//跳转到
        } catch (\Exception $ex) {
            //回滚事务
            DB::rollback();
            //设置提示信息
            session()->flash('danger', '修改角色失败');
            return redirect()->route('roles.edit',[$role]);//跳转到
        }
    }

    //查看角色
    public function show(Role $role)
    {
        return view('roles/show',compact('role'));
    }
    //删除角色
    public function destroy(Role $role){
        $role->delete();
//        $role->revokePermissionTo($role->name);
        //设置提示信息
        session()->flash('success','删除角色成功');
        return redirect()->route('roles.index');//跳转到
    }
}
