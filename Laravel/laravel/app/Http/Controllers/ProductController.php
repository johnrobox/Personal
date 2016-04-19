<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth as Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product as Product;

class ProductController extends Controller
{
    
    public function index(){
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $products = Product::All();
            $data = array(
                'products' => $products
            );
            
            return view('product', $data);
        }
    }
    
    public function add_product(Request $request) {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $productName = trim($request->input('product_name'));
            $productDesc = trim($request->input('product_description'));
            $productQuan = trim($request->input('product_quantity'));
            
            if (isset($productName) && empty($productName)) {
                $response = array(
                    'valid' => false,
                    'message' => "Product name is empty."
                );
            } else if(isset($productName) && (strlen($productName) < 2)) {
                $response = array(
                    'valid' => false,
                    'message' => 'Product name must atleast 2 characters in lenght.'
                );
            } else if (isset($productDesc) && empty($productDesc)) {
                $response = array(
                    'valid' => false,
                    'message' => 'Product description is empty.'
                );
            } else if (isset($productDesc) && (strlen($productDesc) < 5)) {
                $response = array(
                    'valid' => false,
                    'message' => 'Product description must atleast 5 characters in lenght.'
                );
            } else if (isset($productQuan) && empty($productQuan)) {
                $response = array(
                    'valid' => false,
                    'message' => 'Product quantity is empty.'
                );
            } else if (isset($productQuan) && ($productQuan <= 0)) {
                $response = array(
                    'valid' => false,
                    'message' => 'Product quantity must not zero or below zero.'
                );
            } else {
                $product = new Product;
                $product->name = $productName;
                $product->description = $productDesc;
                $product->quantity = $productQuan;
                if ($product->save()) {
                    $response = array(
                        'valid' => true,
                        'message' => 'Product added successfully.'
                    );
                } else {
                    $response = array(
                        'valid' => false,
                        'message' => 'Error in adding product.'
                    );
                }
            }
            echo json_encode($response);
        }
    }
    
    public function allProduct() {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $all_product = Product::all();
            $return = array();
            foreach($all_product as $product) {
                $response['products'][] = array(
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_description' => $product->description,
                    'product_quantity' => $product->quantity
                );
            }
            echo json_encode($response);
        }
    }
    
    public function deleteProduct($id) {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $product =  Product::find($id);
            if ($product->delete()) {
                $response = array(
                    'deleted' => true,
                    'message' => 'Product successfully deleted.'
                    );
            } else {
                $response = array(
                    'deleted' => false,
                    'message' => 'Error in deleting product'
                );
            }
            echo json_encode($response);
        }
    }
    
    public function updateProduct(Request $request) {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $productId = $request->input('product_id');
            $productName = trim($request->input('product_name'));
            $productDescription = trim($request->input('product_description'));
            $productQuantity = trim($request->input('product_quantity'));
            
            if (isset($productName) && empty($productName)) {
                $response = array(
                    'valid' => false,
                    'message' => "Product name is empty."
                );
            } else if(isset($productName) && (strlen($productName) < 2)) {
                $response = array(
                    'valid' => false,
                    'message' => 'Product name must atleast 2 characters in lenght.'
                );
            } else if (isset($productDescription) && empty($productDescription)) {
                $response = array(
                    'valid' => false,
                    'message' => 'Product description is empty.'
                );
            } else if (isset($productDescription) && (strlen($productDescription) < 5)) {
                $response = array(
                    'valid' => false,
                    'message' => 'Product description must atleast 5 characters in lenght.'
                );
            } else if (isset($productQuantity) && empty($productQuantity)) {
                $response = array(
                    'valid' => false,
                    'message' => 'Product quantity is empty.'
                );
            } else if (isset($productQuantity) && ($productQuantity <= 0)) {
                $response = array(
                    'valid' => false,
                    'message' => 'Product quantity must not zero or below zero.'
                );
            } else {
                $product = Product::find($productId);
                $product->name = $productName;
                $product->description = $productDescription;
                $product->quantity = $productQuantity;
                $prepareData = array(
                    'name' => $productName,
                    'description' => $productDescription,
                    'quantity' => $productQuantity
                ); 
                if ($product->save()) {
                    $response = array(
                        'updated' => true,
                        'message' => "Product successfully updated."
                    );
                } else {
                    $response = array(
                        'updated' => false,
                        'message' => "Error in product update."
                    );
                }
            }
            echo json_encode($response);
        }
    }
    
}
