@extends('default')

@section('contents')
<table class="table  table-striped table-bordered">
    <tr>
        <th>ID</th>
        <th>活动</th>
        <th>奖品名称</th>
        <th>中奖商家账号</th>
        <th>操作</th>
    </tr>
    @foreach($prizes as $prize)
    <tr>
        <td>{{ $prize->id }}</td>
        <td>{{ $prize->getEvents->title??'' }}</td>
        <td>{{ $prize->name }}</td>
        <td>{{ $prize->getMembers->username??'暂无用户中奖' }}</td>
        <td>
            <a href="{{ route('prizes.edit',[$prize,'id'=>$prize->events_id]) }}" role="button" class="btn btn-primary">编辑</a>
{{--            <a href="{{ route('prizes.show',[$prizes]) }}" role="button" class="btn btn-primary">活动奖品详情</a>--}}
            <form method="post" action="
               {{ route('prizes.destroy',[$prize,'id'=>$prize->events_id]) }}">
                {{ method_field('DELETE') }}{{--不写这个会报no message--}}
                {{ csrf_field() }}{{--不写这个会报时间那个错误--}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form></td>
    </tr>
    @endforeach
    <tr><td colspan="9"><a href="{{ route('prizes.create',['id'=>$events_id]) }}"  role="button" class="btn btn-primary">添加活动奖品</a></td></tr>
</table>
{{--{{ $prizes/*->appends(['keyword'=>'水浒'])*/->links() }}--}}
@endsection