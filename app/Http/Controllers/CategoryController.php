<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function category(){
        $array_cate = Category::orderBy("id", "desc")->get();
        return view('admin.category',['array_cate' => $array_cate]);
    }
    public function delete_category($id){
        $data = Category::destroy($id);
        return redirect()->route('admin.category')->with('msg', "Delete data has id $id successfully!!!");
    }
    public function category_upload(Request $request){
        $data = $request->all();
        Category::create($data);
        return redirect()->route('admin.category')->with('msg', 'Insert data success!!!');
    }
    public function category_update(Request $request, $id, Category $category){
        $data = $category::find($id);
        $data->name = $request->name;
        $data->description = $request->description;
        $data->save();
        return redirect()->route('admin.category')->with('msg', "Update data at $id successfully!!!");
    }
}
