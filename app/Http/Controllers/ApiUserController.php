<?php

namespace App\Http\Controllers;

use App\Http\Requests\APIAccountRequest;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserChangeRequest;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class ApiUserController extends Controller
{
    public function register(APIAccountRequest $request){
        $user= new User();
        $user->fill($request->all());
        $user->password= Hash::make($request->password);
        $user->save();
        return response()->json($user);
    }
    public function login(ApiLoginRequest $request){
       if (Auth::attempt([
           'email'=>$request->email,
           'password'=>$request->password,
           'status'=>'Hoạt Động'
       ])){
           $user=User::where('email',$request->email)->first();
           $user->token=$user->createToken('App')->accessToken;
           return response()->json($user);
       }
       else if(Auth::attempt([
           'email'=>$request->email,
           'password'=>$request->password,
           'status'=>'Khóa'
       ])){
           return response()->json(['message'=>'tài khoản đã bị khóa bởi quản trị viên'],422);
       }
      return response()->json(['message'=>'tài khoản hoặc mật khẩu không đúng'],422);
    }
    public function userInfo(Request $request){
        return response()->json($request->user('api'));
    }
    public function changeAddress(UserChangeRequest $request){
        $user=[];
        $user['name']=$request->name;
        $user['address']=$request->address;
        $user['phonenumber']=$request->phonenumber;
        User::where('id',$request->id)->update($user);
        return response()->json($user);
    }
    public function changePassword(PasswordRequest $request){
        if($request->confirmpwd!=$request->newpwd){
            return response()->json(['message'=>'Mật Khẩu Mới Không Khớp'],401);
        }
        else  if (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->currentpwd,
        ])){
            $data=['password'=>Hash::make($request->newpwd)];
            $user=User::where('email',$request->email)->update($data);
            return response()->json(['message'=>'Đã Cập Nhật Mật Khẩu Mới'],200);
        }
        return response()->json(['message'=>'Mật Khẩu Cũ Không Đúng'],401);
    }
    public function show($email){
        $order=OrderDetail::where('user_email',$email)->get();
        return response()->json($order);
    }
}
