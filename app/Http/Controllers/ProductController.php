<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
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
    public function add_product()
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_products')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_products')->orderby('brand_id','desc')->get();
        $color_product = DB::table('product_colors')->orderby('color_id','desc')->get();
        $size_product = DB::table('product_sizes')->orderby('size_id','desc')->get();
       

        return view('admin.Product.addProduct')->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product)->with('color_product',$color_product)->with('size_product',$size_product);
        
    }

    public function all_product()
    {
        $this->AuthLogin();
        $all_product = DB::table('tbl_products')
        ->join('tbl_category_products','tbl_category_products.category_id','=','tbl_products.category_id')
        ->join('tbl_brand_products','tbl_brand_products.brand_id','=','tbl_products.brand_id')
        ->join('product_colors','product_colors.color_id','=','tbl_products.product_color')
        ->join('product_sizes','product_sizes.size_id','=','tbl_products.product_size')
        ->orderBy('tbl_products.product_id','desc')->paginate(2);
        $manager_product = view('admin.Product.allProduct')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.Product.allProduct',$manager_product);
    }
    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_color'] = $request->product_color;
        $data['product_size'] = $request->product_size;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.random_int(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/products',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_products')->insert($data);
            Session::put('message','Thêm Sản Phẩm Thành Công');
            return Redirect::to('all-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_products')->insert($data);
        Session::put('message','Thêm Sản Phẩm Thành Công');
        return Redirect::to('all-product');
       
    }
    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_products')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function active_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_products')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_products')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_products')->orderby('brand_id','desc')->get();
        $color_product = DB::table('product_colors')->orderby('color_id','desc')->get();
        $size_product = DB::table('product_sizes')->orderby('size_id','desc')->get();

        $edit_product = DB::table('tbl_products')->where('product_id',$product_id)->get();

        $manager_product = view('admin.Product.editProduct')->with('edit_product',$edit_product)->with('cate_product',$cate_product)
            ->with('brand_product',$brand_product)->with('color_product',$color_product)->with('size_product',$size_product);

        return view('admin_layout')->with('admin.Product.editProduct',$manager_product);
    }
    public function update_product(Request $request,$product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_color'] = $request->product_color;
        $data['product_size'] = $request->product_size;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.random_int(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/products',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_products')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập Nhật Sản Phẩm Thành Công');
            return Redirect::to('all-product');
        }
        DB::table('tbl_products')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập Nhật Sản Phẩm Thành Công');
        return Redirect::to('all-product');
       
    }
    public function delete_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_products')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }

    //End function AdminPage

    public function details_product($product_id)
    {
        $cate_product = DB::table('tbl_category_products')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_products')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $color_product = DB::table('product_colors')->orderby('color_id','desc')->get();

        $size_product = DB::table('product_sizes')->orderby('size_id','desc')->get();

        $details_product = DB::table('tbl_products')
        ->join('tbl_category_products','tbl_category_products.category_id','=','tbl_products.category_id')
        ->join('tbl_brand_products','tbl_brand_products.brand_id','=','tbl_products.brand_id')
        ->join('product_colors','product_colors.color_id','=','tbl_products.product_color')
        ->join('product_sizes','product_sizes.size_id','=','tbl_products.product_size')
        ->where('tbl_products.product_id',$product_id)->get(); //lấy ra thông tin sản phẩm

        foreach($details_product as $key => $value){
            $category_id = $value->category_id;     
        }

        $related_product = DB::table('tbl_products')
        ->join('tbl_category_products','tbl_category_products.category_id','=','tbl_products.category_id')
        ->join('tbl_brand_products','tbl_brand_products.brand_id','=','tbl_products.brand_id')
        ->join('product_colors','product_colors.color_id','=','tbl_products.product_color')
        ->join('product_sizes','product_sizes.size_id','=','tbl_products.product_size')
        ->where('tbl_category_products.category_id',$category_id)->whereNotIn('tbl_products.product_id',[$product_id])->get(); //lấy ra các thông tin sản phẩm liên quan


        return view('pages.product.showDetails')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('color_product',$color_product)
        ->with('size_product',$size_product)
        ->with('product_details',$details_product)->with('related_product',$related_product);
    }
}
