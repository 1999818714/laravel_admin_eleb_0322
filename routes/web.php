<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//商家分类表
Route::resource('shopCategory','ShopCategoryController');
Route::post('shopCategory/upload','ShopCategoryController@upload')->name('shopCategory.upload');//文件图片接受服务端

//商家信息表
Route::resource('shops','ShopsController');
Route::get('/shops/{shop}/status', 'ShopsController@status')->name('shops.status');//正常、未审核、禁止
Route::post('shops/upload','ShopsController@upload')->name('shops.upload');//文件图片接受服务端

//商家账号表
Route::resource('users','UsersController');
Route::get('/users/{user}/status', 'UsersController@status')->name('users.status');//禁用、开启
Route::get('/users/{user}/reset', 'UsersController@reset')->name('users.reset');//重置密码页面
Route::post('/users/{user}', 'UsersController@confirm')->name('users.confirm');//重置密码功能
//管理员账号表
Route::resource('admins','AdminsController');
Route::get('/admins/{admin}/editPassword', 'AdminsController@editPassword')->name('admins.editPassword');//修改管理员密码页面
Route::patch('/admins', 'AdminsController@updatePassword')->name('admins.updatePassword');//修改管理员密码功能

//管理员登录
Route::get('/login','LoginController@index')->name('login');//用于未登录时返回页面
Route::post('/login','LoginController@store')->name('login.store');
Route::delete('/logout','LoginController@logout')->name('login.logout');

//活动表
Route::resource('activity','ActivityController');
Route::post('activity/upload','ActivityController@upload')->name('activity.upload');//文件图片接受服务端

//发送短信
Route::get('sms',function (){
//    $tel = request()->tel;
    $tel = request()->input('tel',17313227001);
    $params = [];//array ()

    // *** 需用户填写部分 ***
    // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
    $accessKeyId = "LTAIL5wjp1WnjiUc";
    $accessKeySecret = "BnM8dA7p6YeBL5TnsOzPdmctM307CQ";

    // fixme 必填: 短信接收号码
    $params["PhoneNumbers"] = $tel;

    // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
    $params["SignName"] = "刘鹏666";

    // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
    $params["TemplateCode"] = "SMS_61465004";

    // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
    $num = random_int(1000,9999);
    $params['TemplateParam'] = Array (
        "code" => $num,//验证码
//        "product" => "阿里通信"
    );

    // fixme 可选: 设置发送短信流水号
    $params['OutId'] = "12345";

    // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
    $params['SmsUpExtendCode'] = "1234567";


    // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
    if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
        $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
    }

    // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
    $helper = new \App\SignatureHelper();

    // 此处可能会抛出异常，注意catch
    $content = $helper->request(
        $accessKeyId,
        $accessKeySecret,
        "dysmsapi.aliyuncs.com",
        array_merge($params, array(
            "RegionId" => "cn-hangzhou",
            "Action" => "SendSms",
            "Version" => "2017-05-25",
        ))
    // fixme 选填: 启用https
    // ,true
    );
//    return $content;
    dd($content);
});

//订单表
Route::resource('orders','OrdersController');
Route::get('/orders_index_day', 'OrdersController@index_day')->name('orders.index_day');//按日搜索
Route::get('/orders_index_month', 'OrdersController@index_month')->name('orders.index_month');//按月份搜索

//订单商品表
Route::resource('orderGoods','OrderGoodsController');
Route::get('/orderGoods_index_day', 'OrderGoodsController@index_day')->name('orderGoods.index_day');//按日搜索
Route::get('/orderGoods_index_month', 'OrderGoodsController@index_month')->name('orderGoods.index_month');//按月份搜索

//会员表
Route::resource('members','MembersController');
Route::get('/members/{member}/status', 'MembersController@status')->name('members.status');//禁用、开启

//测试rbac权限
Route::resource('rbac','RbacController');

//权限表
Route::resource('permissions','PermissionsController');
//角色表
Route::resource('roles','RolesController');

//发送邮件(测试)
Route::get('email',function (){
//    $r = \Illuminate\Support\Facades\Mail::raw('您的服务器存在异常的登录行为',function ($message){
//        $message->subject('登录正常提醒');//标题
//        $message->to('17313227001@163.com');//邮箱
//        $message->from('17313227001@163.com','liu');//邮箱，发送方姓名
//    });
//    dd($r);

    \Illuminate\Support\Facades\Mail::send('welcome', [], function ($message) {//welcome是视图
        $message->from('17313227001@163.com','liu');//邮箱，发送方姓名
        $message->to(['17313227001@163.com'])->subject('公司未婚妹子数量报表统计');});

});

//菜单表
Route::resource('navs','NavsController');

//抽奖活动表
Route::resource('events','EventsController');
Route::get('/prizes','EventsController@prizes')->name('prizes.index');//活动奖品列表
Route::get('/prizes/create','EventsController@prizesCreate')->name('prizes.create');//添加活动奖品页面
Route::post('/prizes','EventsController@prizesStore')->name('prizes.store');//添加活动奖品功能
Route::get('/prizes/{prize}/edit','EventsController@prizesEdit')->name('prizes.edit');//修改活动奖品页面
Route::patch('/prizes/{prize}','EventsController@prizesUpdate')->name('prizes.update');//修改活动奖品功能
Route::delete('/prizes/{prize}','EventsController@prizesDestroy')->name('prizes.destroy');//删除活动奖品功能
Route::get('/obIndex','EventsController@obIndex')->name('obIndex.index');//静态页面
Route::get('/obIntro','EventsController@obIntro')->name('obIntro.index');//静态页面
//活动奖品表
Route::resource('eventPrizes','EventPrizesController');
//活动报名表
Route::resource('eventMembers','EventMembersController');

//测试中文分词搜索
Route::get('/search',function (){
    $cl = new \App\SphinxClient();
    $cl->SetServer ( '127.0.0.1', 9312);
    $cl->SetConnectTimeout ( 10 );
    $cl->SetArrayResult ( true );
    $cl->SetMatchMode ( SPH_MATCH_EXTENDED2);
    $cl->SetLimits(0, 1000);
    $info = '蔬菜小店';
//    $info = request()->name;
    $res = $cl->Query($info, 'shop');//shop这个是索引，要匹配#源定义source shop
    dd($res);
});

//Route::get('/articles', 'articlesController@index')->name('articles.index');//用户列表
//Route::get('/articles/{user}', 'articlesController@show')->name('articles.show');//查看单个用户信息
//Route::get('/articles/create', 'articlesController@create')->name('articles.create');//显示添加表单
//Route::post('/articles', 'articlesController@store')->name('articles.store');//接收添加表单数据
//Route::get('/articles/{user}/edit', 'articlesController@edit')->name('articles.edit');//修改用户表单
//Route::patch('/articles/{user}', 'articlesController@update')->name('articles.update');//更新用户信息
//Route::delete('/articles/{user}', 'articlesController@destroy')->name('articles.destroy');//删除用户信息




