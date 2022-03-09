<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{

    public function index()
    {
        $product = Product::paginate(8);
        return response()->json($product);
    }

    public function show($id)
    {
        $product = Product::where('product_id',$id)->get()->first();
        return response()->json($product);
    }

    public function search($search){
        $all_product = Product::where("product_name", "like", "%" . $search . "%")
            ->orWhere("product_price", "like", "%" . $search . "%")
            ->orWhere("product_description", "like", "%" . $search . "%")
            ->orWhere("product_origin", "like", "%" . $search . "%")
            ->orWhere("product_manufacturer", "like", "%" . $search . "%")
            ->paginate(8);
        return response()->json($all_product);
    }
    public function filters($value) {
        $products=Product::where("product_price",'<=',$value)->paginate(8);
        return response()->json($products);
    }
}
