<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\CartProduct;
use Illuminate\Support\Str;
use App\Models\Products;
use App\Models\Category;
use App\Models\Pet;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Users;
use App\Models\UsersAddress;
use Useraddress;

class CartProductController extends Controller
{
    public function cart_product(Request $request){
        $search = $request->get('search');
        $sort = $request->get('sort');
        //dd($search, $sort);
        // ->where("status","=",$sort)

        if($sort == 0 || $sort == null){
            $array_cart = CartProduct::orderBy("payment_at","desc")->where("cart_id_render","like","%$search%")->orderBy("cart_id_render",'asc')->get();
        }else{
            $array_cart = CartProduct::orderBy("payment_at","desc")->where("cart_id_render","like","%$search%")->where("status","=",$sort)->orderBy("cart_id_render",'asc')->get();
        }

        $array_product = Products::all();
        $array_address = UsersAddress::all();
        $array_users = Users::all();
        return view('admin.cart_product',[
            'array_cart' => $array_cart,
            'array_product' => $array_product,
            'array_address' => $array_address,
            'array_users'=> $array_users,
        ]);
    }

    public function products_cart_users(){
        $array_pet = Pet::all();
        $array_cate = Category::all();
        $user_id = session()->get('user_id');
        $array_cart = CartProduct::orderBy("id", "desc")->where('user_id','=',$user_id)->where('status','=',1)->get();
        $array_products = Products::all();
        $check = count($array_cart);
        return view('users.productCart',[
            'array_products' => $array_products,
            'array_cate' => $array_cate,
            'array_pet' => $array_pet,
            'array_cart' => $array_cart,
            'check' => $check,
        ]);
    }
    public function addToCart($id, Request $request){
        $data = new CartProduct();
        $arr_prd = new Products();
        $log = 100;
        $user_id = (int)$request->get('user_id');
        $prd_id = (int)$request->get('prd_id');
        $arr_prd = $arr_prd->where('id','=',$prd_id)->get();
        $max_val = $arr_prd[0]->quantity;
        $price = $arr_prd[0]->sale_price;
        $cart_prd = CartProduct::where('user_id','=',$user_id)->where('status','=',1)->get();
        $check = count($cart_prd);
        if($max_val > 0){
            $qty = (int)$request->get('quantity');
            if ($qty > 0){
                if($check >=1){

                    $cart_prd1 = CartProduct::where('product_id','=',$prd_id)->where('user_id','=',$user_id)->where('status','=',1)->get();
                    $check1 = count($cart_prd1);
                    if($check1 == 1){
                        $quantity = $cart_prd1[0]->quantity;
                        $quantity += (int)$request->get('quantity');
                        if($quantity > $max_val){
                            $log = 200;
                            $msg = 'We do not have enough products! Quantity of this product is bigger than quantity in stock';
                        }else{
                            CartProduct::where('product_id','=',$prd_id)->where('user_id','=',$user_id)->where('status','=',1)->update(['quantity'=>$quantity]);
                            $msg = 'This product quantity has been updated successfully!!!';
                            $log = 300;
                        };
                    }
                    if($check1 ==0){
                        $quantity = (int)$request->get('quantity');
                        if($quantity > $max_val){
                            $log = 200;
                            $msg = "you can only add $max_val products";
                        }else{
                            $cart_id_render = $cart_prd[0]->cart_id_render;
                        $created_at = $cart_prd[0]->created_at;
                        $data->cart_id_render = $cart_id_render;

                        $data->quantity = $quantity;
                        $data->user_id = (int)$request->get('user_id');
                        $data->status = 1;
                        $data->created_at = $created_at;
                        $data->product_id = (int)$request->get('prd_id');
                        $data->total_prices = $price * $quantity;
                        $data->save();
                        $msg = 'This product has been inserted into your cart';
                        $log = 400;
                        }
                    }
                }else{
                    $quantity = (int)$request->get('quantity');
                if($quantity > $max_val){
                    $log = 200;
                    $msg = "you can only add $max_val products";
                }else{
                    $cart_id_render = Carbon::now()->toDateString(). "_" .Str::random(15);
                $data->cart_id_render = $cart_id_render;
                $data->quantity = $quantity;
                $data->user_id = (int)$request->get('user_id');
                $data->status = 1;
                $data->created_at = Carbon::now()->toDateTimeString();
                $data->product_id = (int)$request->get('prd_id');
                $data->total_prices = $price * $quantity;
                $data->save();
                $msg = 'This product has been inserted into your cart';
                $log = 500;
                }
                }
            }else{
                $log=700;
                $msg = 'you must add at least 1 product';
            }
        }else{
            $log = 600;
            $msg = 'This product is out of stock';
        }
        return response()->json([
            'log' => $log,
            'msg' => $msg,
        ]);
    }

