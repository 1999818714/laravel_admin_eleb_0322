@extends('default')

@section('js_files')
    <!--引入JS-->
    {{--<script type="text/javascript" src="/webuploader/webuploader.js"></script>--}}
    @include('vendor.ueditor.assets'){{--//文本编译器专用--}}
@stop
@section('contents')
<form class="form" method="post" action="{{ route('activity.store') }}">
    <h1 class="container">测试上传图片到阿里云服务器配置是否成功</h1>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">活动标题</span>
        <input type="text" name="title" style="width:500px"  class="form-control" placeholder="活动标题？" aria-describedby="basic-addon1">
    </div><br>
    <div class="form-group">
        <label for="exampleInputFile">商品图片</label>
        <!--dom结构部分-->
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
        </div>
        <input type="text" name="img" id="img_url" class="form-control" readonly>
        <img id="img"/>
    </div><br>
    <div class="input-group">
        <span id="basic-addon1">活动详情</span>
        <!-- 编辑器容器 -->
        <script id="container" name="content" type="text/plain"></script>
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">活动开始时间</span>
        <input type="datetime-local" name="start_time" style="width:500px"  class="form-control" placeholder="名字？" aria-describedby="basic-addon1">
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">活动结束时间</span>
        <input type="datetime-local" name="end_time" style="width:500px"  class="form-control" placeholder="名字？" aria-describedby="basic-addon1">
    </div><br>
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="提交">
</form>
<br><br><br><br><br><br><br>
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
            server: "{{ route('activity.upload') }}",

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
        //文本编辑器
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@stop

