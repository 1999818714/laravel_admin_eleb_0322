@extends('default')

@section('contents')
    <h1>查看会员信息</h1>
    <strong>ID: </strong><span style="color: #3097d1">{{ $member->id }}</span><br><br>
    <strong>用户名: </strong><span style="color: #3097d1">{{ $member->username }}</span><br><br>
    <strong>密码: </strong><span style="color: #3097d1">{{ $member->password }}</span><br><br>
    <strong>电话号码: </strong><span style="color: #3097d1">{{ $member->tel }}</span><br><br>
    <strong>状态: </strong><span style="color: #3097d1">{{ $member->remember_token }}</span><br><br>

    <a href="javascript:history.go(-1);" role="button" class="btn btn-default">返回</a>

    <br><br><br><br><br><br><br><br>
@endsection
