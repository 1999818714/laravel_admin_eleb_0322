@extends('default')

@section('contents')
<form class="form" method="post" action="{{ route('admins.store') }}" enctype="multipart/form-data">
    @include('_errors')
    <h1 class="container">添加管理员页面</h1>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">管理员名称</span>
        <input type="text" name="name" style="width:500px"  class="form-control" placeholder="管理员名称？" aria-describedby="basic-addon1">
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">邮箱</span>
        <input type="text" name="email" style="width:500px"  class="form-control" placeholder="邮箱？" aria-describedby="basic-addon1">
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">密码</span>
        <input type="password" name="password" style="width:500px"  class="form-control" placeholder="密码？" aria-describedby="basic-addon1">
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">确认密码</span>
        <input type="password" name="password_confirmation" style="width:500px"  class="form-control" placeholder="确认密码？" aria-describedby="basic-addon1">
    </div><br>
    @foreach($roles as $role)
        <label class="radio-inline">
            <input type="checkbox" id="inlineRadio1" name="role[]" value="{{$role->id}}"> {{$role->name}}
        </label>
    @endforeach
    {{ csrf_field() }}
    <br> <br>
    <input type="submit" class="btn btn-primary" value="确认注册">
    <br><br><br><br><br><br><br>
</form>
@endsection