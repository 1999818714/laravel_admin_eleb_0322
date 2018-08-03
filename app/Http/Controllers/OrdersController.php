<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shop;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //权限
    public function __construct()
    {
        $this->middleware('auth',[
//            'only'=>['info'],//（登录后可以查看的）该中间件只对这些方法生效
            'except'=>['index'],//（未登录可以查看的）该中间件除了这些方法，对其他方法生效
        ]);
    }

    //订单页面,按商家分别统计和整体统计
    public function index(Request $request)
    {
        //获取所有商家
        $shops = Shop::get();
        //搜索
        $keyword = '';//商家ID
        $count = '';
        if($request->keyword){
            $keyword = $request->keyword;
            $counts = Order::where('shop_id','like','%'.$keyword.'%')->count();
            $count = '商家('.Shop::where('id',$keyword)->first()->shop_name.')订单有'.$counts.'单';
            $orders = Order::where('shop_id','like','%'.$keyword.'%')->paginate(5);//包含功能分页搜索
        }else{
            $counts = Order::count();
            $count = '全部商家订单有'.$counts.'单';
            $orders = Order::paginate(5);//包含功能分页
        }
        foreach ($orders as &$order){
            if($order->status == -1){
                $order->new_status = '已取消';
            }elseif ($order->status == 0){
                $order->new_status = '待支付';
            }elseif ($order->status == 1){
                $order->new_status = '待发货';
            }elseif ($order->status == 2){
                $order->new_status = '待确认';
            }elseif ($order->status == 3){
                $order->new_status = '完成';
            }
        }

        return view('order/index',compact(['orders','keyword','count','shops']));
    }


    //订单页面,按日搜索
    public function index_day(Request $request)
    {
        //搜索
        $keyword = '';
        $count = '';
        if($request->keyword){
            $keyword = $request->keyword;
            $counts = Order::where('created_at','like','%'.$keyword.'%')->count();
            $count = $keyword.'日订单有'.$counts.'单';
            $orders = Order::where('created_at','like','%'.$keyword.'%')->paginate(5);//包含功能分页搜索
        }else{
            $counts = Order::count();
            $count = '全部订单有'.$counts.'单';
            $orders = Order::paginate(5);//包含功能分页
        }
        foreach ($orders as &$order){
            if($order->status == -1){
                $order->new_status = '已取消';
            }elseif ($order->status == 0){
                $order->new_status = '待支付';
            }elseif ($order->status == 1){
                $order->new_status = '待发货';
            }elseif ($order->status == 2){
                $order->new_status = '待确认';
            }elseif ($order->status == 3){
                $order->new_status = '完成';
            }
        }
        return view('order/index_day',compact(['orders','keyword','count']));
    }

    //订单页面,按月份搜索
    public function index_month(Request $request)
    {
        //搜索
        $keyword = '';
        $count = '';
        if($request->keyword){
            $keyword = $request->keyword;
            $counts = Order::where('created_at','like','%'.$keyword.'%')->count();
            $count = $keyword.'月份订单有'.$counts.'单';
            $orders = Order::where('created_at','like','%'.$keyword.'%')->paginate(5);//包含功能分页搜索
        }else{
            $counts = Order::count();
            $count = '全部订单有'.$counts.'单';
            $orders = Order::paginate(5);//包含功能分页
        }
        foreach ($orders as &$order){
            if($order->status == -1){
                $order->new_status = '已取消';
            }elseif ($order->status == 0){
                $order->new_status = '待支付';
            }elseif ($order->status == 1){
                $order->new_status = '待发货';
            }elseif ($order->status == 2){
                $order->new_status = '待确认';
            }elseif ($order->status == 3){
                $order->new_status = '完成';
            }
        }
        return view('order/index_month',compact(['orders','keyword','count']));
    }


}
