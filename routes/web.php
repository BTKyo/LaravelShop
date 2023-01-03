<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\BrandProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu',[HomeController::class, 'index']);
Route::post('/tim-kiem',[HomeController::class, 'search']);

//Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}',[CategoryProductController::class, 'show_category_home']);
Route::get('/thuong-hieu-san-pham/{brand_id}',[BrandProductController::class, 'show_brand_home']);
Route::get('/chi-tiet-san-pham/{product_id}',[ProductController::class, 'details_product']);

//Backend
Route::get('/admin',[AdminController::class, 'index']);
Route::get('/dashboard',[AdminController::class, 'show_dashboard']);
Route::post('/admin-dashboard',[AdminController::class, 'dashboard']);
Route::get('/logout',[AdminController::class, 'logout']);


//Category Product
Route::get('/add-category-product',[CategoryProductController::class, 'add_category_product']);
Route::get('/edit-category-product/{category_product_id}',[CategoryProductController::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}',[CategoryProductController::class, 'delete_category_product']);
Route::get('/all-category-product',[CategoryProductController::class, 'all_category_product']);

Route::get('/unactive-category-product/{category_product_id}',[CategoryProductController::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}',[CategoryProductController::class, 'active_category_product']);

Route::post('/save-category-product',[CategoryProductController::class, 'save_category_product']);
Route::post('/update-category-product/{category_product_id}',[CategoryProductController::class, 'update_category_product']);


//BrandProduct
Route::get('/add-brand-product',[BrandProductController::class, 'add_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}',[BrandProductController::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}',[BrandProductController::class, 'delete_brand_product']);
Route::get('/all-brand-product',[BrandProductController::class, 'all_brand_product']);

Route::get('/unactive-brand-product/{brand_product_id}',[BrandProductController::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}',[BrandProductController::class, 'active_brand_product']);

Route::post('/save-brand-product',[BrandProductController::class, 'save_brand_product']);
Route::post('/update-brand-product/{brand_product_id}',[BrandProductController::class, 'update_brand_product']);


//ProductColor
Route::get('/add-color-product',[ProductColorController::class, 'add_color_product']);
Route::get('/edit-color-product/{color_product_id}',[ProductColorController::class, 'edit_color_product']);
Route::get('/delete-color-product/{color_product_id}',[ProductColorController::class, 'delete_color_product']);
Route::get('/all-color-product',[ProductColorController::class, 'all_color_product']);

Route::get('/unactive-color-product/{color_product_id}',[ProductColorController::class, 'unactive_color_product']);
Route::get('/active-color-product/{color_product_id}',[ProductColorController::class, 'active_color_product']);

Route::post('/save-color-product',[ProductColorController::class, 'save_color_product']);
Route::post('/update-color-product/{brand_color_id}',[ProductColorController::class, 'update_color_product']);


//ProductSize
Route::get('/add-size-product',[ProductSizeController::class, 'add_size_product']);
Route::get('/edit-size-product/{size_product_id}',[ProductSizeController::class, 'edit_size_product']);
Route::get('/delete-size-product/{size_product_id}',[ProductSizeController::class, 'delete_size_product']);
Route::get('/all-size-product',[ProductSizeController::class, 'all_size_product']);

Route::get('/unactive-size-product/{size_product_id}',[ProductSizeController::class, 'unactive_size_product']);
Route::get('/active-size-product/{size_product_id}',[ProductSizeController::class, 'active_size_product']);

Route::post('/save-size-product',[ProductSizeController::class, 'save_size_product']);
Route::post('/update-size-product/{size_product_id}',[ProductSizeController::class, 'update_size_product']);


//Product
Route::get('/add-product',[ProductController::class, 'add_product']);
Route::get('/edit-product/{product_id}',[ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}',[ProductController::class, 'delete_product']);
Route::get('/all-product',[ProductController::class, 'all_product']);

Route::get('/unactive-product/{product_id}',[ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}',[ProductController::class, 'active_product']);

Route::post('/save-product',[ProductController::class, 'save_product']);
Route::post('/update-product/{product_id}',[ProductController::class, 'update_product']);


//Cart
Route::post('/save-cart',[CartController::class, 'save_cart']);
Route::get('/show-cart',[CartController::class, 'show_cart']);
Route::get('/delete-to-cart/{rowId}',[CartController::class, 'delete_to_cart']);
Route::post('/update-cart-quantity',[CartController::class, 'update_cart_quantity']);


//checkout
Route::get('/login-checkout',[CheckoutController::class, 'login_checkout']);
Route::post('/add-customer',[CheckoutController::class, 'add_customer']);
Route::post('/login-customer',[CheckoutController::class, 'login_customer']);
Route::get('/check-out',[CheckoutController::class, 'checkout']);
Route::post('/save-checkout-customer',[CheckoutController::class, 'save_checkout_customer']);
Route::get('/payment',[CheckoutController::class, 'payment']);
Route::get('/logout-checkout',[CheckoutController::class, 'logout_checkout']);
Route::post('/order-place',[CheckoutController::class, 'order_place']);


//order
Route::get('/manager-order',[CheckoutController::class, 'manager_order']);
Route::get('/view-order/{orderId}',[CheckoutController::class, 'view_order']);
