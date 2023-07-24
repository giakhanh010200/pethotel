<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardingController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\CartServiceController;
use App\Http\Controllers\CartBoardingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShopAddressController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
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
Route::get('/', [Controller::class,'welcome'])->name('welcome');
Route::get('shop', [Controller::class,'shop'])->name('shop');
Route::get('pages/shopAddress', [Controller::class,'shopAddress'])->name('pages.shopAddress');
Route::get('pages/aboutUs', [Controller::class,'aboutUs'])->name('pages.aboutUs');
Route::get('welcome', [Controller::class,'welcome'])->name('welcome');
Route::get('view_blog', [Controller::class,'view_blog'])->name('view_blog');
Route::get('product_show/{id}',[Controller::class,'product_show'])->name('product_show');
Route::get('services',[Controller::class,'services'])->name('services');
Route::get('addToWishList/{id}',[WishlistController::class,'addToWishList'])->name('addToWishList');
Route::post('addToCart/{id}',[CartProductController::class,'addToCart'])->name('addToCart');
Route::get('updateProductInCart',[CartProductController::class,'updateProductInCart'])->name('updateProductInCart');
Route::get('view_one_product/{name}',[ProductController::class,'view_one_product'])->name('view_one_product');
Route::get('searching_all', [Controller::class,'searching_all'])->name('searching_all');
Route::get('blogs_page', [NewController::class,'blogs_page'])->name('blogs_page');
Route::get('view_one_blog/{title}', [NewController::class,'view_one_blog'])->name('view_one_blog');

Route::get('boardingShop',[BoardingController::class,'boardingShop'])->name('boardingShop');
Route::get('singleBoarding/{name}',[BoardingController::class,'singleBoarding'])->name('singleBoarding');
Route::get('checkingReservation',[BoardingController::class,'checkingReservation'])->name('checkingReservation');
/*
| Admin routes
*/
Route::middleware(['CheckAdminLogin'])->group(function () {
    Route::get('users/user_info',[UserController::class,'user_info'])->name('users.user_info');
});
Route::get('admin/admin_login',[AdminController::class,'admin_login'])->name('admin/admin_login');
Route::post('admin/admin_process_login',[AdminController::class,'admin_process_login'])->name('admin/admin_process_login');
Route::middleware(['CheckAdminLogin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    Route::post('add_new_todo',[TodoController::class,'add_new_todo'])->name('add_new_todo');
    Route::put('edit_todo/{id}',[TodoController::class,'edit_todo'])->name('edit_todo');
    Route::put('change_status_check/{id}',[TodoController::class,'change_status_check'])->name('change_status_check');
    Route::delete('delete_todo/{id}',[TodoController::class,'delete_todo'])->name('delete_todo');
    Route::get('render_todo/{id}',[TodoController::class,'render_todo'])->name('render_todo');


    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::post('create_new_admin',[AdminController::class,'create_new_admin'])->name('create_new_admin');
    Route::delete('admin_del_progress/{id}',[AdminController::class,'admin_del_progress'])->name('admin_del_progress');
    Route::put('admin_update_progress/{id}',[AdminController::class,'admin_update_progress'])->name('admin_update_progress');

    Route::get('blog',[NewController::class,'blog'])->name('blog');
    Route::post('blog_upload',[NewController::class,'blog_upload'])->name('blog_upload');
    Route::post('blog_update/{id}',[NewController::class,'blog_update'])->name('blog_update');
    Route::get('delete_blog/{id}',[NewController::class,'delete_blog'])->name('delete_blog');
    Route::post('image_blog_upload',[NewController::class,'image_blog_upload'])->name('image_blog_upload');

    Route::get('admin_control',[AdminController::class,'admin_control'])->name('admin_control');
    Route::post('user_upload_new',[AdminController::class,'user_upload_new'])->name('user_upload_new');

    Route::get('cart_service',[CartServiceController::class,'cart_service'])->name('cart_service');
    Route::post('cart_service_add',[CartServiceController::class,'cart_service_add'])->name('cart_service_add');
    Route::post('add_more_service',[CartServiceController::class,'add_more_service'])->name('add_more_service');
    Route::GET('checking_price',[CartServiceController::class,'checking_price'])->name('checking_price');
    Route::post('update_cart_serv/{id}',[CartServiceController::class,'update_cart_serv'])->name('update_cart_serv');

    Route::get('boarding',[BoardingController::class,'boarding'])->name('boarding');
    Route::get('cart_boarding',[BoardingController::class,'cart_boarding'])->name('cart_boarding');
    Route::get('boarding_render/{id}',[BoardingController::class,'boarding_render'])->name('boarding_render');
    Route::put('change_stt_processing/{id}',[BoardingController::class,'change_stt_processing'])->name('change_stt_processing');
    // Route::put('cancle_cart/{id}',[BoardingController::class,'cancle_cart'])->name('cancle_cart');

    Route::get('category',[CategoryController::class,'category'])->name('category');
    Route::get('delete_category/{id}',[CategoryController::class,'delete_category'])->name('delete_category');
    Route::post('category_upload',[CategoryController::class,'category_upload'])->name('category_upload');
    Route::post('category_update/{id}',[CategoryController::class,'category_update'])->name('category_update');

    Route::get('chart',[AdminController::class,'chart'])->name('chart');

    Route::get('pet',[PetController::class,'pet'])->name('pet');
    Route::post('pet_upload',[PetController::class,'pet_upload'])->name('pet_upload');
    Route::post('pet_update/{id}',[PetController::class,'pet_update'])->name('pet_update');
    Route::get('pet_delete/{id}',[PetController::class,'pet_delete'])->name('pet_delete');

    Route::get('cart_product',[CartProductController::class,'cart_product'])->name('cart_product');
    Route::POST('cart_change_status',[CartProductController::class,'cart_change_status'])->name('cart_change_status');
    Route::get('cart_sort',[CartProductController::class,'cart_sort'])->name('cart_sort');
    Route::get('cart_full_render/{id}',[CartProductController::class,'cart_full_render'])->name('cart_full_render');

    Route::get('product',[ProductController::class,'product'])->name('product');
    Route::post('product_upload',[ProductController::class,'product_upload'])->name('product_upload');
    Route::post('product_update/{id}',[ProductController::class,'product_update'])->name('product_update');
    Route::get('delete_product/{id}',[ProductController::class,'delete_product'])->name('delete_product');
    Route::post('image_product_upload',[ProductController::class,'image_product_upload'])->name('image_product_upload');



    Route::get('service',[ServiceController::class,'service'])->name('service');
    Route::get('service_show/{id}',[ServiceController::class,'service_show'])->name('service_show');
    Route::post('service_upload',[ServiceController::class,'service_upload'])->name('service_upload');
    Route::post('service_update/{id}',[ServiceController::class,'service_update'])->name('service_update');
    Route::get('service_delete/{id}',[ServiceController::class,'service_delete'])->name('service_delete');
    Route::get('service_one/{id}',[ServiceController::class,'service_one'])->name('service_one');


    Route::get('users',[UserController::class,'users'])->name('users');

    Route::get('logout',[AdminController::class,'logout'])->name('logout');

    Route::get('shop_address',[ShopAddressController::class,'shop_address'])->name('shop_address');
    Route::post('shop_address_upload',[ShopAddressController::class,'shop_address_upload'])->name('shop_address_upload');
    Route::put('shop_address_update/{id}',[ShopAddressController::class,'shop_address_update'])->name('shop_address_update');
    Route::get('shop_address_show/{id}',[ShopAddressController::class,'shop_address_show'])->name('shop_address_show');
    Route::delete('shop_address_delete/{id}',[ShopAddressController::class,'shop_address_delete'])->name('shop_address_delete');
});