    public function updateProductInCart(Request $request){
        $cart_id = $request->get('cart_id');
        $product_quantity = $request->get('product_quantity');
        $length = count($cart_id);
        $msg = '';
        for($i = 0; $i < $length; $i++){
            $id_cart = (int)$cart_id[$i];
            $array_cart = new CartProduct;
            $array_cart= $array_cart->where('id','=',$id_cart)->get();
            $prd_id = $array_cart[0]->product_id;
            $array_product = new Products();
            $array_product = $array_product->where('id','=',$prd_id)->get();
            $price = $array_product[0]->sale_price;
            $quantity = (int)$product_quantity[$i];
            $total_prices = $quantity * $price;
            $arr_cart = new CartProduct;
            if($quantity > 0){
                $arr_cart = $arr_cart->where('id','=',$id_cart)->update(['quantity'=>$quantity,'total_prices'=>$total_prices]);
            }else{
                $arr_cart = $arr_cart->where('id','=',$id_cart)->get();
                $arr_cart->delete();
            }
        }

        return response()->json([
            'msg' => $product_quantity,
        ]);
    }

    public function delete_product_cart($id, Request $request){
        CartProduct::find($id)->delete();
        return redirect()->back()->with('delete', 'Delete product from your cart successfully!!!');
    }

    public function checkout_cart_product(Request $request){
        $user_id = $request->session()->get('user_id');
        $array_products = Products::all();
        $array_pet = Pet::all();
        $array_cate = Category::all();
        $array_cart = CartProduct::where('user_id','=',$user_id)->where('status','=',1)->get();
        $array_add = UsersAddress::where('user_id','=',$user_id)->get();
        return view('users.productCartPayment',[
            'array_cart'=>$array_cart,
            'array_add'=>$array_add,
            'array_products'=> $array_products,
            'array_cate'=> $array_cate,
            'array_pet'=> $array_pet,
        ]);
    }
    public function cart_success_payment(Request $request){
        $cart_id = $request->get('cart_id');
        $address_id=$request->get('address_id');
        $now = Carbon::now()->format('Y-m-d');
        $array_add = UsersAddress::where('id','=',$address_id)->get();
        $array_cart = CartProduct::where('cart_id_render','=',$cart_id)->get();
        $array_products = Products::all();
        foreach ( $array_cart as $arrc){
            $qty = $arrc->quantity;
            foreach($array_products as $arrp){
                if ($arrc->product_id == $arrp->id){
                    if($qty > $arrp->quantity){
                        $product = $arrp->name;
                        return response()->json([
                            'product'=>$product
                        ]);
                    }else{
                    $arrp->quantity = $arrp->quantity - $qty;
                    $arrc->product_name = $arrp->name;
                    $arrc->product_price = $arrp->sale_price;
                    $arrc->product_thumbnail = $arrp->thumbnail;
                    $arrc->payment_at = $now;
                    $arrp->save();
                    }
                }
            }
            $arrc->user_address = $array_add[0]->address;
            $arrc->user_name = $array_add[0]->name;
            $arrc->user_phone = $array_add[0]->phone;
            $arrc->status = 2;
            $arrc->save();
        };
        return response()->json([
            'data' => $array_cart,
            'data2' => $array_products
        ]);

    }

    public function cart_render(Request $request){
        $id = $request->get('id');
        $array_cart = CartProduct::where('cart_id_render','=', $id)->get();
        $totalPrice = 0;
        foreach($array_cart as $arrc){
            $totalPrice = $arrc->total_prices + $totalPrice;
        }
        return response()->json([
            'data' => $array_cart,
            'totalPrice'=>$totalPrice
        ]);
    }

