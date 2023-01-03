<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProductController extends Controller
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
    public function add_category_product()
    {
        $this->AuthLogin();
        return view('admin.Category.addCategoryProduct');
    }

    public function all_category_product()
    {
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_products')->get();
        $manager_category_product = view('admin.Category.allCategoryProduct')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.Category.allCategoryProduct',$manager_category_product);
    }
    public function save_category_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_products')->insert($data);
        Session::put('message','Thêm Danh Mục Sản Phẩm Thành Công');
        return Redirect::to('/all-category-product');
       
    }
    public function unactive_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_products')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_products')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id)
    {
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_products')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.Category.editCategoryProduct')->with('edit_category_product',$edit_category_product);

        return view('admin_layout')->with('admin.Category.editCategoryProduct',$manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;

        DB::table('tbl_category_products')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_products')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    //End function Admin Page
    public function show_category_home($category_id)
    {
        $cate_product = DB::table('tbl_category_products')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_products')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $category_by_id = DB::table('tbl_products')->join('tbl_category_products','tbl_products.category_id','=',
        'tbl_category_products.category_id')->where('tbl_products.category_id',$category_id)->get();

        $category_name = DB::table('tbl_category_products')->where('tbl_category_products.category_id',$category_id)->limit(1)->get(); //lấy ra tên 1 sản phẩm

        return view('pages.category.showCategory')->with('category',$cate_product)->with('brand',$brand_product)
            ->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }
}
