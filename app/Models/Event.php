<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //过滤，只有这里的才能修改
    protected $fillable = [
        'title',
        'content',
        'signup_start',
        'signup_end',
        'prize_date',
        'signup_num',
        'is_prize',
    ];
}