    public function user_cancle_order(Request $request){
        $cart_id = $request->get('cart_id');
        $array_cart = CartProduct::where('cart_id_render','=', $cart_id)->get();

        $status = $array_cart[0]->status;
        if($status == 3){
            return response()->json([
                'data' => $array_cart,
                'msg' => "Your order ($cart_id) has been confirmed, if you want to cancel your order, contact us!!! Thank you"
            ]);
        }
        if($status != 2 && $status != 3){
            return response()->json([
                'data' => $array_cart,
                'msg' => "Your order ($cart_id) has been cancled, if you have any questions, please contact us!!! Thank you"
            ]);
        }
        if($status == 2){
            $array_product = Products::all();
            foreach($array_cart as $arrc){
                $qty = $arrc->quantity;
                foreach($array_product as $arrp){
                    if($arrc->product_id == $arrp->id){
                        $arrp->quantity =$arrp->quantity + $qty;
                        $arrp->save();
                    }

                }
                $arrc->status = 4;
                // $arrc->save();
            }
                $msg = "You have cancled your order ($cart_id), if you have any questions, please contact us!!! Thank you";
            return response()->json([
                'data'=>$array_cart,
                'msg' => $msg,
                'status' => $status
            ]);
        };
    }
    public function cart_change_status (Request $request){
        $cart_id = $request->get('cart_id');
        $level = Session::get('level');
        $status = $request->get('value');
        $array_cart = CartProduct::where('cart_id_render','=', $cart_id)->get();
        $status_cart = $array_cart[0]->status;
        $err = false;
        if($level < 4 && $status_cart != 2){
            $err = true;
        }
        if($err == false){
            if(($status == 4 || $status == 5 || $status == 7) && ($status_cart == 4 ||$status_cart==5 || $status_cart ==7) || ($status == 6 || $status == 2 || $status == 3) && ($status_cart == 2 ||$status_cart==3 || $status_cart ==6) ){
                foreach($array_cart as $arrc){
                    $arrc->status = $status;
                    $arrc->save();
                }
            }
            if(($status == 4 || $status == 5 || $status == 7) && ($status_cart == 2 || $status_cart == 3 || $status_cart == 6))
            {
                $array_prd = Products::all();
                foreach($array_cart as $arrc){
                    $quantity = $arrc->quantity;
                    foreach($array_prd as $arrp){
                        if($arrc->product_id == $arrp->id){
                            $arrp->quantity = $arrp->quantity + $quantity;
                            $arrp->save();
                            break;
                        }
                    }
                    $arrc->status = $status;
                    $arrc->save();
                }
            }
            if(($status == 2 || $status == 3 || $status == 6) && ($status_cart == 4 || $status_cart == 5 || $status_cart == 7))
            {
                $array_prd = Products::all();
                foreach($array_cart as $arrc){
                    $quantity = $arrc->quantity;
                    foreach($array_prd as $arrp){
                        if($arrc->product_id == $arrp->id){
                            $arrp->quantity = $arrp->quantity - $quantity;
                            $arrp->save();
                            break;
                        }
                    }
                    $arrc->status = $status;
                    $arrc->save();
                }
            }
        }
        return response()->json([
            'data'=>$array_cart,
            'stt'=>$status_cart,
            'level'=> $level,
            'err' => $err
        ]);
    }

    public function user_confirm_deli(Request $request){
        $cart_id = $request->get('cart_id');
        $msg="";
        $array_cart = CartProduct::where('cart_id_render','=', $cart_id)->get();
        $status = $array_cart[0]->status;
        if($status !=3){
            $msg = "Your order has been cancle";
        }else{
            foreach ($array_cart as $arrc){
                $arrc->status = 6;
                $arrc->save();
            }
            $msg = "You have just confirmed that you have received your order ($cart_id)";
        }

        return response()->json([
            'data'=>$array_cart,
            'msg'=>$msg,
            'status'=>$status

        ]);
    }

    public function cart_details(Request $request,$id){
        $cart_id = $id;
        $array_cart = CartProduct::where('cart_id_render','=',$cart_id)->get();
        $full_price = 0;
        foreach ($array_cart as $arrc){
            $full_price = $arrc->total_prices + $full_price;
        }

        return view('users.detailsCartProduct',[
            'array_cart' => $array_cart,
            'full_price' => $full_price
        ]);
    }

    public function cart_full_render(Request $request,$id){
        $cart_id = $id;
        $cart = CartProduct::where('cart_id_render','=',$cart_id)->get();
        $product = Products::all();
        $user_id = $cart[0]->user_id;
        $user = Users::where("id","=",$user_id)->get();
        $full_price = 0;
        $count = count($cart);
        foreach ($cart as $dt){
            $full_price = $dt->total_prices + $full_price;
            foreach($product as $prd){
                if($prd->id == $dt->product_id && $dt->product_price == null){
                    $dt->product_name = $prd->name;
                    $dt->product_price = $prd->sale_price;
                }
            }
            if($dt->user_name == null){
                $dt->user_name = $user[0]->username;
            }
        }
        return response()->json([
            'data' => $cart,
            'count' => $count,
            'full_price' => $full_price
        ]);
    }
}
