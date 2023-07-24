<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopAddress;

class ShopAddressController extends Controller
{
    public function shop_address(Request $request){
        $search = $request->get('search');
        if ($search != '') {
            $array_address = ShopAddress::orderBy("id", "desc")->where("address", "like", "%$search%")->paginate(10);
            return view('admin.shop_address', [
                'array_address' => $array_address
            ]);
        } else {
            $array_address = ShopAddress::orderBy("id", "desc")->paginate(10);
            return view('admin.shop_address', [
                'array_address' => $array_address
            ]);
        }
    }


    public function shop_address_show(Request $request, $id){
        $array_address = ShopAddress::find($id);
        return response()->json([
            'data'=>$array_address,
        ],200);
    }
    public function shop_address_delete(Request $request, $id){
        ShopAddress::find($id)->delete();
        return response()->json([
            'data'=>'removed',
            'message'=>'Delete data successfully !!!',
        ],200);
    }

    public function shop_address_update(Request $request, $id){
        $array_address = ShopAddress::find($id)->update($request->all());
        return response()->json([
            'data'=>$array_address,
            'array_address'=>$request->all(),
        ],200);
    }

    public function shop_address_upload(Request $request){
        $shop_address = ShopAddress::create($request->all());
        return response()->json([
            'message' => 'Add new address successful !!!',
            'data' => $shop_address,
        ],200);
    }
}
