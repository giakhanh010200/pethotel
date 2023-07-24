<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todos;
use Illuminate\Support\Str;
use App\Models\Users;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class TodoController extends Controller
{
    public function add_new_todo(Request $request){
        $todo = new Todos;
        $my_id = $request->session()->get('admin_id');
        $my_level = $request->session()->get('level');
        $msg_start = "";
        $msg_end = "";
        $msg_level="";
        $start_date = $request->get('start');
        $end_date = $request->get('finish');
        $now = Carbon::now()->toDateString();
        $admin_do = $request->get('admin_do');
        $admin = Users::where('id', $admin_do)->get();

        $error = false;
        if($start_date < $now){
            $error = true;
            $msg_start = "Start date must be today or future date";
        }
        if($end_date < $start_date){
            $error = true;
            $msg_end = "Finish date must be grater or equal start date";
        }
        if($admin[0]->level > $my_level){
            $error = true;
            $msg_level = "You can't assign a job to someone with a higher position";
        }
        if ($error == false){
            $todo->admin_up = $my_id;
            $todo->notes = $request->get('notes');
            $todo->check = 1;
            $todo->upload_time = Carbon::now()->toDateString();
            $todo->start_time = $start_date;
            $todo->end_time = $end_date;
            $todo->admin_do = $admin_do;
            $todo->save();
        }
        return response()->json([
            'msg_start'=>$msg_start,
            'msg_end'=>$msg_end,
            'msg_level'=>$msg_level,
            'error'=>$error,
            'todo' => $todo,
            'admin' => $admin
        ]);
    }
    public function render_todo(Request $request, $id){

        $data = Todos::find($id);
        $admin_do = Users::where('id', $data->admin_do)->get();
        return response()->json([
            'data'=>$data,
            'admin_do'=>$admin_do
        ]);
    }
    public function edit_todo(Request $request, $id){
        $data = Todos::find($id);
        $my_level = $request->session()->get('level');
        $msg_start = "";
        $msg_end = "";
        $msg_level="";
        $start_date = $request->get('start_time');
        $end_date = $request->get('end_time');
        $now = Carbon::now()->toDateString();
        $admin_do = $request->get('admin_do');
        $admin = Users::where('id', $admin_do)->get();

        $error = false;
        if($start_date < $now){
            $error = true;
            $msg_start = "Start date must be today or future date";
        }
        if($end_date < $start_date){
            $error = true;
            $msg_end = "Finish date must be grater or equal start date";
        }
        if($admin[0]->level > $my_level){
            $error = true;
            $msg_level = "You can't assign a job to someone with a higher position";
        }
        if($error == false){
            $data->update($request->all());
        }

        return response()->json([
            'data'=>$data,
            'msg_start'=>$msg_start,
            'msg_end'=>$msg_end,
            'msg_level'=>$msg_level,
            'error'=>$error,
        ]);
    }
    public function change_status_check(Request $request, $id){
        $data = Todos::find($id);
        $data->done_time = Carbon::now()->toDateString();
        $data->save();
        return response()->json([
            'data' => $data
        ]);
    }
    public function delete_todo(Request $request,$id){
        $data = Todos::find($id)->delete();
        return response()->json([]);
    }
}
