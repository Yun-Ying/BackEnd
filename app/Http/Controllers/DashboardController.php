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

        $data = [
            'orders' => $orders,
            'maxShow' => 5,
            'users_per_month' => $userArr,
            'orders_per_month'=> $orderArr,
        ];

        return view('dashboard.index', $data);
    }
}
