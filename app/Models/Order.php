<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{



    //建立和商家店铺的关系 一对多（反向）   一（多）对一   articles.author_id ---> students.id
    public function getShops()
    {
        return $this->belongsTo(Shop::class,'shop_id','id');
    }

    //建立和用户的关系 一对多（反向）   一（多）对一   articles.author_id ---> students.id
    public function getMembers()
    {
        return $this->belongsTo(Member::class,'user_id','id');
    }
}
