<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RbacController extends Controller
{
    //
    public function index(){
//        return 'index';
        //添加权限
//        $permission = Permission::create(['name'=>'users_create']);
        //修改权限
//        $permission = Permission::findById(1);
//        $permission->update(['name'=>'users_update'],['id'=>1]);
        //删除
//        $permission->delete();

        //角色
        //添加角色并且赋予权限
//        $role = Role::create(['name'=>'超级管理员']);//1
//        $role = Role::findByName('超级管理员');//1
//        $role->givePermissionTo('超级管理员');//赋予权限2
        //撤销
//        $role->revokePermissionTo('超级管理员');//2

    }
}
