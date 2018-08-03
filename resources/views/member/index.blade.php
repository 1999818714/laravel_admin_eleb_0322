@extends('default')

@section('contents')
    @include('_errors')
    <form action="{{ route('members.index') }}" class="navbar-form navbar-left" method="get">
        <div class="form-group">
            <input type="text" class="form-control" name="keyword" placeholder="搜索...">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-zoom-in"></span></button>
    </form>
<table class="table table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>密码</th>
        <th>电话号码</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    @foreach($members as $member)
    <tr>
        <td>{{ $member->id }}</td>
        <td>{{ $member->username }}</td>
        <td>{{ $member->password }}</td>
        <td>{{ $member->status==1?'正常':'禁止' }}</td>
        <td>{{ $member->tel }}</td>
        <td><a href="{{ route('members.show',$member) }}" role="button" class="btn btn-primary">查看订会员</a>
            <a href="{{ route('members.status',[$member]) }}"  role="button" class="btn btn-primary">点击切换禁用(正常)</a>
        </td>
    </tr>
    @endforeach
</table>
{{ $members->appends(['keyword'=>$keyword])->links() }}

@stop