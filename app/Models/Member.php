<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //过滤，只有这里的才能修改
    protected $fillable = [
        'username',
        'password',
        'tel',
        'status',
    ];
}
