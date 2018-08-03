@extends('default')

@section('contents')
<table class="table  table-bordered table-striped">
    <tr>
        <th>id</th>
        <th>商家分类名</th>
        <th>logo</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    @foreach($shopCategory as $cate)
    <tr>
        <td>{{ $cate->id }}</td>
        <td>{{ $cate->name }}</td>
        <td><img src="{{ $cate->img }}" width="100px" height="80px" alt=""></td>
{{--        <td>{{ \Illuminate\Support\Facades\Storage::url($cate->img) }}</td>--}}
        <td>{{ $cate->status?'显示':"隐藏" }}</td>
        <td>
            <a href="{{ route('shopCategory.edit',[$cate]) }}">编辑</a>
            <form method="post" action="
               {{ route('shopCategory.destroy',[$cate]) }}">
                {{ method_field('DELETE') }}{{--不写这个会报no message--}}
                {{ csrf_field() }}{{--不写这个会报时间那个错误--}}
                <button class="btn btn-danger btn-xs">删除</button>
            </form>
        </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="5"><a href="{{ route('shopCategory.create') }}">添加商家分类</a></td>
    </tr>
</table>
    {{ $shopCategory/*->appends(['keyword'=>'水浒'])*/->links() }}
@endsection