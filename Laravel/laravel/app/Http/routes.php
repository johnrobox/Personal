<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('product','ProductController@index');
Route::post('add_product','ProductController@add_product');
Route::get('all_product','ProductController@allProduct');
Route::get('delete_product/{id}', 'ProductController@deleteProduct');
Route::post('update_product', 'ProductController@updateProduct');





Route::get('homes', function(){
        if (Auth::guest()) {
            return Redirect::to('out');
        } else {
            echo 'welcome home ' . Auth::user()->email;
        }
});


Route::get('out', function(){
        echo "you are out";
});


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::auth();

Route::get('/home', 'HomeController@index');





Route::get('orders', 'OrderController@get_order');

Route::get('customer/{id}','CustomerController@show');

Route::get('get_customer','CustomerController@get_customer');

Route::get('hello/{name}', function($name){
    echo "hello world" . $name;
});

Route::post('test', function(){
    echo "POSTED";
});

Route::get('test', function(){
    echo "Read";
    echo "<form action='test' method='POST'>";
    echo "<input type='submit' value='submit'>";
    echo "<input type='hidden' name='_token' value='" . csrf_token() . "'>";
   // echo "<input type='hidden' name='_method' value='DELETE'>";
});

Route::put('test', function(){
    echo "UPDATE";
});

Route::delete('test', function(){
    echo "DELETE";
});

Route::get('mypage', function(){
    $customer = App\Customer::all();

    $data['customers'] = $customer;
        return view('sample', $data);
});

