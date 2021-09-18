<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\Product;
use Validator;
// use Keygen;
class ProductController extends BaseController
{
    public function index(){
        $products =  Product::get();
        return $this->sendSuccess($products , 'Products Reads Succsuffly');
    }
    public function create(Request $res){
        $valid = Validator::make($res->all() , 
        [
            'name'=>'required|min:6|max:20',
            'description'=>'required|min:20',
            'code'=>'nullable',
            'price'=>'required|digits:2',
            'warehouse'=>'required|digits:2',
            'qty'=>'required|digits:2',
        ]);

        if($valid->fails()) return $this->sendErrors("Invaild Product data" , $valid->errors());
        $products = Product::create([
            'name'=>$res->name,
            'description'=>$res->description,
            'code'=>$res->code,
            'price'=>$res->price,
            'warehouse'=>$res->warehouse,
            'qty'=>$res->qty,
            'avilable'=>true,
            // 'code'=>Keygen::numeric(8)->generate(),
        ]);
        if($products) return $this->sendSuccess($products , 'Product Created Succefully');
        else return $this->sendErrors("Invaild Product data");
    }   
    public function edit(int $id , Request $res){
        $product = Product::findOrFail($id);

        if(!$product){
            return $this->sendErrors("Invaild Product ID");
        }else{  
            $valid = Validator::make($res->all() , 
            [
            'name'=>'required|min:6|max:20',
            'description'=>'required|min:20',
            'code'=>'nullable',
            'price'=>'required|digits:2',
            'warehouse'=>'required|digits:2',
            'qty'=>'required|digits:2',
            ]);

            if($valid->fails()) return $this->sendErrors("Invaild Product data" , $valid->errors());
            $products = Product::where('id' ,$id)->update([
                'name'=>$res->name,
                'description'=>$res->description,
                'code'=>$res->code,
                'price'=>$res->price,
                'warehouse'=>$res->warehouse,
                'qty'=>$res->qty,
                'avilable'=>true,
            // 'code'=>Keygen::numeric(8)->generate(),
            ]);
            if($products) return $this->sendSuccess($product , 'Product Updated Succefully');
            else return $this->sendErrors("Invaild Product data");

        }

        //return  response()->json($product);
    }
    public function delete(int $id,Request $res){
        $product = Product::findOrFail($id);

        if(!$product){
            return $this->sendErrors("Invaild Product ID");
        }else{ 
            $products = Product::where('id' ,$id)->delete();
            if($products) return $this->sendSuccess($products , 'Product Deleted Succefully');
            else return $this->sendErrors("Invaild Product data");

        }

    }
    
}
