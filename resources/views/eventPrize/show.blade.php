@extends('default')

@section('contents')
    <h1>查看抽奖活动信息</h1>
    <strong>ID: </strong><span style="color: #3097d1">{{ $eventPrize->id }}</span><br><br>
    <strong>活动: </strong><span style="color: #3097d1">{{ $eventPrize->getEvents->title??'' }}</span><br><br>
    <strong>奖品名称: </strong><span style="color: #3097d1">{{ $eventPrize->name }}</span><br><br>
    <strong>中奖商家账号: </strong><span style="color: #3097d1">{{ $eventPrize->getMembers->username??'暂无用户中奖' }}</span><br><br>
    <strong>奖品详情: </strong><span style="color: #3097d1">{!! $eventPrize->description !!}</span><br><br>
    <strong>添加时间: </strong><span style="color: #3097d1">{{ $eventPrize->created_at }}</span><br><br>
    <strong>修改时间: </strong><span style="color: #3097d1">{{ $eventPrize->updated_at }}</span><br><br>
    <a href="javascript:history.go(-1);" role="button" class="btn btn-default">返回</a>

    <br><br><br><br><br><br><br><br>
@endsection