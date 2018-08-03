@extends('default')

@section('contents')
<form class="form" method="post" action="{{ route('shops.update',[$shop]) }}" enctype="multipart/form-data">
    @include('_errors')
    <h1 class="container">添加商家信息</h1>
    <div  class="col-sm-4  input-group">
        <span class="input-group-addon" id="basic-addon1">店铺分类ID</span>
        <select class="form-control" name="shop_category_id">
            @foreach($shopCategory as $v)
                <option value="{{ $v->id }}"  @if($v->id == $shop->shop_category_id)selected @endif >{{ $v->name }}</option>
            @endforeach
        </select>
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">名称</span>
        <input type="text" name="shop_name" style="width:500px"  class="form-control" placeholder="名称？" aria-describedby="basic-addon1"
               value="@if(old('shop_name')){{ old('shop_name') }}@else{{ $shop->shop_name }}@endif"
        >
    </div><br>
    <div class="form-group">
        <label for="exampleInputFile">店铺图片</label>
        <div id="uploader-demo">
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
        </div>
        <input type="text" name="shop_img" id="img_url" class="form-control" readonly>
        @if($shop->shop_img)
            <br>
            <img class="thumbnail img-responsive" id="img" src="{{ $shop->shop_img }}" width="200" />
        @endif
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">评分</span>
        <input type="number" name="shop_rating" style="width:500px"  class="form-control" placeholder="评分？" aria-describedby="basic-addon1"
               value="@if(old('shop_rating')){{ old('shop_rating') }}@else{{ $shop->shop_rating }}@endif"
        >
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">是否是品牌</span>
        是<input type="radio" value="1" @if($shop->brand == 1)checked @endif id="inlineRadio1"  name="brand" aria-describedby="basic-addon1">
        否<input type="radio" value="0" @if($shop->brand == 0)checked @endif name="brand" id="inlineRadio2" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">是否准时送达</span>
        是<input type="radio" value="1" @if($shop->on_time == 1)checked @endif name="on_time" aria-describedby="basic-addon1">
        否<input type="radio" value="0" @if($shop->on_time == 0)checked @endif  name="on_time" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">是否蜂鸟配送</span>
            是<input type="radio" value="1" @if($shop->fengniao == 1)checked @endif name="fengniao" aria-describedby="basic-addon1">
            否<input type="radio" value="0" @if($shop->fengniao == 0)checked @endif  name="fengniao" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">是否保标记</span>
        是<input type="radio" value="1" @if($shop->bao == 1)checked @endif name="bao" aria-describedby="basic-addon1">
        否<input type="radio" value="0" @if($shop->bao == 0)checked @endif name="bao" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">是否票标记</span>
        是<input type="radio" value="1" @if($shop->piao == 1)checked @endif name="piao" aria-describedby="basic-addon1">
        否<input type="radio" value="0" @if($shop->piao == 0)checked @endif name="piao" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">是否准标记</span>
        是<input type="radio" value="1" @if($shop->zhun == 1)checked @endif name="zhun" aria-describedby="basic-addon1">
        否<input type="radio" value="0" @if($shop->zhun == 0)checked @endif name="zhun" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">起送金额(元)</span>
        <input type="number" name="start_send" style="width:500px"  class="form-control" placeholder="起送金额？" aria-describedby="basic-addon1"
               value="@if(old('start_send')){{ old('start_send') }}@else{{ $shop->start_send }}@endif"
        >
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">配送费(元)</span>
        <input type="number" name="send_cost" style="width:500px"  class="form-control" placeholder="配送费？" aria-describedby="basic-addon1"
               value="@if(old('send_cost')){{ old('send_cost') }}@else{{ $shop->send_cost }}@endif"
        >
    </div><br>
    <div class="col-sm-4 input-group">
        <span class="input-group-addon" id="basic-addon1">店公告</span>
        <textarea  name="notice"  placeholder="店公告？" class="form-control"  rows="3">@if(old('notice')){{ old('notice') }}@else{{ $shop->notice }}@endif</textarea>
    </div><br>
    <div class="col-sm-4 input-group">
        <span class="input-group-addon" id="basic-addon1">优惠信息</span>
        <textarea  name="discount"  placeholder="优惠信息？" class="form-control"  rows="3">@if(old('discount')){{ old('discount') }}@else{{ $shop->discount }}@endif</textarea>
    </div><br>
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="提交">
    <br><br><br><br><br><br><br><small>由艾森公司支持</small>
</form>
@stop
@section('js')
    <script >
        //使用Web Uploader上传图片到阿里云（只是上传图片）
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            //swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: "{{ route('shops.upload') }}",

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            //文件上传请求的参数表，每次发送都会发送此对象中的参数
            formData:{
                _token:'{{ csrf_token() }}'
            }
        });
        //回显图片
        uploader.on( 'uploadSuccess', function( file,response ) {//uploadSuccess当文件上传成功时触发,response代表响应内容
            $("#img").attr('src',response.fileName);
            $("#img_url").val(response.fileName)
        });
        //文本编辑器（不用的时候关闭）
        {{--var ue = UE.getEditor('container');--}}
        {{--ue.ready(function() {--}}
        {{--ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.--}}
        {{--});--}}
    </script>
@stop