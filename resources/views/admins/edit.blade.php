@extends('default')

@section('contents')
<form class="form" method="post" action="{{ route('admins.update',[$admin]) }}" enctype="multipart/form-data">
    @include('_errors')
    <h1 class="container">修改管理员页面</h1>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">管理员名称</span>
        <input type="text" name="name" style="width:500px"  class="form-control" placeholder="管理员名称？" aria-describedby="basic-addon1"
               value="@if(old('name')){{ old('name') }}@else{{ $admin->name }}@endif"
        >
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">邮箱</span>
        <input type="text" name="email" style="width:500px"  class="form-control" placeholder="邮箱？" aria-describedby="basic-addon1"
               value="@if(old('email')){{ old('email') }}@else{{ $admin->email }}@endif"
        >
    </div>
    <br>
    @foreach($roles as $role)
        <label class="radio-inline">
            <input type="checkbox" id="inlineRadio1" name="role[]" value="{{$role->id}}" @if($admin->hasRole($role))checked @endif > {{$role->name}}
        </label>
    @endforeach
    <br> <br>
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="确认修改">
    <br><br><br><br><br><br><br>
</form>
@endsection