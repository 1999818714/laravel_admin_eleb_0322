@extends('default')

@section('contents')
    @include('_errors')
<table class="table table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>权限名</th>
        <th>无名</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    @foreach($permissions as $permission)
    <tr>
        <td>{{ $permission->id }}</td>
        <td>{{ $permission->name }}</td>
        <td>{{ $permission->guard_name }}</td>
        <td>{{ $permission->created_at }}</td>
        <td><a href="{{ route('permissions.edit',$permission) }}" role="button" class="btn btn-primary">修改权限</a>
            <a href="{{ route('permissions.show',$permission) }}" role="button" class="btn btn-primary">查看权限</a>
            <form method="post" action="
               {{ route('permissions.destroy',[$permission]) }}">
                {{ method_field('DELETE') }}{{--不写这个会报no message--}}
                {{ csrf_field() }}{{--不写这个会报时间那个错误--}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form>
        </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="5"><a href="{{ route('permissions.create') }}" role="button" class="btn btn-primary">添加权限</a></td>
    </tr>
</table>
{{ $permissions/*->appends(['keyword'=>$keyword])*/->links() }}

@stop