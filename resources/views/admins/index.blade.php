@extends('default')

@section('contents')
<table class="table  table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>管理员</th>
        <th>邮箱</th>
        <th>权限</th>
        <th>操作</th>
    </tr>
    @foreach($admins as $admin)
    <tr>
        <td>{{ $admin->id }}</td>
        <td>{{ $admin->name }}</td>
        <td>{{ $admin->email }}</td>
        <td>
            @foreach($admin->roles as $role)
                {{ $role->name }}
            @endforeach
        </td>
        <td><a href="{{ route('admins.edit',[$admin]) }}" role="button" class="btn btn-primary">编辑</a>
            <form method="post" action="
               {{ route('admins.destroy',[$admin]) }}">
                {{ method_field('DELETE') }}{{--不写这个会报no message--}}
                {{ csrf_field() }}{{--不写这个会报时间那个错误--}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form></td>
    </tr>
    @endforeach
    <tr><td colspan="5"><a href="{{ route('admins.create') }}"  role="button" class="btn btn-primary">添加管理员</a></td></tr>
</table>
    {{ $admins/*->appends(['keyword'=>'水浒'])*/->links() }}
@endsection