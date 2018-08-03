@extends('default')

@section('contents')
<form class="form" method="post" action="{{ route('roles.store') }}" enctype="multipart/form-data">
    @include('_errors')
    <h1 class="container">添加角色页面</h1>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">角色名称</span>
        <input type="text" name="name" style="width:500px"  class="form-control" placeholder="角色名称？" aria-describedby="basic-addon1">
    </div><br>
    @foreach($permissions as $permission)
        <label class="checkbox-inline">
            <input type="checkbox" id="inlineCheckbox1" name="permission[]" value="{{ $permission->id }}"> {{$permission->name}}
        </label>
    @endforeach
    <br><br>
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="确认添加">
    <br><br><br><br><br><br><br>
</form>
@endsection