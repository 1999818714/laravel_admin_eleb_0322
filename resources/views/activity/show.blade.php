@extends('default')

@section('contents')
    <h1>查看抽奖活动信息</h1>
    <strong>ID: </strong><span style="color: #3097d1">{{ $activity->id }}</span><br><br>
    <strong>活动名称: </strong><span style="color: #3097d1">{{ $activity->title }}</span><br><br>
    <strong>活动详情: </strong><span style="color: #3097d1">{!! $activity->content !!}</span><br><br>
    <strong>活动开始时间: </strong><span style="color: #3097d1">{{ $activity->start_time }}</span><br><br>
    <strong>活动结束时间: </strong><span style="color: #3097d1">{{ $activity->end_time }}</span><br><br>
    <strong>添加时间: </strong><span style="color: #3097d1">{{ $activity->created_at }}</span><br><br>
    <strong>修改时间: </strong><span style="color: #3097d1">{{ $activity->updated_at }}</span><br><br>
    <a href="javascript:history.go(-1);" role="button" class="btn btn-default">返回</a>

    <br><br><br><br><br><br><br><br>
@endsection