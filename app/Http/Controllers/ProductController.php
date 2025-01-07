<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Image;

class ProductController extends Controller
{
    public function store(Request $request)
    {
       $product = new Product();

         $product->name = $request->name;
        $product->description = $request->description;
        if($request->image !=""){
            $strpos = strpos($request->image, ';');
            $sub = substr($request->image, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->image)->resize(200, 200);
            $upload_path = public_path()."/upload/";
            $img->save($upload_path.$name);
            $product->image = $name;
        }else{
            $product->image = 'default.png';
        }
        $product->type = $request->type;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->save();
    }
}
