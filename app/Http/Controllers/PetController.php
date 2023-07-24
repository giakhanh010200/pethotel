<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
class PetController extends Controller
{
    public function pet(){
        $array_pet = Pet::get();
        return view('admin.pet',['array_pet' => $array_pet]);
    }
    public function pet_upload(Request $request){
        $data = $request->all();
        Pet::create($data);
        return redirect()->route('admin.pet')->with('msg','Upload data successfully!!!');
    }
    public function pet_update($id, Request $request, Pet $pet){
        $data = $pet->find($id);
        $data->update($request->all());
        return redirect()->route('admin.pet')->with('msg',"Update data at $id successfully!!!");
    }
    public function pet_delete($id){
        $data = Pet::destroy($id);
        return redirect()->route('admin.pet')->with('msg',"Delete data has id $id successfully!!!");
    }
}
