<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login/index');
    }
    //保存登录状态
    public function store(Request $request)
    {
//        dd(12);
        $this->validate($request,[
            'name'=>'required|max:10',
            'password'=>'required',
            //验证码
            'captcha' => 'required|captcha',
        ],[
            'name.required'=>'账号不能为空',
            'name.max'=>'账号不能大于10个字',
            'password.required'=>'密码不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);
        if(Auth::attempt([//认证
            'name'=>$request->name,
            'password'=>$request->password
        ],$request->remember)) {//认证通过
            //设置提示信息
            session()->flash('success','登录成功');
            return redirect()->route('admins.index');
        }else{//认证失败跳回去
            //设置提示信息
            session()->flash('danger','用户名或密码错误');
            return redirect()->back();
//            return back()->with('danger', '用户名或密码错误')->withInput();
        }
    }

    //注销
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.store')->with('success', '管理员退出成功');
    }

}
