<?php

namespace App\Http\Controllers;
use App\Http\Requests\DoneRequest;
use App\Jobs\sendmail;
use App\Mail\OrderShipped;
use App\Models\Bank;
use Carbon\Carbon as time;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Exception;

class CheckoutController extends Controller
{
    public function store(CheckoutRequest $request){
        $code = substr(sha1(time()), 0, 8);
        try {
            $order = [
                'code' => $code,
                'date' => Time::now(),
                'pay' => $request->pay,
                'total' => $request->total,
                'status' => 'Chờ Xử Lý'
            ];
            Order::create($order);
            foreach ($request->products as $id => $details) {
                $count= DB::table('products')->where('product_id',$details['product_id'])->select('product_discount')->get()->first();
                if($count->product_discount>= $details['quantity']){
                $detail = new OrderDetail();
                $detail->order_code = $code;
                $detail->product_id = $details['product_id'];
                $detail->product_name = $details['product_name'];
                $detail->product_quantity = $details['quantity'];
                $detail->user_fullname = $request['user']['name'];
                $detail->user_email = $request['user']['email'];
                $detail->user_phonenumber = $request['user']['phonenumber'];
                $detail->user_address = $request['user']['address'];
                $detail->user_address2 = null;
                $detail->order_status = 'Chờ Xử lý';
                $detail->order_pay = $request->pay;
                $detail->save();
                $newcount =$count->product_discount-$details['quantity'];
                DB::table('products')->where('product_id',$details['product_id'])->update(['product_discount'=>$newcount]);
                }
                else{
                    return response()->json(['message'=>'Sản phẩm '.$details['product_name'].' đã hết hàng']);
                }
            }
            if ($request->pay == 'offline') {
                $orders = OrderDetail::where('order_code', $code)->select('product_name', 'product_quantity')->get();
                $data = [
                    'order' => $orders,
                    'status' => 'Chờ Xử lý',
                    'code' => $code,
                    'reson' => 'Gửi từ hệ thống'
                ];
                $send = New sendmail($request['user']['email'],new OrderShipped($data, 'Đơn Hàng Của Bạn', 'order'));
                dispatch($send);

//                Mail::to($request['user']['email'])->send(new OrderShipped($data, 'Đơn Hàng Của Bạn', 'order'));
                return response()->json(["message"=>"Đặt Hàng Thành Công Đơn Hàng Của Bạn Đang Được Xử Lý"]);
            } else if ($request->pay == 'online') {
                $respone=[
                    "message"=>"Đặt Hàng Thành Công Đang Chuyển Hướng",
                    "redirect"=>"online",
                    "total"=>$request->total,
                    "code"=>$code
                ];
                $total=$request->total;
                return response()->json($respone);
            }
        } catch (Exception $e) {
            return response()->json(['message'=>'Đã Xảy Ra Lỗi']);
        }
    }
    public function getBank(){
            $data=Bank::get()->first();
            return response()->json($data);
    }
    public function done(DoneRequest $request){
        OrderDetail::where('order_code', $request->code)->update(['order_status' => 'Đã thanh toán']);
        Order::where('code', $request->code)->update(['status' => 'Đã thanh toán']);
        $order = OrderDetail::where('order_code', $request->code)->select('product_name', 'product_quantity', 'user_email')->get();
        $data = [
            'order' => $order,
            'status' => 'Chờ Xử lý',
            'code' => $request->code,
            'reson' => 'Gửi từ hệ thống'
        ];
//        Mail::to($order[0]->user_email)->send(new OrderShipped($data, 'Đơn Hàng Của Bạn', 'order'));
        $send = New sendmail($order[0]->user_email,new OrderShipped($data, 'Đơn Hàng Của Bạn', 'order'));
        dispatch($send);
    }

}
