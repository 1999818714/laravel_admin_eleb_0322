@extends('default')

@section('contents')
    @include('_errors')
<table class="table table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>角色名</th>
        <th>权限</th>
        <th>无名</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    @foreach($roles as $role)
    <tr>
        <td>{{ $role->id }}</td>
        <td>{{ $role->name }}</td>
        <td>
            @foreach($role->permissions as $v)
               {{ $v->name}}
            @endforeach
        </td>
        <td>{{ $role->guard_name }}</td>
        <td>{{ $role->created_at }}</td>
        <td><a href="{{ route('roles.edit',$role) }}" role="button" class="btn btn-primary">修改角色</a>
            <a href="{{ route('roles.show',$role) }}" role="button" class="btn btn-primary">查看角色</a>
            <form method="post" action="
               {{ route('roles.destroy',[$role]) }}">
                {{ method_field('DELETE') }}{{--不写这个会报no message--}}
                {{ csrf_field() }}{{--不写这个会报时间那个错误--}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form>
        </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="5"><a href="{{ route('roles.create') }}" role="button" class="btn btn-default">添加角色</a></td>
    </tr>
</table>
{{ $roles/*->appends(['keyword'=>$keyword])*/->links() }}

@stop