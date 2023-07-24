<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Wishlist;
use App\Models\Category;
use App\Models\Pet;

class WishlistController extends Controller
{
    public function addToWishList(Request $request, $id){
        $wishlist = new Wishlist;
        $user_id = $request->session()->get('user_id');
        $prd_id = (int)$id;
        $wishlist = $wishlist->where('user_id','=',$user_id)
                    ->where('product_id','=',$prd_id)->get();
        $check = count($wishlist);
        $log = 300;
        if ($check == 1){
            $log = 400;
            Wishlist::where('user_id','=',$user_id)
            ->where('product_id','=',$prd_id)->delete();
        }else{
            $log = 200;
            $data = new Wishlist();
            $data->user_id =$request->session()->get('user_id');
            $data->product_id = $prd_id;
            $data->save();
        }
        return response()->json([
            'log' => $log
        ]);

    }


    public function products_wishlist(Request $request){
        $user_id = $request->session()->get('user_id');
        $array_products = Products::all();
        $array_category = Category::all();
        $array_pet = Pet::all();
        $array_wishlist = Wishlist::orderBy('id','DESC')->where('user_id','=',$user_id)->get();
        return view('users.wishlist',[
            'array_wishlist' => $array_wishlist,
            'array_products' => $array_products,
            'array_pet' => $array_pet,
            'array_category' => $array_category,

        ]);
    }

    public function delete_product_wishlist($id, Request $request){
        $data = Wishlist::find($id)->delete();
        return response()->json([
            'msg'=>'delete data successfully',
            'data' => $data
        ]);
    }
}
