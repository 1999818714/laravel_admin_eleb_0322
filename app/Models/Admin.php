<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;
    //过滤，只有这里的才能修改
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


}
