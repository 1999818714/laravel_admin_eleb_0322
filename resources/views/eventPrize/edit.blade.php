@extends('default')
@section('js_files')
    <!--引入JS-->
    @include('vendor.ueditor.assets')
@stop
@section('contents')

<form class="form" method="post" action="{{ route('eventPrizes.update',[$eventPrize]) }}" enctype="multipart/form-data">
    @include('_errors')
    <h1 class="container">添加活动奖品页面</h1>
    <div class="input-group" style="width:200px;">
        <span class="input-group-addon" id="basic-addon1">活动</span>
        <select name="events_id" class="form-control">
            @foreach($events as $event)
            <option value="{{ $event->id }}" @if($event->id == $eventPrize->events_id)selected @endif >{{ $event->title }}</option>
            @endforeach
        </select>
    </div><br>
    <div  class="input-group">
        <span class="input-group-addon" id="basic-addon1">奖品名称</span>
        <input type="text" name="name" style="width:500px"  class="form-control" placeholder="奖品名称？" aria-describedby="basic-addon1"
               value="@if(old('name')){{ old('name') }}@else{{ $eventPrize->name }}@endif"
        >
    </div><br>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">详情</span>
        <!-- 编辑器容器 -->
        <script id="container" name="description" type="text/plain"> @if(old('description')){!! old('description') !!}@else{!! $eventPrize->description !!} @endif</script>
    </div><br>
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <br> <br>
    <input type="submit" class="btn btn-primary" value="确认修改">
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
