<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    public function index(){
        $products = Product::all();
        $data = [
            'status'=>200,
            'message'=> $products
        ];
        $data_er = [
            'status'=>404,
            'message'=> 'no records found'
        ];
        if($products->count()>0){
            return response()->json($data, 200);
        }else{
            return response()->json($data_er, 404);
        }
        
    }

    public function addProducts(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'description' => 'required|string|max:250',
            'price' => 'required|digits:5|max:50',
            'cost' => 'required|digits:5|max:40'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ],422);
        }else{
            $products = Product::create([
                'name'   => $request->name,
                'description' => $request->description,
                'price'  => $request->price,
                'cost'  => $request->cost
            ]);

            if($products){
                return response()->json([
                    'status' => 200,
                    'message' => 'product created successfully',
                ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong!',
                ],500);
            }

        }

    }

    public function get_A_product($id){

        $products = Product::find($id);
        if($products){
            if($products)
            {
                return response()->json([
                    'status' => 200,
                    'message' => $products,
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'No such student record!',
                ],404);
            }
        }

    }

    public function edit($id){
        $products = Product::find($id);
        if($products)
        {
            return response()->json([
                'status' => 200,
                'message' => $products,
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No such product record!',
            ],404);
        }
    }

    public function update_product(Request $request,int $id){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'description' => 'required|string|max:250',
            'price' => 'required|digits:5|max:50',
            'cost' => 'required|digits:5|max:40'
        ]);
    
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $products = Product::find($id);
    
            if($products){
    
                $products -> update([
                    'name'   => $request->name,
                    'description' => $request->description,
                    'price'  => $request->price,
                    'cost'  => $request->cost
                ]);
    
                return response()->json([
                    'status' => 200,
                    'message' => 'Student update successfully',
                ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => 'No such student found!',
                ],500);
            }
    
        }
     
    }

    public function destroy($id){

        $products = Product::find($id);
    
        if($products){
    
            $products->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Product deleted successfully!',
            ],200);
    
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No such product found!',
            ],404);
        }
    
    }


}
