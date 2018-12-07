<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at','desc')->get();

        //get value for widget 1
        $users = User::select('id', 'created_at')
            ->get()
            ->groupBy(function($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($usermcount[$i])){
                $userArr[$i] = $usermcount[$i];
            }else{
                $userArr[$i] = 0;
            }
        }


        //get value for widget 3
        $orderss = Order::select('id', 'created_at')
            ->get()
            ->groupBy(function($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $ordermcount = [];
        $orderArr = [];

        foreach ($orderss as $key => $value) {
            $ordermcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($ordermcount[$i])){
                $orderArr[$i] = $ordermcount[$i];
            }else{
                $orderArr[$i] = 0;
            }
        }

        //get value for widget 2 and 4
        $saleOrderGroup = Order::where('is_check', 1)->select('id', 'created_at', 'quantities', 'total_price')
            ->get()
            ->groupBy(function($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $moneyMcount = [];
        $saleProductMcount = [];
        $moneyArr = [];
        $saleProductArr = [];

        foreach ($saleOrderGroup as $key => $values) {

            //get quantities
            $total_quantities = 0;
            //get total price
            $total_prices=0;

            foreach ($values as $value)
            {
                foreach ($value['quantities'] as $quantity)
                {
                    $total_quantities += $quantity;
                }
                $total_prices += $value['total_price'];
            }

            $saleProductMcount[(int)$key] = $total_quantities;
            $moneyMcount[(int)$key] = $total_prices;
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($ordermcount[$i])){
                $saleProductArr[$i] = $saleProductMcount[$i];
                $moneyArr[$i] = $moneyMcount[$i];
            }else{
                $saleProductArr[$i] = 0;
                $moneyArr[$i] = 0;
            }
        }
//////////////////


        //get total sale money and products
        $totalSaleMoney = 0;
        $totalSaleProduct = 0;
        $saleOrder = Order::where('is_check', 1)->get();
        foreach($saleOrder as $o){
            $totalSaleMoney += $o->total_price;
            foreach ($o->quantities as $q){
                $totalSaleProduct += $q;
            }
        }

        $data = [
            'orders' => $orders,
            'maxShow' => 5,
            'users_per_month' => $userArr,
            'orders_per_month'=> $orderArr,
            'totalSaleMoney' => $totalSaleMoney,
            'totalSaleProduct' => $totalSaleProduct,
            'sale_products_per_month' => $saleProductArr,
            'earning_per_month' => $moneyArr,
        ];

        return view('dashboard.index', $data);
    }
}
