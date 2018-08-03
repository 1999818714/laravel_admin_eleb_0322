@extends('default')

@section('contents')
<form class="form" method="post" action="{{ route('users.confirm',[$user]) }}" enctype="multipart/form-data">
    @include('_errors')
    <h1 class="container">重置密码页面</h1>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">商家账号名</span>
        <input type="text" name="name" style="width:500px"  class="form-control" placeholder="商家账号名？" aria-describedby="basic-addon1"
               value="@if(old('name')){{ old('name') }}@else{{ $user->name }}@endif"
        disabled>{{--//此为不可修改--}}
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">密码</span>
        <input type="password" name="password" style="width:500px"  class="form-control" placeholder="密码？" aria-describedby="basic-addon1">
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">确认密码</span>
        <input type="password" name="password_confirmation" style="width:500px"  class="form-control" placeholder="确认密码？" aria-describedby="basic-addon1">
    </div><br>
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="确认重置">
    <a href="javascript:history.go(-1);" role="button" class="btn btn-default">不想改？点击返回</a>

    <br><br><br><br><br><br><br>
</form>
@endsection