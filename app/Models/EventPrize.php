<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    //过滤，只有这里的才能修改
    protected $fillable = [
        'events_id',
        'name',
        'description',
        'member_id',
    ];

//建立和报名商家账号的关系 一对多（反向）   一（多）对一   articles.author_id ---> students.id
    public function getMembers()
    {
        return $this->belongsTo(Member::class,'member_id','id');
    }

    //建立和抽奖活动的关系 一对多（反向）   一（多）对一   articles.author_id ---> students.id
    public function getEvents()
    {
        return $this->belongsTo(Event::class,'events_id','id');
    }
}
