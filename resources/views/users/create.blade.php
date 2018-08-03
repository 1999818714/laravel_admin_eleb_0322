@extends('default')

@section('contents')
<form class="form" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
    @include('_errors')
    <h1 class="container">添加商家账号页面</h1>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">商家账号名</span>
        <input type="text" name="name" style="width:500px"  class="form-control" placeholder="商家账号名？" aria-describedby="basic-addon1">
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


    <h1 class="container">添加商家信息</h1>
    <div  class="col-sm-4  input-group">
        <span class="input-group-addon" id="basic-addon1">店铺分类ID</span>
        <select class="form-control" name="shop_category_id">
            @foreach($shopCategory as $v)
                <option value="{{ $v->id }}">{{ $v->name }}</option>
            @endforeach
        </select>
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">名称</span>
        <input type="text" name="shop_name" style="width:500px"  class="form-control" placeholder="名称？" aria-describedby="basic-addon1">
    </div><br>
    <div class="form-group">
        <label for="exampleInputFile">店铺图片</label>
        <input type="file" name="shop_img" id="exampleInputFile">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">评分</span>
        <input type="number" name="shop_rating" style="width:500px"  class="form-control" placeholder="评分？" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">是否是品牌</span>
        是<input type="radio" value="1" id="inlineRadio1" checked name="brand" aria-describedby="basic-addon1">
        否<input type="radio" value="0" name="brand" id="inlineRadio2" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">是否准时送达</span>
        是<input type="radio" value="1" checked name="on_time" aria-describedby="basic-addon1">
        否<input type="radio" value="0"   name="on_time" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">是否蜂鸟配送</span>
            是<input type="radio" value="1" checked name="fengniao" aria-describedby="basic-addon1">
            否<input type="radio" value="0"   name="fengniao" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">是否保标记</span>
        是<input type="radio" value="1" checked name="bao" aria-describedby="basic-addon1">
        否<input type="radio" value="0" name="bao" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">是否票标记</span>
        是<input type="radio" value="1" checked name="piao" aria-describedby="basic-addon1">
        否<input type="radio" value="0" name="piao" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">是否准标记</span>
        是<input type="radio" value="1" checked name="zhun" aria-describedby="basic-addon1">
        否<input type="radio" value="0" name="zhun" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">起送金额(元)</span>
        <input type="number" name="start_send" style="width:500px"  class="form-control" placeholder="起送金额？" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">配送费(元)</span>
        <input type="number" name="send_cost" style="width:500px"  class="form-control" placeholder="配送费？" aria-describedby="basic-addon1">
    </div><br>
    <div class="col-sm-4 input-group">
        <span class="input-group-addon" id="basic-addon1">店公告</span>
        <textarea  name="notice"  placeholder="店公告？" class="form-control"  rows="3"></textarea>
    </div><br>
    <div class="col-sm-4 input-group">
        <span class="input-group-addon" id="basic-addon1">优惠信息</span>
        <textarea  name="discount"  placeholder="优惠信息？" class="form-control"  rows="3"></textarea>
    </div><br>
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="确认注册">
    <br><br><br><br><br><br><br><small>由艾森公司支持</small>
</form>
@endsection