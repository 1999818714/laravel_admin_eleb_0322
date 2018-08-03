<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Users extends Model
{
    use HasRoles;
    //过滤，只有这里的才能修改
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'shop_id'
    ];

    //建立和商家信息的关系 一对多（反向）   一（多）对一   articles.author_id ---> students.id
    public function getShops()
    {
        return $this->belongsTo(Shop::class,'shop_id','id');
    }

}
