<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductColorController extends Controller
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
    public function add_color_product()
    {
        $this->AuthLogin();
        return view('admin.Color.addColorProduct');
    }

    public function all_color_product()
    {
        $this->AuthLogin();
        $all_color_product = DB::table('product_colors')->get();
        $manager_color_product = view('admin.Color.allColorProduct')->with('all_color_product',$all_color_product);
        return view('admin_layout')->with('admin.Color.allColorProduct',$manager_color_product);
    }
    public function save_color_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['color_name'] = $request->color_product_name;
        $data['color_status'] = $request->color_product_status;

        DB::table('product_colors')->insert($data);
        Session::put('message','Thêm Màu Sản Phẩm Thành Công');
        return Redirect::to('/all-color-product');
       
    }
    public function unactive_color_product($color_product_id)
    {
        $this->AuthLogin();
        DB::table('product_colors')->where('color_id',$color_product_id)->update(['color_status'=>0]);
        Session::put('message','Không kích hoạt màu sản phẩm thành công');
        return Redirect::to('all-color-product');
    }
    public function active_color_product($color_product_id)
    {
        $this->AuthLogin();
        DB::table('product_colors')->where('color_id',$color_product_id)->update(['color_status'=>1]);
        Session::put('message','Kích hoạt màu sản phẩm thành công');
        return Redirect::to('all-color-product');
    }
    public function edit_color_product($color_product_id)
    {
        $this->AuthLogin();
        $edit_color_product = DB::table('product_colors')->where('color_id',$color_product_id)->get();
        $manager_color_product = view('admin.Color.editColorProduct')->with('edit_color_product',$edit_color_product);

        return view('admin_layout')->with('admin.editColorProduct',$manager_color_product);
    }
    public function update_color_product(Request $request,$color_product_id)
    {
        $this->AuthLogin();
        $data['color_name'] = $request->color_product_name;

        DB::table('product_colors')->where('color_id',$color_product_id)->update($data);
        Session::put('message','Cập nhật màu sản phẩm thành công');
        return Redirect::to('all-color-product');
    }
    public function delete_color_product($color_product_id)
    {
        $this->AuthLogin();
        DB::table('product_colors')->where('color_id',$color_product_id)->delete();
        Session::put('message','Xóa màu sản phẩm thành công');
        return Redirect::to('all-color-product');
    }
}
