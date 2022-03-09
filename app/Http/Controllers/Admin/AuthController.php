<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get("admin_name")) {
            $auth = User::orderByDesc('id')->paginate(8);
            $authbaned = User::where('status', 'Khóa')->paginate(8);
            $auth_ = view('admin.auth')->with('auth', $auth)->with('baned', $authbaned);
            return view('admin_layout')->with('admin.auth', $auth_);
        } else {
            return Redirect::to('/Admin');
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
        if (Session::get("admin_name")) {
            $auth = User::where('id', $id)->get()->first();
            if ($auth) {
                if ($auth->status == 'khóa') {
                    User::where('id', $id)->update(['status' => 'Hoạt Động']);
                    Session::put("message", "Đã Mở Khóa Tài Khoản");
                    return Redirect::back();
                } else {
                    User::where('id', $id)->update(['status' => 'khóa']);
                    Session::put("message", "Đã Khóa Tài Khoản");
                    return Redirect::back();
                }
            } else {
                Session::put('message', 'Xảy ra lỗi');
                return Redirect::back();
            }
        } else {
            return Redirect::to('/');
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
        if (Session::get("admin_name")) {
            $auth = User::where('id', $id)->delete();
            if ($auth) {
                Session::put('message', 'Đã xóa Người Dùng');
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
