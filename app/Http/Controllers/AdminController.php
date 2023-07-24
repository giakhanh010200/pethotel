<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Todos;
use Carbon\Carbon;
use App\Models\Products;
use App\Models\CartServices;
use App\Models\Services;
use Carbon\CarbonPeriod;
use App\Models\Boarding;
use App\Models\ShopAddress;
use App\Models\CartBoarding;
use App\Models\Category;
use App\Models\Pet;
use App\Models\CartProduct;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function admin_login(){
        if(session()->has('admin_id')){
            return view('admin.dashboard');
        }else{
        return view('admin.admin_login');
        }
    }
    public function dashboard(){
        $total_use_boarding = CartBoarding::distinct("user_id")->count("user_id");
        $total_use_service = CartServices::distinct("user_id")->count("user_id");
        $cart_prd_success = CartProduct::where("status",6)->distinct("cart_id_render")->count("cart_id_render");
        $cart_prd_pending = CartProduct::where("status",2)->orWhere("status",3)->distinct("cart_id_render")->count("cart_id_render");
        $cart_prd_cancle = CartProduct::where("status",4)->orWhere("status",5)->orWhere("status",7)->distinct("cart_id_render")->count("cart_id_render");
        $cart_serv_count = CartServices::distinct("cart_id")->count("cart_id");
        $cart_board_pending = CartBoarding::where("status",1)->orWhere("status",2)->count("cart_id");
        $cart_board_success = CartBoarding::where("status",3)->count("cart_id");
        $cart_board_cancle = CartBoarding::where("status",4)->count("cart_id");
        // dd($cart_prd_pending);
        $cart_id = "";
        $count_serv = 0;
        $count_prd = 0;
        $count_board = 0;
        $price_serv = 0;
        $price_prd = 0;
        $price_board = 0;
        $price_all = 0;
        $array_service = CartServices::all();
        $array_boarding = CartBoarding::where("status",3)->get();
        $array_products = CartProduct::where("status",6)->get();
        foreach ($array_service as $arrsr){
            if($arrsr->cart_id != $cart_id){
                $count_serv = $count_serv + 1;
                $each_cart_price = 0;
                $cart_id = $arrsr->cart_id;
                foreach($array_service as $arrssr){
                    if($arrssr->cart_id == $cart_id){
                        $each_cart_price = $each_cart_price +  $arrssr->service_price;
                    }
                }
                $each_cart_price = $each_cart_price * $arrsr->total_pet;
                $price_serv = $price_serv + $each_cart_price;
            }
        }
        foreach($array_boarding as $arrbr){
            $count_board = $count_board + 1;
            $price_board = $price_board + $arrbr->total_price;
        }
        foreach ($array_products as $arrpr){
            if($arrpr->cart_id_render != $cart_id){
                $count_prd = $count_prd + 1;
                $cart_id = $arrpr->cart_id_render;
            }
            $price_prd = $price_prd + $arrpr->total_prices;
        }
        $price_all = $price_prd + $price_board + $price_serv;
        $array_cart_product = CartProduct::where("status",6)->orWhere("status",2)->orWhere("status",3)->get();
        $array_products = Products::all();
        $expense_price = 0;
        foreach($array_products as $arrps){
            $total_quantity = $arrps->quantity;
            foreach($array_cart_product as $arrcp){
                if($arrcp->product_id == $arrps->id){
                    $total_quantity = $total_quantity + $arrcp->quantity;
                }
            }
            $expense_price = $expense_price + ($total_quantity * $arrps->import_price);
        }
        //dd($array_service);
        // foreach($array_boarding as $arrb){
        //     $total_use_boarding = $total_use_boarding + $arrb->total_pet;
        // }
        return view('admin.dashboard',[
            'total_use_boarding' => $total_use_boarding,
            'total_use_service' => $total_use_service,
            'total_earn' => $price_all,
            'expense_price' => $expense_price,
            'cart_prd_success' => $cart_prd_success,
            'cart_prd_pending' => $cart_prd_pending,
            'cart_prd_cancle'=> $cart_prd_cancle,
            'cart_serv_count' => $cart_serv_count,
            'cart_board_pending' => $cart_board_pending,
            'cart_board_success'=> $cart_board_success,
            'cart_board_cancle'=> $cart_board_cancle,
        ]);

    }
    public function admin_control(Request $request){
        $search = $request->get('search');
        $today = Carbon::now()->toDateString();
        $level = $request->session()->get("level");
        $id = $request->session()->get("admin_id");
        $admin = Users::where("id", "=", $id)->get();
        $arr_admin = Users::where("level","<",$level)->where("level",">",0)->where("username","like","%$search%")->paginate(5);
        //dd($arr_admin);
        $todos_post = Todos::where("admin_up","=",$id)->where('admin_do','!=',$id)->orderBy("end_time",'asc')->get();
        $todos_do = Todos::where("admin_do","=",$id)->orderBy("end_time",'asc')->get();
        // dd($todos_do);
        return view('admin.admin_control',[
            'admin'=>$admin,
            'arr_admin'=>$arr_admin,
            'todos_do'=>$todos_do,
            'todos_post'=>$todos_post,
            'today'=>$today
        ]);
    }
    public function chart(Request $request){
        $from = $request->get("from");
        $to = $request->get("to");
        // xử lý dữ liệu theo từ ngày đến ngày
        $now = Carbon::now()->toDateString();
        if($from == null){
            $from = $now;
        }
        if($to == null){
            $to = $now;
        }
        $period = CarbonPeriod::create($from, $to);
        $array_count_serv = array();
        $array_count_prd = array();
        $array_count_board = array();
        $array_price_serv = array();
        $array_price_prd = array();
        $array_price_board = array();
        $array_price_all = array();
        $array_count_all = array();
        $all_of_price_date = 0;
        $all_of_count_date = 0;
        $array_date = array();
        foreach ($period as $date) {
            array_push($array_date, $date->format('d/m/Y'));
            $cart_id = "";
            $count_serv = 0;
            $count_prd = 0;
            $count_board = 0;
            $price_serv = 0;
            $price_prd = 0;
            $price_board = 0;
            $count_all = 0;
            $price_all = 0;
            $array_service = CartServices::where("created_at",$date)->get();
            $array_boarding = CartBoarding::where("end_date",$date)->where("status",3)->get();
            $array_products = CartProduct::where("payment_at",$date)->where("status",6)->get();
            foreach ($array_service as $arrsr){
                if($arrsr->cart_id != $cart_id){
                    $count_serv = $count_serv + 1;
                    $each_cart_price = 0;
                    $cart_id = $arrsr->cart_id;
                    foreach($array_service as $arrssr){
                        if($arrssr->cart_id == $cart_id){
                            $each_cart_price = $each_cart_price +  $arrssr->service_price;
                        }
                    }
                    $each_cart_price = $each_cart_price * $arrsr->total_pet;
                    $price_serv = $price_serv + $each_cart_price;
                }
            }
            foreach($array_boarding as $arrbr){
                $count_board = $count_board + 1;
                $price_board = $price_board + $arrbr->total_price;
            }
            foreach ($array_products as $arrpr){
                if($arrpr->cart_id_render != $cart_id){
                    $count_prd = $count_prd + 1;
                    $cart_id = $arrpr->cart_id_render;
                }
                $price_prd = $price_prd + $arrpr->total_prices;
            }
            $count_all = $count_prd + $count_serv + $count_board;
            $price_all = $price_prd + $price_board + $price_serv;
            $all_of_price_date = $all_of_price_date + $price_all;
            $all_of_count_date = $all_of_count_date + $count_all;
            array_push($array_price_all,$price_all);
            array_push($array_count_all,$count_all);
            array_push($array_count_prd,$count_prd);
            array_push($array_price_prd,$price_prd);
            array_push($array_price_board,$price_board);
            array_push($array_count_board,$count_board);
            array_push($array_price_serv,$price_serv);
            array_push($array_count_serv,$count_serv);
        }
        //dd($array_price_serv,$array_count_serv);
        $array_cart_service = CartServices::all();
        $array_cart_board = CartBoarding::all();
        $boarding = Boarding::all();
        // whereRaw('extract(month from created_at) = ?', ['7'])
        //thống kê status cart sản phẩm
        $array_cart_prd_status = CartProduct::all();
        // dd($array_cartprd);
        $products = Products::all();
        $service = Services::all();
        $array_product_sort = array();
        // top sản phẩm bán chạy

        foreach ($products as $prds){
            $count = 0;
            foreach($array_cart_prd_status as $arrcprd){
                if($prds->id == $arrcprd->product_id){
                    $count = $count + $arrcprd->quantity;

                }
            }
            array_push($array_product_sort,[
                "count"=> $count,
                'product'=> $prds->name,
                'import_price'=> $prds->import_price,
                'sale_price'=> $prds->sale_price,
                'quantity'=> $prds->quantity
            ]);
        }
        sort($array_product_sort);
        $array_product_sort = array_reverse($array_product_sort);
        $array_product_sort = array_slice($array_product_sort, 0, 10);
        //top người dùng chi tiêu nhiều
        $user = Users::where('level',0)->get();
        $array_users_top_sort = array();
        $array_cart_prd_user = CartProduct::where("status",6)->get();
        $array_cart_board_user = CartBoarding::where("status",3)->get();
        $array_cart_serv_user = CartServices::all();
        foreach ($user as $user){
            $total = 0;
            $total_prd = 0;
            $total_board = 0;
            $total_serv = 0;
            $cart_id = "";
            foreach($array_cart_prd_user as $arrcpus){
                if($user->id == $arrcpus->user_id){
                    $total_prd = $total_prd + $arrcpus->total_prices;
                }
            }
            foreach($array_cart_board_user as $arrcbus){
                if($user->id == $arrcbus->user_id){
                    $total_board = $total_board + $arrcbus->total_price;
                }
            }
            foreach($array_cart_serv_user as $arrcsus){
                if($user->id == $arrcsus->user_id){
                    $total_serv = $total_serv + $arrcsus->service_price * $arrcsus->total_pet;
                }
            }
            $total  = $total_prd + $total_board + $total_serv;
            array_push($array_users_top_sort,[
                'total' => $total,
                'username' => $user->username,
                'usermail' => $user->email,
                'total_prd'=> $total_prd,
                'total_board'=> $total_board,
                'total_serv'=> $total_serv,
            ]);
        }
        sort($array_users_top_sort);
        $array_users_top_sort = array_reverse($array_users_top_sort);
        $array_users_top_sort = array_slice($array_users_top_sort, 0, 10);
        //dd($array_product_sort[0]["count"]);


        return view('admin.chart',[
            'array_date' => $array_date,
            'array_price_serv' => $array_price_serv,
            'array_count_serv' => $array_count_serv,
            'array_count_prd'  => $array_count_prd,
            'array_count_board'=> $array_count_board,
            'array_price_prd' => $array_price_prd,
            'array_price_board'=>$array_price_board,
            'array_price_all'=> $array_price_all,
            'array_count_all'=>$array_count_all,
            'all_of_count_date'=>$all_of_count_date,
            'all_of_price_date'=>$all_of_price_date,
            'array_cart_prd_status'=>$array_cart_prd_status,
            'service' => $service,
            'products' => $products,
            'array_cart_service'=>$array_cart_service,
            'array_cart_board'=>$array_cart_board,
            'boarding'=> $boarding,
            'array_product_sort'=>$array_product_sort,
            'array_users_top_sort'=>$array_users_top_sort
        ]);
    }
    public function admin_process_login(Request $rq){
        $name=$rq->get('name');
        $password=$rq->get('password');
        $admin = new Users();
        $admin->name=$name;
        $admin->email = $name;
        $admin->password = $password;
        $admin = $admin->check_login();
        $admin_level = Users::where('username','=',$name)
        ->orWhere('email','=',$name)
        ->where('password','=',$password);
        if(empty($admin)){
            $msg = "Your username\email or password is not correct";
            return redirect()->back()->with('msg',$msg);
        }elseif($admin[0]->level == 0){
            $msg = "You are not an admin !!!";
            return redirect()->back()->with('msg',$msg);
        }else{
            $rq->session()->put('user_id',$admin[0]->id);
            $rq->session()->put('admin_id',$admin[0]->id);
            $rq->session()->put('name',$admin[0]->username);
            $rq->session()->put('email',$admin[0]->email);
            $rq->session()->put('level',$admin[0]->level);
            return redirect()->route('admin.dashboard');
        }
    }

    public function logout(Request $request){
        Session::flush();
        return redirect()->route('admin/admin_login');
    }

    public function create_new_admin(Request $request){
        $level = $request->session()->get('level');
        $this->validate($request,[
            'username'=>'required|min:6|unique:users',
            'email'=>'required|unique:users|email',
            'password'=>'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,20}$/',
            'password_confirm'=>'required|same:password',
            'level'=>'required|integer|digits_between:1,'.$level.''
        ],[
            'level.required' => '*Level field is required',
            'level.required' => '*Level field must be numberic',
            'level.digits_between' =>'*Level must less than your level and grater than 0',
            'username.required' => '*Username field is required',
            'username.min' => '*Username must have at least 6 characters',
            'username.unique'=>'*This username already exists',
            'email.unique'=>'*This email already exists',
            'email.email' => '*Your email is invalid',
            'email.required' => '*Email field is required',
            'password.required' => '*Password field is required',
            'password.regex' => '*Password must between 6 to 20 characters which contain at least one number digit, one uppercase and one lowercase letter',
            'password_confirm.required' => '*Password Confirm field is required',
            'password_confirm.same' => '*Password Confirm field must be the same as the password',
        ]);
        $data = new Users;
        $data->username = $request->get('username');
        $data->password = $request->get('password');
        $data->email = $request->get('email');
        $data->level = $request->get('level');
        $data->save();
        return redirect()->route('admin.admin_control')->with('msg-success','Create new admin successfully');
    }
    public function admin_update_progress(Request $request,$id){
        $user = Users::find($id);
        $msg_e = "";
        $msg_n ="";
        $msg_l ="";
        // $this_user_level = $request->session->get('level');
        $username = $request->get('username');
        $level = $request->get('level');
        $email = $request->get('email');
        $array_user = Users::where('id','!=',$id)->get();
        $min_name = Str::length($username);
        $err = false;
        if($min_name < 6){
            $msg_n = "*Username must have at least 6 characters";
            $err = true;
        }else{
            foreach ($array_user as $arru){
                if ($arru->username == $username){
                    $msg_n = "*This username already exists";
                    $err = true;
                    break;
                }
            }
        }
        if($level == null){
            $msg_l = "*Level field is required";
            $err = true;
        }
        if($username == null){
            $msg_n = "*Username field is required";
            $err = true;
        }
        if($email == null){
            $msg_e = "*Email field is required";
            $err = true;
        }else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $msg_e = "*Your email is invalid";
                $err = true;
            }else{
                foreach ($array_user as $arru){
                    if ($arru->email == $email){
                        $msg_e = "*This email already exists";
                        $err = true;
                    }
                }
            }
        }
        if ($err == false){
            $user->level = $level;
            $user->username = $username;
            $user->email = $email;
            $user->save();
            $my_id = $request->session()->get("admin_id");
            if($my_id == $id){
                $request->session()->put('name',$user->username);
            $request->session()->put('email',$user->email);
            }
        }

        return response()->json([
            'msg_n' => $msg_n,
            'msg_e' => $msg_e,
            'msg_l' => $msg_l,
            'data' => $user,
            'err'=>$err
        ]);
    }

    public function admin_del_progress(Request $request, $id){
        $admin = Users::find($id)->delete();
        return response()->json([
            'data' => $admin
        ]);
    }
}
