@extends('default')

@section('contents')
<form class="form" method="post" action="{{ route('shopCategory.update',[$shopCategory]) }}" enctype="multipart/form-data">
    <h1 class="container">修改商家分类页面</h1>
    @include('_errors')
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">商家分类名</span>
        <input type="text" name="name" style="width:500px"  class="form-control" placeholder="商家分类名？" aria-describedby="basic-addon1"
               value="@if(old('name')){{ old('name') }}@else{{ $shopCategory->name }}@endif"
        >
    </div><br>
    <div class="form-group">
        <label for="exampleInputFile">商家图片</label>
        <div id="uploader-demo">
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
        </div>
        <input type="text" name="img" id="img_url" class="form-control" readonly>
        @if($shopCategory->img)
            <br>
            <img class="thumbnail img-responsive" id="img" src="{{ $shopCategory->img }}" width="200" />
        @endif
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">状态</span>
        显示<input type="radio" value="1" @if($shopCategory->status==1)checked @endif  name="status" aria-describedby="basic-addon1">
        隐藏<input type="radio" value="0" @if($shopCategory->status==0)checked @endif name="status" aria-describedby="basic-addon1">
    </div><br>
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="提交">
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
            server: "{{ route('shopCategory.upload') }}",

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