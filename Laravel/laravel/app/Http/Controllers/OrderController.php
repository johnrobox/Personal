<?php

namespace App\Http\Controllers;

use App\Order as Order;


use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth as Auth;

class OrderController extends Controller
{
    
    public function get_order(){
    	$orders = Order::All();
        echo Auth::user()->email;
    	foreach($orders as $order) {
    		echo $order->name . " : order by " . $order->customer->name . "<br>";
    	}
    }
}
