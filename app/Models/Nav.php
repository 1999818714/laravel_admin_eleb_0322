<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Nav extends Model
{
    //过滤，只有这里的才能修改
    protected $fillable = [
        'name',
        'url',
        'permission_id',
        'pid',
    ];

    //建立和权限表的关系 一对多（反向）   一（多）对一   articles.author_id ---> students.id
    public function getPermissions()
    {
        return $this->belongsTo(Permission::class,'permission_id','id');
    }

    //一级菜单和二级菜单 一对多
    public function children()
    {
        return $this->hasMany(self::class,'pid');
    }

    //菜单和权限连接   一对多
    public function Permission()
    {
        return $this->belongsTo(Permission::class);
    }

//导航菜单
    public static function getNavHtml(){

        $html = '';
        foreach (self::where('pid',0)->get() as $nav){
            $children_html = '';
            foreach($nav->children as $child){
                if(!$child->Permission){
                    dd($child);
                }
                if(auth()->user()->can($child->Permission->name)){
                    $children_html .= '<li><a href="'.route($child->url).'">'.$child->name.'</a></li>';
                }
            }
            //为空就跳过
            if (empty($children_html)){
                continue;
            };
            $html .= '
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$nav->name.'<span class="caret"></span></a>
                    <ul class="dropdown-menu">';
            $html .= $children_html;
            $html .= '</ul>
            </li>';
        }
//        return 123;
        return $html;
    }

}
