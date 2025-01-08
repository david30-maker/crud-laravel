<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::query();
        $products = $products->latest()->get();

        return response()->json(['products' => $products], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
    
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->type = $request->type;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
    
        if ($request->has('image') && $request->image != "") {
            // Handle image upload
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload'), $imageName);
            $product->image = $imageName;
        } else {
            $product->image = 'default.png';
        }
    
        $product->save();
    
        return response()->json([
            'message' => 'Product created successfully!',
            'product' => $product
        ], 201);
    }    
}
