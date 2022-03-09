<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get("admin_name")) {
            $order = Order::where('status', 'Chờ Xử Lý')->orwhere('status','Đã thanh toán')->orderByDesc('id')->paginate(8);
            $allorder = Order::orderByDesc('id')->paginate(8);
            $order_ = view('admin.order')->with('order', $order)->with('all', $allorder);
            return view('admin_layout')->with('admin.order', $order_);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Session::get("admin_name")) {
            $order = OrderDetail::where('order_code', $id)->select('product_id', 'product_name', 'product_quantity')->orderByDesc('id')->get();
            $user = OrderDetail::where('order_code', $id)->select('order_code', 'user_fullname', 'user_email', 'user_phonenumber', 'user_address', 'order_status', 'order_pay')->orderByDesc('id')->get()->first();
            if($order && $user){
                $order_ = view('admin.orderdetail')->with('order', $order)->with('user', $user);
                return view('admin_layout')->with('admin.orderdetail', $order_);
            }
            else{
                abort(404);
            }
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if (Session::get("admin_name")) {
            if ($request->save) {
                OrderDetail::where('order_code', $request->code)->update(['order_status' => $request->status]);
                Order::where('code', $request->code)->update(['status' => $request->status]);
                $order =OrderDetail::where('order_code', $request->code)->select('product_name', 'product_quantity')->get();

                $data=[
                    'order'=>$order,
                    'status'=>$request->status,
                    'code'=> $request->code,
                    'reson'=>'Gửi từ hệ thống'
                ];
                Mail::to($request->email)->queue(new OrderShipped($data,'Đơn Hàng Của Bạn','order'));
                Session::put('message', 'Đã cập nhật trạng thái đơn hàng');
                return Redirect::back();
            } else if ($request->huy) {
                OrderDetail::where('order_code', $request->code)->update(['order_status' => 'Đơn Hàng Bị Hủy']);
                Order::where('code', $request->code)->update(['status' => 'Đơn Hàng Bị Hủy']);
                $order = OrderDetail::where('order_code', $request->code)->select('product_name', 'product_quantity')->get();
                $data=[
                    'order'=>$order,
                    'status'=>'Đơn Hàng Bị Hủy',
                    'code'=> $request->code,
                    'reson'=>$request->description
                ];
                Mail::to($request->email)->queue(new OrderShipped($data,'Đơn Hàng Của Bạn','order'));
                Session::put('message', 'Đã hủy đơn hàng');
                return Redirect::back();
            } else {
                abort(404);
            }
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
