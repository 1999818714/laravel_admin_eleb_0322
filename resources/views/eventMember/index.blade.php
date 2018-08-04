@extends('default')

@section('contents')
<table class="table  table-striped table-bordered">
    <tr>
        <th>活动报名表</th>
        <th>活动</th>
        <th>商家账号</th>
        <th>操作</th>
    </tr>
    @foreach($eventMembers as $event)
    <tr>
        <td>{{ $event->id }}</td>
        <td>{{ $event->getEvents->title }}</td>
        <td>{{ $event->getMembers->username }}</td>
        <td>
            <a href="{{ route('eventMember.edit',[$event]) }}" role="button" class="btn btn-primary">编辑</a>
            <a href="{{ route('eventMember.show',[$event]) }}" role="button" class="btn btn-primary">活动奖品详情</a>
            <form method="post" action="
               {{ route('eventMember.destroy',[$event]) }}">
                {{ method_field('DELETE') }}{{--不写这个会报no message--}}
                {{ csrf_field() }}{{--不写这个会报时间那个错误--}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form></td>
    </tr>
    @endforeach
    {{--<tr><td colspan="9"><a href="{{ route('events.create') }}"  role="button" class="btn btn-primary">添加活动奖品</a></td></tr>--}}
</table>
{{ $eventMembers/*->appends(['keyword'=>'水浒'])*/->links() }}
@endsection