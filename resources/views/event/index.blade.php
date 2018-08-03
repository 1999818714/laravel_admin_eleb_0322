@extends('default')

@section('contents')
<table class="table  table-striped table-bordered">
    <tr>
        <th>ID</th>
        <th>活动标题</th>
        <th>详情</th>
        <th>报名开始时间</th>
        <th>报名结束时间</th>
        <th>开奖日期</th>
        <th>报名人数限制</th>
        <th>是否已开奖</th>
        <th>操作</th>
    </tr>
    @foreach($events as $event)
    <tr>
        <td>{{ $event->id }}</td>
        <td>{{ $event->title }}</td>
        <td>{!! $event->content !!}</td>
        <td>{{ date('Y-m-d',$event->signup_start) }}</td>
        <td>{{ date('Y-m-d',$event->signup_end) }}</td>
        <td>{{ $event->prize_date }}</td>
        <td>{{ $event->signup_num }}人</td>
        <td>{{ $event->is_prize==1?'已开奖':'未开奖' }}</td>
        <td>
            <a href="{{ route('events.edit',[$event]) }}" role="button" class="btn btn-primary">编辑</a>
            <a href="{{ route('events.show',[$event]) }}" role="button" class="btn btn-primary">活动详情</a>
            <form method="post" action="
               {{ route('events.destroy',[$event]) }}">
                {{ method_field('DELETE') }}{{--不写这个会报no message--}}
                {{ csrf_field() }}{{--不写这个会报时间那个错误--}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form></td>
    </tr>
    @endforeach
    <tr><td colspan="9"><a href="{{ route('events.create') }}"  role="button" class="btn btn-primary">添加抽奖活动</a></td></tr>
</table>
{{ $events/*->appends(['keyword'=>'水浒'])*/->links() }}
@endsection