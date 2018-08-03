@extends('default')

@section('contents')
<table class="table  table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>活动名称</th>
        <th>活动详情</th>
        <th>活动开始时间</th>
        <th>活动结束时间</th>
        <th>操作</th>
    </tr>
    @foreach($activity as $v)
    <tr>
        <td>{{ $v->id }}</td>
        <td>{{ $v->title }}</td>
        <td>{{ $v->content }}</td>
        <td>{{ $v->start_time }}</td>
        <td>{{ $v->end_time }}</td>
        <td><a href="{{ route('activity.edit',[$v]) }}">编辑</a>
            <form method="post" action="
               {{ route('activity.destroy',[$v]) }}">
                {{ method_field('DELETE') }}{{--不写这个会报no message--}}
                {{ csrf_field() }}{{--不写这个会报时间那个错误--}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form></td>
    </tr>
    @endforeach
    <tr><td colspan="6"><a href="{{ route('activity.create') }}">添加活动</a></td></tr>
</table>
    {{ $activity/*->appends(['keyword'=>'水浒'])*/->links() }}
@endsection