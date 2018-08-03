<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    //建立和订单商品的关系 一对多（反向）   一（多）对一   articles.author_id ---> students.id
    public function getGoods()
    {
        return $this->belongsTo(OrderGoods::class,'id','goods_id');
    }
}
