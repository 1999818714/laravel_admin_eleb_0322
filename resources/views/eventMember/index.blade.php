@extends('default')

@section('contents')
<table class="table  table-striped table-bordered">
    <tr>
        <th>活动报名表</th>
        <th>活动</th>
        <th>商家账号</th>
    </tr>
    @foreach($eventMembers as $event)
    <tr>
        <td>{{ $event->id }}</td>
        <td>{{ $event->getEvents->title }}</td>
        <td>{{ $event->getUsers->name }}</td>
    </tr>
    @endforeach
</table>
{{ $eventMembers/*->appends(['keyword'=>'水浒'])*/->links() }}
@endsection