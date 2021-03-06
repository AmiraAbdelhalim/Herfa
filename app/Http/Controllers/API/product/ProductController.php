<?php

namespace App\Http\Controllers\API\product; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables ; 
use App\Product;
use App\User;
use App\Category;
use  App\Http\Controllers\API\BaseController ;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;



class ProductController extends Controller
{
    
    public function index()
    {
        // return ProductResource::collection(
        //     Product::all()
          //    Product::paginate(5)
        //  );


        // return Product::all();
          return ProductResource::collection(Product::paginate(3));
   

    }


//     function create () {
//         $users=User::all();
//         $categories=Category::all();
//         return view('products.create',[
//             'users' => $users,
//             'categories' => $categories,
//         ]);
//         }   

public function store(StoreProductRequest $request) {
    // return response()->json($request->all()); 
        // $request['user_id']= 1;
        // $request['category_id']=1;

        if($request->profile){
            $request['image']=Storage::disk('public')->put('images',$request->profile);
        } 

        // if($request->hasFile('image'))
        // {
            // $file = $request->file('image');
            // $extension = $file->getClientOriginalExtension();
            // $filename = time().'.'.$extension;
            // Storage::disk('public')->put('images/'.$filename, File::get($file));
            // }
            // $request->img=$filename; 
            ////////////////////////////////////////////////////////
            // $file = $request->file('image');
            // $filename = $file->getClientOriginalName();
            // $extension = $file->getClientOriginalExtension();
            // $picture = date('His').'-'.$filename;
            // $file->move(public_path('img'), $picture); }

        $product=Product::create($request->all());
        // return $product ;
        return $product;
      
    }     

public function show($id)
{
    return new ProductResource(
        Product::find($id)
    );

}

// public function edit()
// { 
//   $request=request();
//  $product_id=$request->product;
//  $product= Product::find($product_id); 
// return $product;
//  }


public function update(UpdateProductRequest $request, $id)
{
    $product= Product::where('id',$id)->first();
    if($product) {
        if(array_key_exists('profile',$request->all())){
            Storage::disk('public')->delete($product->image);
            $request['image']=Storage::disk('public')->put('images',$request['profile']);
        }

        $product->update($request->all());
        return $product->fresh();
}
return json_encode(array("ERROR"=>"PRODUCT $id NOT EXSIST"));
}
// return json_encode(array("ERROR"=>"NOT EXSIST"));
// return response()->json($course, 200);
    // else{
    //     $request['image']=$request->oldimg;
    // }
//  $product= Product::findOrFail($id); 
//   $product->update($request->all());
//    return $product->fresh();
// 

public function destroy($id)
   { 
   
    $product= Product::find($id); 
if(!$product){
    return json_encode(array("ERROR"=>"faild to delete this product"));
 }
 else{
    Storage::disk('public')->delete($product->image);
    $product->delete(); 
    return json_encode(array("msg"=>"this product deleted sussecfully"));
}
   
    }

}
