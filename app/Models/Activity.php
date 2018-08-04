<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //过滤，只有这里的才能修改
    protected $fillable = [
        'title',
        'content',
        'start_time',
        'end_time',
    ];
}
