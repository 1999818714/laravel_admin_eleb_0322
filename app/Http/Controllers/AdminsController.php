<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{
    //权限
    public function __construct()
    {
        $this->middleware('auth',[
//            'only'=>['info'],//（登录后可以查看的）该中间件只对这些方法生效
            'except'=>['index'],//（未登录可以查看的）该中间件除了这些方法，对其他方法生效
        ]);
    }

    //管理员列表
    public function index()
    {
        $admins = Admin::paginate(5);//包含分页
        return view('admins/index',compact('admins'));
    }
    //添加管理员页面
    public function create()
    {
        //获取角色
        $roles = Role::get();
        return view('admins/create',compact('roles'));
    }
    //添加管理员功能
    public function store(Request $request)
    {
        //验证数据
        $this->validate($request,[
            'name'=>'required|max:20|unique:admins',
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:5|confirmed',
            'role'=>'required',
        ],[
            'name.required'=>'管理员名不能为空',
            'name.max'=>'管理员名不能大于20个字',
            'name.unique'=>'管理员名已存在',
            'email.required'=>'邮箱名不能为空',
            'email.email'=>'邮箱不能重复',
            'email.unique'=>'邮箱已存在',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码不能小于5位',
            'password.confirmed'=>'密码和确认密码不相同',
            'role.required'=>'角色不能为空',
        ]);

        $admin = Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ])->assignRole($request->role);
        //设置提示信息
        session()->flash('success','添加管理员成功');
        return redirect()->route('admins.index');//跳转到
    }


    //修改管理员页面
    public function edit(Admin $admin)
    {
        //获取角色
        $roles = Role::get();
        return view('admins/edit',compact(['roles','admin']));
    }
    //修改管理员功能
    public function update(Admin $admin, Request $request)
    {
        //验证数据
        $this->validate($request,[
            'name'=>['required','max:20',Rule::unique('admins')->ignore($admin->id)],
            'email'=>['required','email',Rule::unique('admins')->ignore($admin->id)],
            'role'=>'required',
        ],[
            'name.required'=>'管理员名不能为空',
            'name.max'=>'管理员名不能大于20个字',
            'name.unique'=>'管理员名已存在',
            'email.required'=>'邮箱名不能为空',
            'email.email'=>'邮箱不能重复',
            'email.unique'=>'邮箱已存在',
            'role.required'=>'角色不能为空',
        ]);

        //赋予角色
        $admin = $admin->syncRoles($request->role)->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);

        //设置提示信息
        session()->flash('success','修改管理员成功');
        return redirect()->route('admins.index');//跳转到
    }

    //删除管理员
    public function destroy(Admin $admin)
    {
        $admin->delete();
        session()->flash('success','删除成功');
        return redirect()->route('admins.index');//跳转
    }

    //修改管理员密码页面
    public function editPassword()
    {
//        dd(12);
        return view('admins/editPassword');
    }
    //修改管理员密码功能
    public function updatePassword(Request $request)
    {
        //验证数据
        $this->validate($request,[
            'oldpassword'=>'required',
            'password'=>'required|min:5|confirmed',
        ],[
            'name.max'=>'商家账号名不能大于20个字',
            'oldpassword.required'=>'旧密码不能为空',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码不能小于5位',
            'password.confirmed'=>'密码和确认密码不相同',
        ]);
        $oldpassword = $request->oldpassword;//旧密码(未加密)
        $db_password = auth()->user()->password;//数据库原密码(加密的）
        if(Hash::check($oldpassword,$db_password)){//第一个不加密，第二个加密
            //验证成功，将填写密码加密放到数据库中
            $password = $request->password;
            $newPassword = bcrypt($password);//加密
            $id = auth()->user()->id;//获取当前管理员登录的ID
            $admin = Admin::find($id);//获取当前管理员的一行记录
            $admin->update([
                'password'=>$newPassword,
            ]);
            //设置提示信息
            session()->flash('success','修改管理员密码成功');
            return redirect()->route('admins.index');//跳转到
        }else{
            session()->flash('danger','旧密码错误');
            return redirect()->back();//跳回去
        }
    }

}
