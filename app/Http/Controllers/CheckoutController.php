<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();
class CheckoutController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id)
        {
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function login_checkout()
    {
        $cate_product = DB::table('tbl_category_products')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_products')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function add_customer(Request $request)
    {
        $data=array();
        $data['customer_name']=$request->customer_name;
        $data['customer_email']=$request->customer_email;
        $data['customer_password']=md5($request->customer_password);
        $data['customer_phone']=$request->customer_phone;

        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return Redirect::to('/check-out');
    }

    public function checkout()
    {
        $cate_product = DB::table('tbl_category_products')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_products')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }

    public function save_checkout_customer(Request $request)
    {
        $data=array();
        $data['shipping_name']=$request->shipping_name;
        $data['shipping_phone']=$request->shipping_phone;
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_address']=$request->shipping_address;
        $data['shipping_note']=$request->shipping_note;

        $shipping_id = DB::table('tbl_shippings')->insertGetId($data);

        Session::put('shipping_id',$shipping_id);

        return Redirect::to('/payment');
    }

    public function payment()
    {
        $cate_product = DB::table('tbl_category_products')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_products')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function logout_checkout()
    {
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
        
        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/');
        }else{
            return Redirect::to('/login-checkout');
        }
    }
    public function order_place(Request $request)
    {
        //insert payment_method
        $data=array();
        $data['payment_method']=$request->payment_option;
        $data['payment_status']='Đang chờ xử lý';
       
        $payment_id = DB::table('tbl_payments')->insertGetId($data);

        //insert order
        $order_data=array();
        $order_data['customer_id']=Session::get('customer_id');
        $order_data['shipping_id']=Session::get('shipping_id');
        $order_data['payment_id']=$payment_id;
        $order_data['order_total']= Cart::total();
        $order_data['order_status']='Đang chờ xử lý';
       
        $order_id = DB::table('tbl_orders')->insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach($content as $key => $v_content){
            $order_details_data=array();
            $order_details_data['order_id']=$order_id;
            $order_details_data['product_id']=$v_content->id;
            $order_details_data['product_name']=$v_content->name;
            $order_details_data['product_price']= $v_content->price;
            $order_details_data['product_sales_quantity']=$v_content->qty;
            DB::table('tbl_order_details')->insert($order_details_data);
        }
        if($data['payment_method']==1)
        {
            echo 'Thanh toán bằng ATM';
        }elseif($data['payment_method']==2){
            Cart::destroy();
            $cate_product = DB::table('tbl_category_products')->where('category_status','1')->orderby('category_id','desc')->get();

            $brand_product = DB::table('tbl_brand_products')->where('brand_status','1')->orderby('brand_id','desc')->get();
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);;
        }

        return Redirect::to('/payment');
    }

    public function manager_order()
    {
        $this->AuthLogin();
        $all_order = DB::table('tbl_orders')
        ->join('tbl_customers','tbl_orders.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_orders.*','tbl_customers.customer_name')
        ->orderBy('tbl_orders.order_id','desc')->get();
        $manager_order = view('admin.order.manager_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.order.manager_order',$manager_order);
    }

    public function view_order($orderId)
    {
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_orders')
        ->join('tbl_customers','tbl_orders.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_shippings','tbl_orders.shipping_id','=','tbl_shippings.shipping_id')
        ->join('tbl_order_details','tbl_orders.order_id','=','tbl_order_details.order_id')
        ->select('tbl_orders.*','tbl_customers.*','tbl_shippings.*','tbl_order_details.*')
        ->first();
        $manager_order_by_id = view('admin.order.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.order.view_order',$manager_order_by_id);
    }
}
