@extends('default')

@section('contents')
    <h1>查看抽奖活动信息</h1>
    <strong>ID: </strong><span style="color: #3097d1">{{ $event->id }}</span><br><br>
    <strong>活动标题: </strong><span style="color: #3097d1">{{ $event->title }}</span><br><br>
    <strong>详情: </strong><span style="color: #3097d1">{!! $event->content !!} </span><br><br>
    <strong>报名开始时间: </strong><span style="color: #3097d1">{{ date('Y-m-d',$event->signup_start) }}</span><br><br>
    <strong>报名结束时间: </strong><span style="color: #3097d1">{{ date('Y-m-d',$event->signup_end) }}</span><br><br>
    <strong>开奖日期: </strong><span style="color: #3097d1">{{ $event->prize_date }}</span><br><br>
    <strong>报名人数限制: </strong><span style="color: #3097d1">{{ $event->signup_num }}</span><br><br>
    <strong>是否已开奖: </strong><span style="color: #3097d1">{{ $event->is_prize?'已开奖':'未开奖' }}</span><br><br>
    <strong>添加时间: </strong><span style="color: #3097d1">{{ $event->created_at }}</span><br><br>
    <strong>修改时间: </strong><span style="color: #3097d1">{{ $event->updated_at }}</span><br><br>

    {{--<a href="{{ route('events.edit',[$event]) }}" role="button" class="btn btn-primary">编辑</a>--}}

    <a href="javascript:history.go(-1);" role="button" class="btn btn-default">返回</a>

    <br><br><br><br><br><br><br><br>
@endsection