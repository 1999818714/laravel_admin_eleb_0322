@extends('default')

@section('contents')
<form class="form" method="post" action="{{ route('permissions.update',[$permission]) }}" enctype="multipart/form-data">
    @include('_errors')
    <h1 class="container">修改权限页面</h1>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">权限名称</span>
        <input type="text" name="name" style="width:500px"  class="form-control" placeholder="权限名称？" aria-describedby="basic-addon1"
               value="@if(old('name')){{ old('name') }}@else{{ $permission->name }}@endif"
        >
    </div><br>
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="确认修改">
    <br><br><br><br><br><br><br>
</form>
@endsection