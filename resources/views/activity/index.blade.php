@extends('default')

@section('contents')
<table class="table  table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>活动名称</th>
        <th>活动开始时间</th>
        <th>活动结束时间</th>
        <th>操作</th>
    </tr>
    @foreach($activitys as $activity)
    <tr>
        <td>{{ $activity->id }}</td>
        <td>{{ $activity->title }}</td>
        <td>{{ $activity->start_time }}</td>
        <td>{{ $activity->end_time }}</td>
        <td>
            <a href="{{ route('activity.edit',[$activity]) }}" role="button" class="btn btn-primary">编辑</a>
            <a href="{{ route('activity.show',[$activity]) }}" role="button" class="btn btn-primary">查看详情</a>
            <form method="post" action="
               {{ route('activity.destroy',[$activity]) }}">
                {{ method_field('DELETE') }}{{--不写这个会报no message--}}
                {{ csrf_field() }}{{--不写这个会报时间那个错误--}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form></td>
    </tr>
    @endforeach
    <tr><td colspan="6"><a href="{{ route('activity.create') }}">添加活动</a></td></tr>
</table>
    {{ $activitys/*->appends(['keyword'=>'水浒'])*/->links() }}
@endsection