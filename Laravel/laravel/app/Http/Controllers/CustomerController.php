<?php

namespace App\Http\Controllers;

use App\Customer as Customer;

use Illuminate\Http\Request;

use App\Http\Requests;

class CustomerController extends Controller
{
    //

    public function show($id) {
    	echo 'hit';
    	$customer = Customer::find($id);
	    echo "Hello my name is " . $customer->name;
	    echo "<br/>";

	    $orders = $customer->orders;
	    foreach($orders as $order) {
	        echo $order->name . "<br />";
	    }
    }

    public function get_customer() {
    	$customer = Customer::where('name', '=', 'John Robert Jerodiaz')->first();
    	echo $customer->name;
    }


}
