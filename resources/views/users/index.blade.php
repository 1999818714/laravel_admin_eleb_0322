@extends('default')

@section('contents')
<table class="table table-bordered table-striped">
    <tr>
        <th>id</th>
        <th>商家账号名</th>
        <th>邮箱</th>
        <th>状态</th>
        <th>所属商家</th>
        <th>操作</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->status?'启用':'禁用' }}</td>
        <td>{{ $user->getShops->shop_name}}</td>
        <td>
            <a href="{{ route('users.edit',[$user]) }}"  role="button" class="btn btn-primary">编辑</a>
            <a href="{{ route('users.status',[$user]) }}"  role="button" class="btn btn-primary">点击切换禁用(启动)</a>
            <a href="{{ route('users.reset',[$user]) }}"  role="button" class="btn btn-danger">重置密码</a>
        </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="7"><a href="{{ route('users.create') }}">添加商家账号</a></td>
    </tr>
</table>
    {{ $users/*->appends(['keyword'=>'水浒'])*/->links() }}
@endsection