@extends('default')

@section('contents')
    @include('_errors')
    <form action="{{ route('orders.index_month') }}" class="navbar-form navbar-left" method="get">
        <a href="{{ route('orders.index_day') }}" class="btn btn-primary" role="button">按日份统计</a>
        <a href="{{ route('orders.index') }}" class="btn btn-primary" role="button">按商家统计</a>
        <div class="form-group">
            <input type="month" class="form-control" name="keyword" >
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-zoom-in"></span></button>
        <span style="color: red">{{ $count }}</span>
    </form>
<table class="table table-bordered table-striped">
    <tr>
        <th>订单ID</th>
        <th>用户</th>
        <th>商家</th>
        <th>订单编号</th>
        <th>收获人姓名</th>
        <th>收获人电话</th>
        <th>价格</th>
        <th>状态</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    @foreach($orders as $order)
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->getMembers->username }}</td>
        <td>{{ $order->getShops->shop_name }}</td>
        <td>{{ $order->sn }}</td>
        <td>{{ $order->name }}</td>
        <td>{{ $order->tel }}</td>
        <td>{{ $order->total }}</td>
        <td>{{ $order->created_at }}</td>
        <td>{{ $order->new_status }}</td>
        <td><a href="{{ route('orders.show',$order) }}" role="button" class="btn btn-primary">查看订单</a></td>
    </tr>
    @endforeach
</table>
{{ $orders->appends(['keyword'=>$keyword])->links() }}

@stop