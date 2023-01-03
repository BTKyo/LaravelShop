<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function index()
    {
        $cate_product = DB::table('tbl_category_products')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_products')->where('brand_status','1')->orderby('brand_id','desc')->get();

        // $all_product = DB::table('tbl_products')
        // ->join('tbl_category_products','tbl_category_products.category_id','=','tbl_products.category_id')
        // ->join('tbl_brand_products','tbl_brand_products.brand_id','=','tbl_products.brand_id')
        // ->join('product_colors','product_colors.color_id','=','tbl_products.product_color')
        // ->join('product_sizes','product_sizes.size_id','=','tbl_products.product_size')
        // ->orderBy('tbl_products.product_id','desc')->get();

        $all_product = DB::table('tbl_products')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();

        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }
    public function search(Request $request)
    {
        $keyword = $request->keyword_submit;
        $cate_product = DB::table('tbl_category_products')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_products')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $search_product = DB::table('tbl_products')->where('product_name','like','%'. $keyword .'%')->get();

        return view('pages.product.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }
}
