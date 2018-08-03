@extends('default')

@section('contents')
<form class="form" method="post" action="{{ route('navs.store') }}" enctype="multipart/form-data">
    @include('_errors')
    <h1 class="container">添加菜单页面</h1>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">菜单名称</span>
        <input type="text" name="name" style="width:500px"  class="form-control" placeholder="菜单名称？" aria-describedby="basic-addon1">
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">地址</span>
        <input type="text" name="url" style="width:500px"  class="form-control" placeholder="地址？" aria-describedby="basic-addon1">
    </div><br>
    <span class="input-group-addon" style="width: 20px" id="basic-addon1">权限</span>
    <select name="permission_id" class="form-control"  style="width:400px;" >
        <option value="0">不添加权限</option>
        @foreach($permissions as $permission)
        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
        @endforeach
    </select><br>
    <span class="input-group-addon" style="width: 20px" id="basic-addon1">上级菜单</span>
    <select name="pid" class="form-control" style="width:400px;" >
        <option value="0">顶级菜单</option>
        @foreach($navs as $nav)
            <option value="{{ $nav->id }}">{{ $nav->name }}</option>
        @endforeach
    </select><br>
    {{ csrf_field() }}
    <br> <br>
    <input type="submit" class="btn btn-primary" value="确认添加菜单">
    <br><br><br><br><br><br><br>
</form>
@endsection