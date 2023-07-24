<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\UsersAddress;
use App\Models\CartProduct;
use App\Models\CartServices;
use App\Models\PassToken;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\CartBoarding;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function users(Request $request){
        $search = $request->get('search');
        $cart_prd = CartProduct::where("status","=",6)->get();
        $cart_board = CartBoarding::where("status","=",3)->get();
        $cart_service = CartServices::all();
        $users = Users::where("username","like","%$search%")->where("level","=",0)->orderBy("id", "DESC")->get();
        $user_add = UsersAddress::all();
        return view('admin.users',[
            'users' => $users,
            'user_add' => $user_add,
            'cart_prd'=> $cart_prd,
            'cart_board' => $cart_board,
            'cart_service' => $cart_service,
        ]);
    }
    public function user_info(){
        $id = Session::get('user_id');
        $array_boarding = CartBoarding::where('user_id','=',$id)->orderBy("id","desc")->get();
        $array_user = Users::where('id','=', $id)->get();
        $array_add = UsersAddress::where('user_id','=', $id)->get();
        $array_cart = CartProduct::where('user_id','=',$id)->orderBy("id","desc")->where('status','!=',1)->get();
        //dd($array_user);
        return view('users.user_info',[
            'array_user' => $array_user,
            'array_add' => $array_add,
            'array_cart' => $array_cart,
            'array_board' => $array_boarding
        ]);

    }
    public function user_register(){
        if(session()->has('user_id')){
            return redirect()->route('users.user_info');
        }else{
        return view('users.user_register');
        }
    }
    public function user_reset_password(){
        if(session()->has('user_id')){
            return redirect()->route('users.user_info');
        }else{
        return view('users.user_reset_password');
        }
    }
    public function user_login(){
        if(session()->has('user_id')){
            return redirect()->route('users.user_info');
        }else{
        return view('users.user_login');
        }
    }
    public function user_process_login(Request $rq){
        $name=$rq->get('name');
        $password=$rq->get('password');
        $user = new Users();
        $user->name=$name;
        $user->email = $name;
        $user->password = $password;
        $user = $user->check_login();
        if(empty($user)){
            $msg = "Your username\email or password is not correct";
            return redirect()->back()->with('msg',$msg);
        }else{
            if($user[0]->level > 0 ){
                $rq->session()->put('admin_id',$user[0]->id);
            }
            $rq->session()->put('user_id',$user[0]->id);
            $rq->session()->put('name',$user[0]->username);
            $rq->session()->put('email',$user[0]->email);
            $rq->session()->put('level',$user[0]->level);
            return redirect()->route('users.user_info');
        }
    }
    public function logout(Request $request){
        Session::flush();
        return redirect()->back();
    }
    public function user_process_register(Request $request){
        //$name = $request->get('username');
        // $email = $request->get('email');
        // $password = $request->get('password');
        $this->validate($request,[
            'username'=>'required|min:6|unique:users',
            'email'=>'required|unique:users|email',
            'password'=>'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,20}$/',
            'password_confirm'=>'required|same:password'
        ],[
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
        $data->email = $request->get('email');
        $data->password = $request->password;
        $data->level = 0;
        $data->save();
        return redirect()->route('users.user_info');
    }

    public function forgot_password_reset(Request $request){
        $this->validate($request,[
            'email'=>'required|email|exists:users',
        ],[
            'email.exists' => 'Your email is not exists',
        ]);
        $token = Str::random(64);

        DB::table('pass_token')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);
        Mail::send('email.forgotPassword',['token'=>$token],function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset password');
        });
        return redirect()->back()->with('msg','We have e-mailed your password reset link !!! Check your mail');
    }
    public function user_mail_reset_password($token, Request $request){
        return view('users.user_mail_reset_password',['token'=>$token]);
    }
    public function user_submit_reset_password(Request $request){
        $this->validate($request,[
            'email'=>'required|exists:users|email',
            'password'=>'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,20}$/',
            'password_confirm'=>'required|same:password'
        ]);
        $updatePass = DB::table('pass_token')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();
        if (!$updatePass){
            return redirect()->back()->with('error','Invalid token !!!');
        }else{
            $user = Users::where('email', $request->email)
                      ->update(['password' => $request->password    ]);
            DB::table('pass_token')->where(['email'=> $request->email])->delete();
            return redirect()->route('users.user_login')->with('msgs','Your password has been updated successfully');
        }
    }

    public function user_address_add(Request $request){
        $user_address = UsersAddress::create($request->all());
        return response()->json([
            'message' => 'Add new address successfully !!!',
            'data' => $user_address,
        ],200);
    }
    public function user_address_show(Request $request, $id){
        $user_address = UsersAddress::find($id);
        return response()->json([
            'data' => $user_address,

        ]);
    }
    public function user_address_update(Request $request, $id){
        $user_address = UsersAddress::find($id)->update($request->all());
        return response()->json([
            'data'=>$user_address,
            'user_address'=>$request->all(),
            'message'=>'Address update successfully !!!',
        ],200);
    }

    public function user_address_del(Request $request, $id){
        UsersAddress::find($id)->delete();
        return response()->json([
            'data'=>'removed',
            'message'=>'Delete data successfully !!!',
        ],200);
    }

    public function change_account_prof(Request $request, $id){
        // $this->validate($request,[
        //     'username'=>'required|min:6|unique:users',
        //     'email'=>'required|unique:users|email',
        // ],[
        //     'username.required' => '*Username field is required',
        //     'username.min' => '*Username must have at least 6 characters',
        //     'username.unique'=>'*This username already exists',
        //     'email.unique'=>'*This email already exists',
        //     'email.email' => '*Your email is invalid',
        //     'email.required' => '*Email field is required',
        // ]);
        $user = Users::find($id);
        $msg_e = "";
        $msg_n ="";
        $username = $request->get('username');
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
            $user->username = $username;
            $user->email = $email;
            $user->save();
            $my_id = $request->session()->get("user_id");
            if($my_id == $id){
                $request->session()->put('name',$user->username);
            $request->session()->put('email',$user->email);
            }
        }

        return response()->json([
            'data' => $user,
            'msg_n' => $msg_n,
            'msg_e'=> $msg_e,
        ]);
    }

    public function change_new_password(Request $request, $id){
        $users = Users::find($id);
        $default = $users->password;
        $msg_o ="";
        $msg_n ="";
        $msg_c ="";
        $old_password = $request->get('old_password');
        $err = false;
        if(!($old_password == $default)){
            $msg_o = "you entered the wrong old password";
            $err = true;
        }
        $new_password = $request->get('new_password');
        $confirm_password = $request->get('confirm_password');
        $parttern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,20}$/";
        $check = preg_match($parttern,$new_password);
        if($check == 0){
            $err = true;
            $msg_n = "Password must between 6 to 20 characters which contain at least one number digit, one uppercase and one lowercase letter";
        }
        if($confirm_password != $new_password){
            $err = true;
            $msg_c = "Password confirm field must be the same as the new password";
        }
        if($err == false){
            $users->password = $new_password;
            $users->save();
        }
        return response()->json([
            'data' => $check,
            'msg_o' => $msg_o,
            'msg_n' => $msg_n,
            'msg_c'=> $msg_c,
            'err' => $err
        ]);
    }
}
