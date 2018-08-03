@extends('default')

@section('contents')
<form class="form" method="post" action="{{ route('navs.update',[$nav]) }}" enctype="multipart/form-data">
    @include('_errors')
    <h1 class="container">修改菜单页面</h1>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">菜单名称</span>
        <input type="text" name="name" style="width:500px"  class="form-control" placeholder="菜单名称？" aria-describedby="basic-addon1"
               value="@if(old('name')){{ old('name') }}@else{{ $nav->name }}@endif"
        >
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">地址</span>
        <input type="text" name="url" style="width:500px"  class="form-control" placeholder="地址？" aria-describedby="basic-addon1"
               value="@if(old('url')){{ old('url') }}@else{{ $nav->url }}@endif"
        >
    </div><br>
    <span class="input-group-addon" style="width: 20px" id="basic-addon1">权限</span>
    <select name="permission_id" class="form-control"  style="width:400px;" >
        <option value="">不添加权限</option>
        @foreach($permissions as $permission)
        <option value="{{ $permission->id }}" @if($permission->id == $nav->permission_id)selected @endif >{{ $permission->name }}</option>
        @endforeach
    </select><br>
    <span class="input-group-addon" style="width: 20px" id="basic-addon1">上级菜单</span>
    <select name="pid" class="form-control" style="width:400px;" >
        <option value="0">顶级菜单</option>
        @foreach($navs as $v)
            <option value="{{ $v->id }}"  @if($nav->pid == $v->id)selected @endif >{{ $v->name }}</option>
        @endforeach
    </select><br>
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <br> <br>
    <input type="submit" class="btn btn-primary" value="确认修改菜单">
    <br><br><br><br><br><br><br>
</form>
@endsection