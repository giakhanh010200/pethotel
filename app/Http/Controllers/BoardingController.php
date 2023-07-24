<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boarding;
use App\Models\ShopAddress;
use App\Models\Pet;
use App\Models\CartBoarding;
use Illuminate\Support\Str;
use App\Http\Controllers\Session;
use Carbon\Carbon;

class BoardingController extends Controller
{
    public function boarding(){
        return view('admin.boarding');
    }
    public function cart_boarding(Request $request){
        $search = $request->get('search');
        $sort = $request->get('sort');
        if($sort == 0 || $sort == null){
            $array_cart = CartBoarding::orderBy('id', 'desc')->where("cart_id","like","%$search%")->paginate(10);
        }else if($sort == 5){
            $now = Carbon::now()->toDateString();
            $array_cart = CartBoarding::where("cart_id","like","%$search%")->where('end_date','<',$now)->orderBy('end_date', 'desc')->paginate(10);
        }else{
            $array_cart = CartBoarding::where("cart_id","like","%$search%")->where('status','=',$sort)->orderBy('end_date', 'desc')->paginate(10);
            // dd($array_cart);
        }

        return view('admin.cart_boarding',[
            'array_cart'=>$array_cart
        ]);
    }
    public function boardingShop(){
        $array_boarding = Boarding::all();
        return view('boarding',[
            'array_boarding' => $array_boarding,
        ]);
    }

    public function singleBoarding(Request $request, $name){
        $singleBoard = new Boarding();
        $singleBoard = $singleBoard->where('name','=',$name)->get();
        $array_shop = ShopAddress::all();
        $array_pet = Pet::all();
        //dd($singleBoard);
        return view('singleBoarding',[
            'singleBoard' => $singleBoard,
            'shopAddress' => $array_shop,
            'array_pet' => $array_pet
        ]);
    }

    public function checkingReservation(Request $request){
        $max = 5;
        $count = 0;
        $count_re = 0;
        $msg = "";
        $log = 100;
        $id = $request->get('id');
        $boarding = Boarding::where('id',$id)->get();
        $boarding_name = $boarding[0]->name;
        $store = $request->get('store');
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $pet = $request->get('pet');
        $array_boarding = CartBoarding::where("boarding_id","=",$id)->where("store_id","=",$store)->where("pet_id","=",$pet)->get();
        foreach($array_boarding as $arrb){
            $start = $arrb->start_date;
            $end = $arrb->end_date;
            if($startDate < $start && $endDate > $start || $startDate < $end && $endDate > $end || $startDate < $start && $endDate > $end || $startDate > $start && $endDate < $end ){
                $count = $count +1;
            }
        }
        if ($count >= $max){
            $log = 200;
            $msg = "We are full for $boarding_name at this store, Please choose another date or change another store !!!";
        }else{
            $count_re = $max - $count;
            $msg = "We have $count_re available accommodations, Choose number of pet you want to reservation";
        }

        return response()->json([
            'msg'=>$msg,
            'count' => $count_re,
            'log'=>$log
        ],200);
    }
    // public function viewCartBoardingPayment(Request $request){
    //     $total_pet = $request->session()->get('total_pet');
    //     return view("users.boardingCartPayment",[
    //         'total_pet' => $total_pet,
    //     ]);
    // }
    public function reservationConfirm(Request $request){
        $total_pet = $request->get('quantity');
        $boarding_id = $request->get('boarding_id');
        $boarding = Boarding::where('id', $boarding_id)->get();
        $store_id = $request->get('store');
        $store = ShopAddress::where('id','=',$store_id)->get();
        $quantity = $request->get('quantity');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $pet_id = $request->get('pet');
        $pet = Pet::where('id','=',$pet_id)->get();
        return view("users.boardingCartPayment",[
            'total_pet' => $total_pet,
            'store' => $store,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'pet' => $pet,
            'boarding' => $boarding
        ]);
        // return view("users.boardingCartPayment",[
        //     'total_pet' => $total_pet,
        //     'boarding_id' => $boarding_id,
        //     'store' => $store,
        //     'quantity' => $quantity,
        //     'start_date' => $start_date,
        //     'end_date' => $end_date,
        //     'pet' => $pet,
        // ]);
    }
    public function reservationReceived(Request $request){

        return view("users.reservationReceived");
    }
    public function reservationPayment(Request $request){
        $data = new CartBoarding();
        $cart_id = Carbon::now()->toDateString(). "_" .Str::random(15);
        $data->cart_id = $cart_id;
        $data->user_id = $request->session()->get('user_id');
        $data->user_name = $request->get('name');
        $data->user_phone = $request->get('phone');
        $data->user_email = $request->get('email');
        $boarding = $request->get('boarding');
        $boarding_item = Boarding::where("name","=",$boarding)->get();
        $boarding_id = $boarding_item[0]->id;
        $data->boarding_id = $boarding_id;
        $price = $boarding_item[0]->price;
        $data->boarding_price = $price;
        $data->boarding_name = $boarding;
        $created_at = Carbon::now()->toDateString();
        $data->created_at = $created_at;
        $data->start_date = $request->get('start_date');
        $data->end_date = $request->get('end_date');
        $store = $request->get('store');
        $store_item = ShopAddress::where('address','=',$store)->get();
        $data->store_id = $store_item[0]->id;
        $data->store_add = $store;
        $pet = $request->get('pet');
        $pet_item = Pet::where('name','=',$pet)->get();
        $data->pet_id = $pet_item[0]->id;
        $data->pet_name = $pet;
        $data->status = "1";
        $quantity = $request->get('quantity');
        $total_price = $quantity * $price;
        $data->total_pet = $quantity;
        $data->total_price = $total_price;
        $data->save();
        return response()->json([
            'data' => $data
        ]);
    }

    public function boarding_details(Request $request,$id){
        $cart_id = $id;
        $array_boarding = CartBoarding::where("cart_id",'=',$cart_id)->get();
        $store_id = $array_boarding[0]->store_id;
        $store = ShopAddress::where('id','=',$store_id)->get();
        //dd($array_boarding);
        return view('users.detailsCartBoarding',[
            'array_boarding'=>$array_boarding,
            'store' => $store
        ]);
    }

    public function change_stt_processing(Request $request,$id){
        $boarding = CartBoarding::find($id);
        $status = $boarding->status;
        $change_stt = $request->get('status');
        $level = $request->session()->get('level');
        $msg = '';
        if($level < 3){
            if($status == 3||$status ==4){
                $msg = "You dont have permission for this action";
            }
            if($status == 1 || $status ==2){
                $boarding->status = $change_stt;
                $boarding->save();
                $msg = "Successfully change status for boarding order $boarding->cart_id";
            }
        }else{
            $boarding->status = $change_stt;
            $boarding->save();
            $msg = "Successfully change status for boarding order $boarding->cart_id";
        }
        return response()->json([
            'boarding' => $boarding,
            'change_stt' => $change_stt,
            'level' => $level,
            'msg' => $msg
        ]);
    }
    public function boarding_render (Request $request,$id){
        $boarding = CartBoarding::find($id);
        return response()->json(['data' => $boarding]);
    }
    // public function cancle_cart(Request $request,$id){
    //     return response()->json([

    //     ]);
    // }
}
