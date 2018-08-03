@extends('default')

@section('contents')
<table class="table  table-bordered table-striped">
    <tr>
        <th>id</th>
        <th>店铺分类</th>
        <th>名称</th>
        <th>店铺图片</th>
        <th>评分</th>
        {{--<th>是否是品牌</th>--}}
        {{--<th>是否准时送达</th>--}}
        {{--<th>是否蜂鸟配送</th>--}}
        {{--<th>是否保标记</th>--}}
        {{--<th>是否票标记</th>--}}
        {{--<th>是否准标记</th>--}}
        <th>起送金额</th>
        <th>配送费</th>
        <th>店公告</th>
        <th>优惠信息</th>
        <th>状态:1正常,0待审核,-1禁用</th>
        <th>操作</th>
    </tr>
    @foreach($shops as $shop)
    <tr>
        <td>{{ $shop->id }}</td>
        <td>{{ $shop->getShopCategoey->name }}</td>
        <td>{{ $shop->shop_name }}</td>
        {{--<td>{{ $shop->shop_img }}</td>--}}
        <td><img src="{{ $shop->shop_img }}" width="100px" height="80px" alt=""></td>
        <td>{{ $shop->shop_rating }}</td>
        {{--<td>{{ $shop->brand==1?'是':'否' }}</td>--}}
        {{--<td>{{ $shop->on_time==1?'是':'否' }}</td>--}}
        {{--<td>{{ $shop->fengniao==1?'是':'否'}}</td>--}}
        {{--<td>{{ $shop->bao==1?'是':'否' }}</td>--}}
        {{--<td>{{ $shop->piao==1?'是':'否' }}</td>--}}
        {{--<td>{{ $shop->zhun==1?'是':'否' }}</td>--}}
        <td>{{ $shop->start_send }}</td>
        <td>{{ $shop->send_cost }}</td>
        <td>{{ $shop->notice }}</td>
        <td>{{ $shop->discount }}</td>
        <td>@if($shop->status==1)
                正常
                @elseif($shop->status==0)
                待审核
                @else
                禁用
            @endif
        <td>
            <a href="{{ route('shops.edit',[$shop]) }}" role="button" class="btn btn-primary">编辑</a>
            <a href="{{ route('shops.show',[$shop]) }}" role="button" class="btn btn-primary">商家审核</a>
            {{--<form method="post" action="--}}
               {{--{{ route('shops.destroy',[$shop]) }}">--}}
                {{--{{ method_field('DELETE') }}--}}{{--不写这个会报no message--}}
                {{--{{ csrf_field() }}--}}{{--不写这个会报时间那个错误--}}
                {{--<button class="btn btn-danger btn-xs">删除</button>--}}
            {{--</form>--}}
        </td>
    </tr>
    @endforeach
    <tr>
{{--        <td colspan="5"><a href="{{ route('shops.create') }}">添加商家信息</a></td>--}}
    </tr>
</table>
    {{ $shops/*->appends(['keyword'=>'水浒'])*/->links() }}
@endsection

{{--shop_name	string	 名称--}}
{{--shop_img	string	 店铺图片--}}
{{--shop_rating	float	 评分--}}
{{--brand	     boolean 是否是品牌--}}
{{--on_time	     boolean 是否准时送达--}}
{{--fengniao	boolean	 是否蜂鸟配送--}}
{{--bao	         boolean 是否保标记--}}
{{--piao	     boolean 是否票标记--}}
{{--zhun	     boolean 是否准标记--}}
{{--start_send	float	 起送金额--}}
{{--send_cost	float	 配送费--}}
{{--notice	    string	 店公告--}}
{{--discount	string	 优惠信息--}}
{{--status	    int		 状态:1正常,0待审核,-1禁用--}}