@extends('default')

@section('contents')
<table class="table  table-striped">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>地址</th>
        <th>关联权限ID</th>
        <th>上级菜单ID</th>
        <th>操作</th>
    </tr>
    @foreach($navs as $nav)
    <tr>
        <td>{{ $nav->id }}</td>
        <td>
            {{ $nav->name }}
        </td>
        <td>{{ $nav->url }}</td>
        <td>{{ $nav->getPermissions->name??'无权限'}}</td>
        <td>{{ $nav->pid }}</td>
        <td><a href="{{ route('navs.edit',[$nav]) }}" role="button" class="btn btn-primary">编辑</a>
            <form method="post" action="
               {{ route('navs.destroy',[$nav]) }}">
                {{ method_field('DELETE') }}{{--不写这个会报no message--}}
                {{ csrf_field() }}{{--不写这个会报时间那个错误--}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form></td>
    </tr>
    @endforeach
    <tr><td colspan="5"><a href="{{ route('navs.create') }}"  role="button" class="btn btn-primary">添加菜单</a></td></tr>
</table>
{{ $navs/*->appends(['keyword'=>$keyword])*/->links() }}
@endsection