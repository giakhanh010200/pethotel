<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\CartServices;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    public function service(){
        $array_services = Services::orderBy('id', 'desc')->get();
        return view('admin.service',['array_services' => $array_services]);
    }
    public function service_upload(Request $request){
        $fileExtension = $request->file('image')->getClientOriginalExtension();
        $fileName = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
        $uploadPath = public_path('/image/service');
        $request->file('image')->move($uploadPath, $fileName);
        $data = $request->all();
        $data['image'] = $fileName;
        Services::create($data);
        return redirect()->route('admin.service')->with('msg',"Upload new data successfully !!!");
    }
    public function service_show(Request $request, $id){
        $array_services = Services::find($id);
        return response()->json([
            'data'=>$array_services,
        ],200);
    }
    public function service_delete(Request $request, $id, Services $services){
        $data = $services::find($id);
        $uploadPath = public_path("image/service/{$data->thumbnail}");
        File::delete($uploadPath);
        $data->delete();
        return redirect()->back()->with('msg',"Product $id has deleted successfully !!!");

    }
    public function service_update(Request $request, $id, Services $services){
        $data = $services::find($id);
        $existPath = public_path("/image/service/{$data->thumbnail}");
        $fileName = $data->image;
        if ($request->file('image') != null) {
            File::delete($existPath);
            $fileExtension = $request->file('image')->getClientOriginalExtension();
            $fileName = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
            $uploadPath = public_path('/image/service');
            $request->file('image')->move($uploadPath, $fileName);
        }
        $data->name = $request->name;
        $data->about = $request->about;
        $data->price = $request->price;
        $data['image'] = $fileName;
        $data->save();
        return redirect()->back()->with('msg',"Update at service $id successfully !!!");

    }
    public function service_one(Request $request,$id){
        $array_cart = CartServices::where("cart_id",'=',$id)->get();
        return view("admin.one_cart_serv",[
            'array_cart' => $array_cart,
        ]);
    }
}
