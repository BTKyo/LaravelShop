<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;

session_start();

class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        
        $productID = $request->producid_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('tbl_products')->where('product_id',$productID)->first();

        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '123';
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        Cart::setGlobalTax(2);
        return Redirect::to('/show-cart');
        
    }
    public function show_cart()
    {
        $cate_product = DB::table('tbl_category_products')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_products')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('pages.cart.showCart')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function delete_to_cart($rowId)
    {
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
}
