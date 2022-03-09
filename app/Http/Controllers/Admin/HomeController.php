<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Product;
use App\Models\Service;
use App\Models\FeedBack;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get("admin_name")){
            return Redirect::to('/Admin/dashboard');
        }else{
            return view('login_admin');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        if(Session::get("admin_name")){
            $order= OrderDetail::orderByDesc('id')->paginate(5);
            $thongke=[
                'totaluser'=>User::all()->count(),
                'totalorder'=>OrderDetail::all()->count(),
                'totalproduct'=>Product::all()->count(),
                'totalservice'=>Service::all()->count(),
                'totalfeedback'=>Feedback::all()->count()
            ];
            $feedback= Feedback::orderByDesc('id')->paginate(5);
            $order_= view('admin.index')->with('order',$order)->with('total',$thongke)->with('feedback',$feedback);
            return view('admin_layout')->with('admin.index',$order_);
        }else{
            return Redirect::to('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminLoginRequest $request)
    {
        if(Session::get("admin_name")){
            return Redirect::to('/Admin/dashboard');
        }else{
            $result= Admin::where('email',$request->email)->where('password',md5($request->password))->get()->first();
            if ($result){
                Session::put("admin_name",$result->name);
                return Redirect::to('/Admin/dashboard');
            }
            else{
                Session::put("message","Tài Khoản Hoặc Mật Khẩu Sai");
                return Redirect::back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
    public function logout(){
        if(!Session::get("admin_name")){
            return Redirect::to('/');
        }else{
                Session::put("admin_name",null);
                return Redirect::to('/');
        }
    }
}
