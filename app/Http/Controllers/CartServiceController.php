<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Users;
use Illuminate\Support\Str;
use App\Models\Pet;
use App\Models\CartServices;
use Carbon\Carbon;
use League\Glide\Server;

class CartServiceController extends Controller
{
    public function cart_service(){
        $array_service = Services::orderBy('id', 'ASC')->get();
        $array_users = Users::where("level","=",0)->get();
        $array_pet = Pet::all();
        $array_cart = CartServices::orderBy('created_at', 'desc')->get();
        return view('admin.cart_service',[
            'array_service' => $array_service,
            'array_users' => $array_users,
            'pet' => $array_pet,
            'array_cart' => $array_cart
        ]);
    }
    public function cart_service_add(Request $request){
        $this->validate($request,[
            'id' => 'exists:users',
            'user_phone' => ['regex:/((^(\+84|84|0){1})(1|3|5|7|8|9))+([0-9]{8,9})$/']
        ],[
            'id.exists' => '*users is not exists',
            'user_phone.regex' => '*Phone number is invalid',
        ]);

        $cart_id = Carbon::now()->toDateString(). "_" .Str::random(15);
        $user_id = $request->get('id');
        $created_at = Carbon::now()->toDateString();
        $services = $request->input('service_id');
        for($i = 0; $i < count($services); $i++){
            $cart_service = new CartServices;
            $cart_service -> cart_id = $cart_id;
            $cart_service -> user_id = $user_id;
            $cart_service -> user_name = $request->get('user_name');
            $cart_service -> user_phone = $request->get('user_phone');
            $cart_service -> user_email = $request->get('user_email');
            $serv = Services::where("id",'=',$services[$i])->get();
            $cart_service -> service_id = $services[$i];
            $cart_service -> service_name = $serv[0]->name;
            $cart_service -> service_price = $serv[0]->price;
            $cart_service -> pet_id = $request->get('pet_id');
            $cart_service -> total_pet = $request->get('total_pet');
            $cart_service -> created_at = $created_at;
            $cart_service -> save();
        }
        return redirect()->route('admin.cart_service')->with('msg','Create cart service successfully');
    }

    public function checking_price(Request $request){
        $service_id = $request->input('service_id');
        $quantity = $request->get('quantity');
        $total = 0;
        for($i = 0; $i < count($service_id); $i++){
            $serv = Services::where("id",'=',$service_id[$i])->get();
            $total = $total + $serv[0]->price;
        }
        $total = $total*$quantity;
        return response()->json(['total_price'=>$total]);
    }
    public function update_cart_serv(Request $request,$id){
        $services = $request->input('service_id');
        $cart_id = $id;
        $user_id = $request->get('id');

        $array_cart = CartServices::where("cart_id",'=',$cart_id)->get();
        $created_at = $array_cart[0]->created_at;
        CartServices::where("cart_id",'=',$cart_id)->delete();
        for($i = 0; $i < count($services); $i++){
            $cart_service = new CartServices;
            $cart_service -> cart_id = $cart_id;
            $cart_service -> user_id = $user_id;
            $cart_service -> user_name = $request->get('user_name');
            $cart_service -> user_phone = $request->get('user_phone');
            $cart_service -> user_email = $request->get('user_email');
            $serv = Services::where("id",'=',$services[$i])->get();
            $cart_service -> service_id = $services[$i];
            $cart_service -> service_name = $serv[0]->name;
            $cart_service -> service_price = $serv[0]->price;
            $cart_service -> pet_id = $request->get('pet_id');
            $cart_service -> total_pet = $request->get('total_pet');
            $cart_service -> created_at = $created_at;
            $cart_service -> save();
        }
        return redirect()->route('admin.cart_service')->with('msg','Update cart service successfully');
    }

}
