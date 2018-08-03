<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ShopCategory extends Model
{
    //过滤，只有这里的才能修改
    protected $fillable = [
      'name',
        'img',
        'status'
    ];

    //获取头像真实路径
    public function getImg()
    {
        return Storage::url($this->img);
    }
}
