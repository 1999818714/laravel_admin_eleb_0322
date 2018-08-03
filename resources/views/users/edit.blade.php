@extends('default')

@section('contents')
<form class="form" method="post" action="{{ route('users.update',[$user]) }}" enctype="multipart/form-data">
    @include('_errors')
    <h1 class="container">修改商家账号页面</h1>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">商家账号名</span>
        <input type="text" name="name" style="width:500px"  class="form-control" placeholder="商家账号名？" aria-describedby="basic-addon1"
               value="@if(old('name')){{ old('name') }}@else{{ $user->name }}@endif"
        >
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">邮箱</span>
        <input type="text" name="email" style="width:500px"  class="form-control" placeholder="邮箱？" aria-describedby="basic-addon1"
               value="@if(old('email')){{ old('email') }}@else{{ $user->email }}@endif"
        >
    </div><br>
    <div  class="col-sm-4  input-group">
        <span class="input-group-addon" id="basic-addon1">所属商家</span>
        <select class="form-control" name="shop_id">
            @foreach($shops as $shop)
                <option value="{{ $shop->id }}"  @if($shop->id == $user->shop_id)selected @endif >{{ $shop->shop_name }}</option>
            @endforeach
        </select>
    </div><br>
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="确认修改">
    <a href="javascript:history.go(-1);" role="button" class="btn btn-default">不想改？点击返回</a>

    <br><br><br><br><br><br><br><small>由艾森公司支持</small>
</form>
@endsection