@extends('default')

@section('contents')
    @include('_errors')
    <form action="{{ route('orderGoods.index_day') }}" class="navbar-form navbar-left" method="get">
        <a href="{{ route('orderGoods.index_month') }}" class="btn btn-primary" role="button">按月份统计</a>
        <a href="{{ route('orderGoods.index') }}" class="btn btn-primary" role="button">按商家统计</a>
        <div class="form-group">
            <input type="date" class="form-control" name="keyword">
            {{--<input type="month" class="form-control" name="keyword" >--}}
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-zoom-in"></span></button>
        <span style="color: red">{{ $count }}</span>
    </form>
<table class="table table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>订单ID</th>
        {{--<th>商品ID</th>--}}
        <th>商品名称</th>
        <th>商品数量</th>
        <th>商品图片</th>
        <th>商品价格</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    @foreach($orderGoods as $good)
    <tr>
        <td>{{ $good->id }}</td>
        <td>{{ $good->order_id }}</td>
        {{--<td>{{ $good->goods_id }}</td>--}}
        <td>{{ $good->goods_name }}</td>
        <td>{{ $good->amount }}</td>
        <td><img src="{{ $good->goods_img }}" width="100px" height="80px" alt=""></td>
        <td>{{ $good->goods_price }}</td>
        <td>{{ $good->created_at }}</td>
        <td><a href="{{ route('orderGoods.show',$orderGoods) }}" role="button" class="btn btn-primary">查看订单商品</a></td>
    </tr>
    @endforeach
</table>
{{ $orderGoods->appends(['keyword'=>$keyword])->links() }}

@stop