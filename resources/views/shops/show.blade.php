@extends('default')

@section('contents')
    <h1>查看商家信息.设置状态</h1>
    <strong>店铺分类ID: </strong><span style="color: #3097d1">{{ $shop->getShopCategoey->name }}</span><br><br>
    <strong>名称: </strong><span style="color: #3097d1">{{ $shop->shop_name}}</span><br><br>
    <strong>店铺图片: </strong><span style="color: #3097d1"><img src="{{ $shop->shop_img }}" width="100px" height="80px" alt=""></span><br><br>
    <strong>评分: </strong><span style="color: #3097d1">{{ $shop->shop_rating}}</span><br><br>
    <strong>是否是品牌: </strong><span style="color: #3097d1">{{ $shop->brand==1?'是':'否'}}</span><br><br>
    <strong>是否准时送达: </strong><span style="color: #3097d1">{{ $shop->on_time==1?'是':'否'}}</span><br><br>
    <strong>是否蜂鸟配送: </strong><span style="color: #3097d1">{{ $shop->fengniao==1?'是':'否'}}</span><br><br>
    <strong>是否保标记: </strong><span style="color: #3097d1">{{ $shop->bao==1?'是':'否' }}</span><br><br>
    <strong>是否票标记: </strong><span style="color: #3097d1">{{ $shop->piao==1?'是':'否' }}</span><br><br>
    <strong>是否准标记: </strong><span style="color: #3097d1">{{ $shop->zhun==1?'是':'否' }}</span><br><br>
    <strong>起送金额: </strong><span style="color: #3097d1">{{ $shop->start_send}}</span><br><br>
    <strong>配送费: </strong><span style="color: #3097d1">{{ $shop->send_cost}}</span><br><br>
    <strong>店公告: </strong><span style="color: #3097d1">{{ $shop->notice }}</span><br><br>
    <strong>优惠信息: </strong><span style="color: #3097d1">{{ $shop->discount}}</span><br><br>
    <strong style="font-size: 5ex">当前状态:: </strong><span style="color: #3097d1;font-size: 5ex">@if($shop->status==1)
            正常
        @elseif($shop->status==0)
            待审核
        @else
            禁用
        @endif</span><br><br>
    {{--<form class="form" method="post" action="{{ route('shops.status',[$shop]) }}" enctype="multipart/form-data">--}}
        @include('_errors')
        @if($shop->status==1){{--//正常--}}
            <a href="{{ route('shops.status',[$shop,'status'=>-1]) }}" class="btn btn-primary" role="button">确认禁用！</a>
            <a href="{{ route('shops.status',[$shop,'status'=>0]) }}" class="btn btn-primary" role="button">改为未审核！</a>
        @elseif($shop->status==0){{--//待审核--}}
        <a href="{{ route('shops.status',[$shop,'status'=>-1]) }}" class="btn btn-primary" role="button">确认禁用！</a>
        <a href="{{ route('shops.status',[$shop,'status'=>1]) }}" class="btn btn-primary" role="button">确认审核！</a>
        @else{{--//禁用--}}
        <a href="{{ route('shops.status',[$shop,'status'=>0]) }}" class="btn btn-primary" role="button">解除禁用！</a>
        <a href="{{ route('shops.status',[$shop,'status'=>1]) }}" class="btn btn-primary" role="button">解除禁用！（直接审核）</a>
        @endif
    <a href="javascript:history.go(-1);" role="button" class="btn btn-default">不想改？返回</a>
    {{--</form>--}}
    <br><br><br><br><br><br><br><br>
    {{--shop_category_id             店铺分类ID--}}
    {{--shop_name	      string	 名称--}}
    {{--shop_img	      string	 店铺图片--}}
    {{--shop_rating	      float	     评分--}}
    {{--brand	           boolean   是否是品牌--}}
    {{--on_time	           boolean   是否准时送达--}}
    {{--fengniao	      boolean	 是否蜂鸟配送--}}
    {{--bao	               boolean   是否保标记--}}
    {{--piao	           boolean   是否票标记--}}
    {{--zhun	           boolean   是否准标记--}}
    {{--start_send	      float	     起送金额--}}
    {{--send_cost	      float	     配送费--}}
    {{--notice	          string	 店公告--}}
    {{--discount	      string	 优惠信息--}}
    {{--status	          int		 状态:1正常,0待审核,-1禁用--}}
@endsection
