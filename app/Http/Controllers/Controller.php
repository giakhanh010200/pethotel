<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Pet;
use App\Models\Services;
use App\Models\Products;
use App\Models\ShopAddress;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Boarding;
use App\Models\News;
use App\Models\Wishlist;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function welcome(){
        $array_pet = Pet::get();
        $array_services = Services::get();

        $array_products_new = Products::orderBy('id', 'desc')->limit(12)->get();

        return view('welcome',[
            'array_pet' => $array_pet,
            'array_services' => $array_services,
            'array_products_new' => $array_products_new,
        ]);
    }

    public function searching_all(Request $request){
        $search = $request->get('searchingAll');
        $all_array = [];
        $user_id = $request->session()->get('user_id');
        $array_products = Products::where("name","like","%$search%")->get();
        $array_cate = Category::all();
        $array_pet = Pet::all();
        $array_wishlist = Wishlist::where('user_id','=',$user_id)->get();
        $array_news = News::where("title","like","%$search%")->orWhere("content","like","%$search%")->get();

        $array_service = Services::where("name","like","%$search%")->get();
        return view('field-search',[
            'array_products'=>$array_products,
            'array_news' => $array_news,
            'array_service' => $array_service,
            'search' => $search,
            'array_pet'=> $array_pet,
            'array_cate'=> $array_cate,
            'array_wishlist'=>$array_wishlist
        ]);
    }
    public function product_show($id, Request $request){
        $array_products = Products::find($id);
        $log = 400;
        $prd_id = (int)$id;
        if(session()->has('user_id')){
            $user_id = $request->session()->get('user_id');
            $array_wish = new Wishlist();
            $array_wish = $array_wish->where('user_id','=',$user_id);
            $array_wish = $array_wish->where('product_id','=',$prd_id);
            $array_wish = $array_wish->get();
            $check = count($array_wish);
            if ($check == 1){
                $log = 200;
            }
        }
        return response()->json([
            'data'=>$array_products,
            'log' =>$log,
        ],200);
    }
    public function aboutUs(){
        return view('pages.aboutUs');
    }
    public function shop(Request $request){
        $sort = $request->get('sortorder');
        $min = $request->get('minamount');
        $max = $request->get('maxamount');
        $cate_id = $request->get('category_id');
        $pet_id = $request->get('pet_id');
        $array_category = Category::get();
        $array_pet = Pet::get();
        $array_products = new Products();

        if($min != ''){
            $array_products = $array_products->where('sale_price','>=',$min);
        }
        if($max != ''){
            $array_products = $array_products->where('sale_price','<=',$max);
        }
        if($cate_id != ''){
            $checked_cate = $_GET['category_id'];
            $array_category_filter = Category::whereIn('name',$checked_cate)->get();
            $subcateid = [];
            foreach($array_category_filter as $acf){
                array_push($subcateid,$acf->id );
            };
            $array_products = $array_products->whereIn('category_id' ,$subcateid);
        }
        if($pet_id != ''){
            $checked_pet = $_GET['pet_id'];
            $array_pet_filter = Pet::whereIn('name',$checked_pet)->get();
            $subpetid = [];
            foreach($array_pet_filter as $apf){
                array_push($subpetid,$apf->id );
            };
            $array_products = $array_products->whereIn('pet_id' ,$subpetid);
        }
        if($sort != ''){
            if ($sort == "product_price_low_high") {
                $array_products = $array_products->orderBy('sale_price', 'asc');
            } elseif ($sort == "product_price_high_low") {
                $array_products = $array_products->orderBy('sale_price', 'desc');
            } elseif ($sort == "product_latest") {
                $array_products = $array_products->orderBy('id', 'desc');
            } elseif ($sort == "product_relevance") {
                $array_products = $array_products->orderBy('id', 'asc');
            }
        }

        $array_products = $array_products->paginate(12);
        $user_id = $request->session()->get('user_id');
        $count =0;
        $wishlist = new Wishlist();
        if($user_id != null){

            $wishlist = $wishlist->where('user_id','=',$user_id)->get();
            $count = count($wishlist);
        }
        return view('shop',[
            'array_products'=>$array_products,
            'array_category' => $array_category,
            'array_pet' => $array_pet,
            'wishlist' => $wishlist,
            'count' => $count,
        ]);

    }
    public function shopAddress(){
        $array_address = ShopAddress::orderBy('id', 'desc')->limit(8)->get();
        return view('pages.shopAddress',[
            'array_address' => $array_address,
        ]);
    }
    public function view_blog(){

    }

    public function fetch_products_data(Request $request){
        $filters = $request->all();
        $array_products = new Products();
        if ($filters['sort'] == "product_price_low_high") {
            $array_products = $array_products->orderBy('sale_price', 'asc');
        } elseif ($filters['sort'] == "product_price_high_low") {
            $array_products = $array_products->orderBy('sale_price', 'desc');
        } elseif ($filters['sort'] == "product_latest") {
            $array_products = $array_products->orderBy('id', 'desc');
        } elseif ($filters['sort'] == "product_relevance") {
            $array_products = $array_products->orderBy('id', 'asc');
        }
        $array_products = $array_products->paginate(12);
        return response()->json([
            'data'=>$array_products,
        ],200);
    }

    public function services(){
        $array_services = Services::get();
        return view('services',['array_services'=>$array_services]);
    }

}
