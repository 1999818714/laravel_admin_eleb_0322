@extends('default')

@section('contents')
<form class="form" method="post" action="{{ route('admins.updatePassword') }}" enctype="multipart/form-data">
    @include('_errors')
    <h1 class="container">修改管理员密码页面</h1>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">管理员名称</span>
        <input type="text" name="name" style="width:500px"  class="form-control" placeholder="Disabled input here..."  aria-describedby="basic-addon1"
               value="@if(old('name')){{ old('name') }}@else{{ auth()->user()->name }}@endif"
        disabled>
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">旧密码</span>
        <input type="password" name="oldpassword" style="width:500px"  class="form-control" placeholder="密码？" aria-describedby="basic-addon1">
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">密码</span>
        <input type="password" name="password" style="width:500px"  class="form-control" placeholder="密码？" aria-describedby="basic-addon1">
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">确认密码</span>
        <input type="password" name="password_confirmation" style="width:500px"  class="form-control" placeholder="确认密码？" aria-describedby="basic-addon1">
    </div><br>
    <br>
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="确认修改">
    <br><br><br><br><br><br><br>
</form>
@endsection