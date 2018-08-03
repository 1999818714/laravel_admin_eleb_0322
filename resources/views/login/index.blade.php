@extends('default')

@section('contents')
    @include('_errors')
<h1>亲！你还没登录喔</h1>
    <a href="javascript:history.go(-1);" role="button" class="btn btn-default">点击返回</a>
@endsection