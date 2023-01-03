<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductSizeController extends Controller
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
    public function add_size_product()
    {
        $this->AuthLogin();
        return view('admin.Size.addSizeProduct');
    }

    public function all_size_product()
    {
        $this->AuthLogin();
        $all_size_product = DB::table('product_sizes')->get();
        $manager_size_product = view('admin.Size.allSizeProduct')->with('all_size_product',$all_size_product);
        return view('admin_layout')->with('admin.Size.allSizeProduct',$manager_size_product);
    }
    public function save_size_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['size_name'] = $request->size_product_name;
        $data['size_status'] = $request->size_product_status;

        DB::table('product_sizes')->insert($data);
        Session::put('message','Thêm Size Sản Phẩm Thành Công');
        return Redirect::to('/all-size-product');
       
    }
    public function unactive_size_product($size_product_id)
    {
        $this->AuthLogin();
        DB::table('product_sizes')->where('size_id',$size_product_id)->update(['size_status'=>0]);
        Session::put('message','Không kích hoạt size sản phẩm thành công');
        return Redirect::to('all-size-product');
    }
    public function active_size_product($size_product_id)
    {
        $this->AuthLogin();
        DB::table('product_sizes')->where('size_id',$size_product_id)->update(['size_status'=>1]);
        Session::put('message','Kích hoạt size sản phẩm thành công');
        return Redirect::to('all-size-product');
    }
    public function edit_size_product($size_product_id)
    {
        $this->AuthLogin();
        $edit_size_product = DB::table('product_sizes')->where('size_id',$size_product_id)->get();
        $manager_size_product = view('admin.Size.editSizeProduct')->with('edit_size_product',$edit_size_product);

        return view('admin_layout')->with('admin.Size.editSizeProduct',$manager_size_product);
    }
    public function update_size_product(Request $request,$size_product_id)
    {
        $this->AuthLogin();
        $data['size_name'] = $request->size_product_name;

        DB::table('product_sizes')->where('size_id',$size_product_id)->update($data);
        Session::put('message','Cập nhật size sản phẩm thành công');
        return Redirect::to('all-size-product');
    }
    public function delete_size_product($size_product_id)
    {
        $this->AuthLogin();
        DB::table('product_sizes')->where('size_id',$size_product_id)->delete();
        Session::put('message','Xóa size sản phẩm thành công');
        return Redirect::to('all-size-product');
    }
}
