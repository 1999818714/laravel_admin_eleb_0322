@extends('default')
@section('js_files')
    <!--引入JS-->
    @include('vendor.ueditor.assets')
@stop
@section('contents')

<form class="form" method="post" action="{{ route('events.update',[$event]) }}" enctype="multipart/form-data">
    @include('_errors')
    <h1 class="container">修改抽奖活动页面</h1>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">活动标题</span>
        <input type="text" name="title" style="width:500px"  class="form-control" placeholder="管理员名称？" aria-describedby="basic-addon1"
               value="@if(old('title')){{ old('title') }}@else{{ $event->title }}@endif"
        >
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">详情</span>
        <!-- 编辑器容器 -->
        <script id="container" name="content" type="text/plain">@if(old('content')){!! old('content') !!} @else{!! $event->content !!} @endif</script>
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">报名开始时间</span>
        <input type="date" class="form-control" name="signup_start"
               value="@if(old('signup_start')){{ old('signup_start') }}@else{{ date('Y-m-d',$event->signup_start) }}@endif"
{{--               value="{{ date('Y-m-d',$event->signup_start) }}"--}}
        >
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">报名结束时间</span>
        <input type="date" class="form-control" name="signup_end"
               value="{{ date('Y-m-d',$event->signup_end) }}"
        >
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">开奖日期</span>
        <input type="date" class="form-control" name="prize_date"
               value="@if(old('prize_date')){{ old('prize_date') }}@else{{ $event->prize_date }}@endif"
               {{--value="{{ $event->prize_date }}"--}}
        >
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">报名人数限制</span>
        <input type="number" name="signup_num" style="width:400px"  class="form-control" placeholder="人数限制？" aria-describedby="basic-addon1"
               value="@if(old('signup_num')){{ old('signup_num') }}@else{{ $event->signup_num }}@endif"
        >
    </div><br>
    {{--<div  class="input-group" style="width:200px;">--}}
        {{--<span class="input-group-addon" id="basic-addon1">是否已经开奖</span>--}}
        {{--<select name="is_prize" class="form-control">--}}
            {{--<option value="1" @if($event->is_prize == 1)selected @endif >是</option>--}}
            {{--<option value="0" @if($event->is_prize == 0)selected @endif >否</option>--}}
        {{--</select>--}}
    {{--</div><br>--}}
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <br> <br>
    <input type="submit" class="btn btn-primary" value="确认">
    <br><br><br><br><br><br><br>
</form>
@stop
@section('js')
    <script >
        //文本编辑器
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@stop
