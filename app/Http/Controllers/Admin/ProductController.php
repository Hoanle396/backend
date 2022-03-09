<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        if (Session::get("admin_name")) {
            $product = Product::orderByDesc('product_id')->paginate(8);
            $product_ = view('admin.product')->with('product', $product);
            return view('admin_layout')->with('admin.product', $product_);
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Session::get("admin_name")) {
            $product = Product::orderByDesc('product_id')->paginate(5);
            $product_ = view('admin.addproduct')->with('product', $product);
            return view('admin_layout')->with('admin.addproduct', $product_);
        } else {
            return Redirect::to('/Admin');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $image = $request->file('product_image');
        $newimage = md5(time()) . "-product.".$image->getClientOriginalExtension();
        $image->move('./imageupload', $newimage);
        $data = [
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_image' => env('APP_HOST','http://127.0.0.1:8000').'/imageupload/' . $newimage,
            'product_price' => $request->product_price,
            'product_origin' => $request->product_origin,
            'product_manufacturer' => $request->product_manufacturer,
            'product_discount' => $request->product_discount
        ];
        Product::create($data);
        Session::put('message', 'Đã Thêm Sản Phẩm');
        return Redirect::to('/Admin/product/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Session::get("admin_name")) {
            $product = Product::where('product_id', $id)->get()->first();
            $product_ = view('admin.updateproduct')->with('product', $product);
            return view('admin_layout')->with('admin.updateproduct', $product_);
        } else {
            return Redirect::to('/Admin');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = [
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'product_price' => $request->product_price,
                'product_origin' => $request->product_origin,
                'product_manufacturer' => $request->product_manufacturer,
                'product_discount' => $request->product_discount
            ];
            $result = Product::where('product_id', $request->product_id)->update($data);
            if ($result) {
                Session::put('message', 'Đã Sửa Sản Phẩm');
                return Redirect::back();
            } else {
                Session::put('message', 'Đã Xảy Ra Lỗi');
                return Redirect::back();
            }
        } catch (Exception $e) {
            abort(404);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Session::get("admin_name")) {
            $product = product::where('product_id', $id)->delete();
            if ($product) {
                Session::put('message', 'Đã xóa sản phẩm');
                return Redirect::back();
            } else {
                Session::put('message', 'Xảy ra lỗi');
                return Redirect::back();
            }
        } else {
            return Redirect::to('/');
        }
    }
}
