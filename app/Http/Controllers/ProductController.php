<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Models\Pet;
use Illuminate\Support\Facades\File;
use App\Models\Wishlist;

class ProductController extends Controller
{
    public function product(Request $request){
        $search = $request->get('search');
        if ($search != null){
            $array_products = Products::orderBy("id","desc")
            ->where("products.name","like","%$search%")->paginate(10);
            $array_pet = Pet::get();
            $array_category = Category::get();
            return view('admin.product',['array_products'=>$array_products, 'array_pet'=>$array_pet, 'array_category'=>$array_category]);
        }else{
            $array_products = Products::orderBy("id","desc")
            ->paginate(10);
            $array_pet = Pet::get();
            $array_category = Category::get();
            return view('admin.product',['array_products'=>$array_products, 'array_pet'=>$array_pet, 'array_category'=>$array_category]);
        }
    }


    public function product_upload(Request $request){
        $fileExtension = $request->file('thumbnail')->getClientOriginalExtension();
        $fileName = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
        $uploadPath = public_path('/image/product');
        $request->file('thumbnail')->move($uploadPath, $fileName);
        $data = $request->all();
        $data['thumbnail'] = $fileName;
        Products::create($data);
        return redirect()->route('admin.product')->with('msg',"Upload new data successfully !!!");
    }


    public function product_update($id, Request $request, Products $products){
        $data = $products::find($id);
        $existPath = public_path("/image/product/{$data->thumbnail}");
        $fileName = $data->thumbnail;
        if ($request->file('thumbnail') != null) {
            File::delete($existPath);
            $fileExtension = $request->file('thumbnail')->getClientOriginalExtension();
            $fileName = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;
            $uploadPath = public_path('/image/product');
            $request->file('thumbnail')->move($uploadPath, $fileName);
        }
        $data->name = $request->name;
        $data->serial = $request->serial;
        $data->manufacturer = $request->manufacturer;
        $data->description = $request->description;
        $data->sale_price = $request->sale_price;
        $data->import_price = $request->import_price;
        $data->quantity = $request->quantity;
        $data->category_id = $request->category_id;
        $data->pet_id = $request->pet_id;
        $data['thumbnail'] = $fileName;
        $data->save();
        return redirect()->back()->with('msg',"Update at product $id successfully !!!");

    }

    public function delete_product($id, Request $request){
        $data = Products::find($id);
        $count = $data->quantity;
        if($count != 0){
            return redirect()->back()->with('error',"This product is in stock !!!");
        }else{
            $uploadPath = public_path("image/product/{$data->thumbnail}");
            File::delete($uploadPath);
            $data->delete();
            return redirect()->back()->with('msg',"Product $id has deleted successfully !!!");
        }
    }

    public function image_product_upload(Request $request){
        $uploadPath = 'storage/product';
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = ($fileName) . '_' . time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $extension;
            $request->file('upload')->move(public_path($uploadPath), $fileName);
            $url = asset($uploadPath . '/' . $fileName);
         }
        return response()->json([
            'url' => $url
        ]);
    }

    public function view_one_product($name, Request $request){
        $wishlist = new Wishlist;
        $user_id = $request->session()->get('user_id');
        $wishlist = $wishlist->where('user_id','=',$user_id)->get();
        $product_data = new Products;
        $product_data = $product_data::where('name','=',$name)->get();
        $category_id = $product_data[0]->category_id;
        $pet_id = $product_data[0]->pet_id;
        $prd_id = $product_data[0]->id;
        $wishlist_prd_one = new Wishlist;
        $wishlist_prd_one = $wishlist_prd_one->where('user_id','=',$user_id)->where('product_id','=',$prd_id)->get();
        $check = count($wishlist_prd_one);
        $category_data = Category::where('id','=',$category_id)->get();
        $pet_data = Pet::where('id','=',$pet_id)->get();
        $product_category = new Products;
        $product_category = $product_category->where('name','!=',$name)->orderby('id','DESC')->where('category_id','=',$category_id)->limit(4)->get();
        return view('singleProduct',[
            'product_data' => $product_data,
            'category_data' => $category_data,
            'product_category' => $product_category,
            'pet_data' => $pet_data,
            'wishlist'=> $wishlist,
            'check' => $check,
        ]);
    }
}
