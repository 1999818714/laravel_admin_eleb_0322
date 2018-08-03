<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\OrderGoods;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderGoodsController extends Controller
{
    //权限
    public function __construct()
    {
        $this->middleware('auth',[
//            'only'=>['info'],//（登录后可以查看的）该中间件只对这些方法生效
            'except'=>['index'],//（未登录可以查看的）该中间件除了这些方法，对其他方法生效
        ]);
    }

    //订单商品页面,按商家分别统计和整体统计
    public function index(Request $request)
    {
        //获取所有商家
        $shops = Shop::get();
        //搜索
        $keyword = '';//商家ID
        $count = '';
        if($request->keyword){
            $keyword = $request->keyword;

            $menus = Menu::where('shop_id',$keyword)->get();//根据商家ID找到商品
            $goods = [];
            $count = 0;
            foreach($menus as $menu){
//                $goods[] = OrderGoods::where('goods_id',$menu->id)->get();
                $goods[] = $menu->getGoods;
            }
            foreach($goods as $good){
//                    $count = $good->amount;
            }
//            $goods = OrderGoods::where('')->get();
//            dd($goods);
            dd($count);

            $goods = OrderGoods::where('created_at','like','%'.$keyword.'%')->get();
            $counts = 0;
            foreach($goods as $good){
                $counts += $good->amount;
            }
//            $count = $keyword.'日菜品销量有'.$counts.'单';
            $count = '商家('.Shop::where('id',$keyword)->first()->shop_name.')订单有'.$counts.'单';
            $orderGoods = OrderGoods::where('created_at','like','%'.$keyword.'%')->paginate(5);//包含功能分页搜索
        }else{
            $goods = OrderGoods::get();
            $counts = 0;
            foreach($goods as $good){
                $counts += $good->amount;
            }
            $count = '全部菜品销量有'.$counts.'单';
            $orderGoods = OrderGoods::paginate(5);//包含功能分页
        }
        return view('orderGoods/index',compact(['orderGoods','keyword','count','shops']));
    }

    //订单商品页面,按日搜索
    public function index_day(Request $request)
    {
        //搜索
        $keyword = '';
        $count = '';
        if($request->keyword){
            $keyword = $request->keyword;
            $goods = OrderGoods::where('created_at','like','%'.$keyword.'%')->get();
            $counts = 0;
            foreach($goods as $good){
                $counts += $good->amount;
            }
            $count = $keyword.'日菜品销量有'.$counts.'单';
            $orderGoods = OrderGoods::where('created_at','like','%'.$keyword.'%')->paginate(5);//包含功能分页搜索
        }else{
            $goods = OrderGoods::get();
            $counts = 0;
            foreach($goods as $good){
                $counts += $good->amount;
            }
            $count = '全部菜品销量有'.$counts.'单';
            $orderGoods = OrderGoods::paginate(5);//包含功能分页
        }
        return view('orderGoods/index_day',compact(['orderGoods','keyword','count']));
    }
    //订单商品页面,按月搜索
    public function index_month(Request $request)
    {
        //搜索
        $keyword = '';
        $count = '';
        if($request->keyword){
            $keyword = $request->keyword;
            $goods = OrderGoods::where('created_at','like','%'.$keyword.'%')->get();
            $counts = 0;
            foreach($goods as $good){
                $counts += $good->amount;
            }
            $count = $keyword.'月份菜品销量有'.$counts.'单';
            $orderGoods = OrderGoods::where('created_at','like','%'.$keyword.'%')->paginate(5);//包含功能分页搜索
        }else{
            $goods = OrderGoods::get();
            $counts = 0;
            foreach($goods as $good){
                $counts += $good->amount;
            }
            $count = '全部菜品销量有'.$counts.'单';
            $orderGoods = OrderGoods::paginate(5);//包含功能分页
        }
        return view('orderGoods/index_month',compact(['orderGoods','keyword','count']));
    }
}
