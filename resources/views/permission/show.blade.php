@extends('default')

@section('contents')
    <h1>查看权限信息</h1>
    <strong>ID: </strong><span style="color: #3097d1">{{ $permission->id }}</span><br><br>
    <strong>权限名: </strong><span style="color: #3097d1">{{ $permission->name }}</span><br><br>
    <strong>无名: </strong><span style="color: #3097d1">{{ $permission->guard_name }}</span><br><br>
    <strong>创建时间: </strong><span style="color: #3097d1">{{ $permission->created_at }}</span><br><br>
    <strong>修改时间: </strong><span style="color: #3097d1">{{ $permission->updated_at }}</span><br><br>
    <a href="javascript:history.go(-1);" role="button" class="btn btn-default">返回</a>

    <br><br><br><br><br><br><br><br>
@endsection