/*
| User routes
*/



Route::post('users/user_process_register',[UserController::class,'user_process_register'])->name('users.user_process_register');
Route::get('users/user_register',[UserController::class,'user_register'])->name('users.user_register');

Route::get('users/user_reset_password',[UserController::class,'user_reset_password'])->name('users.user_reset_password');
Route::post('users/forgot_password_reset',[UserController::class,'forgot_password_reset'])->name('users.forgot_password_reset');

Route::get('users/user_mail_reset_password/{token}',[UserController::class,'user_mail_reset_password'])->name('users.user_mail_reset_password');
Route::post('users/user_submit_reset_password',[UserController::class,'user_submit_reset_password'])->name('users.user_submit_reset_password');

Route::get('users/user_login',[UserController::class,'user_login'])->name('users.user_login');
Route::post('users/user_process_login',[UserController::class,'user_process_login'])->name('users.user_process_login');
Route::middleware(['CheckUserLogin'])->name('users.')->prefix('users')->group(function () {
    Route::get('user_info',[UserController::class,'user_info'])->name('user_info');
    Route::get('logout',[UserController::class,'logout'])->name('logout');


    Route::get('reservationConfirm',[BoardingController::class,'reservationConfirm'])->name('reservationConfirm');
    Route::post('reservationPayment',[BoardingController::class,'reservationPayment'])->name('reservationPayment');
    Route::get('reservationReceived',[BoardingController::class,'reservationReceived'])->name('reservationReceived');
    Route::get('boarding_details/{id}',[BoardingController::class,'boarding_details'])->name('boarding_details');

    Route::post('user_address_add',[UserController::class,'user_address_add'])->name('user_address_add');
    Route::put('user_address_update/{id}',[UserController::class,'user_address_update'])->name('user_address_update');
    Route::get('user_address_show/{id}',[UserController::class,'user_address_show'])->name('user_address_show');
    Route::delete('user_address_del/{id}',[UserController::class,'user_address_del'])->name('user_address_del');
    Route::put('change_account_prof/{id}',[UserController::class,'change_account_prof'])->name('change_account_prof');
    Route::put('change_new_password/{id}',[UserController::class,'change_new_password'])->name('change_new_password');

    Route::get('products_cart_users', [CartProductController::class,'products_cart_users'])->name('products_cart_users');
    Route::get('delete_product_cart/{id}', [CartProductController::class,'delete_product_cart'])->name('delete_product_cart');
    Route::get('checkout_cart_product',[CartProductController::class,'checkout_cart_product'])->name('checkout_cart_product');
    Route::post('cart_success_payment',[CartProductController::class,'cart_success_payment'])->name('cart_success_payment');
    Route::POST('user_cancle_order',[CartProductController::class,'user_cancle_order'])->name('user_cancle_order');
    Route::get('cart_render',[CartProductController::class,'cart_render'])->name('cart_render');
    Route::put('user_confirm_deli',[CartProductController::class,'user_confirm_deli'])->name('user_confirm_deli');
    Route::get('cart_details/{id}',[CartProductController::class,'cart_details'])->name('cart_details');



    Route::get('products_wishlist',[WishlistController::class,'products_wishlist'])->name('products_wishlist');
    Route::delete('delete_product_wishlist/{id}',[WishlistController::class,'delete_product_wishlist'])->name('delete_product_wishlist');
});
