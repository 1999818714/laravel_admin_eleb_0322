<?php

namespace App\Http\Controllers;

use App\Models\EventMember;
use Illuminate\Http\Request;

class EventMembersController extends Controller
{
    //活动报名列表
    public function index()
    {
        //获取所有奖品数据
        $eventMembers = EventMember::paginate(5);//待分页
        return view('eventMember/index',compact('eventMembers'));
    }


}
