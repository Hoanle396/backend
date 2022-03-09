<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Models\meet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Mail\OrderShipped;
use Exception;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get("admin_name")) {
            $service = Service::orderByDesc('id')->paginate(8);
            $service_ = view('admin.service')->with('service', $service);
            return view('admin_layout')->with('admin.service', $service_);
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service= new Service();
        $service->fill($request->all());
        $service->status="Chưa Xử Lý";
        $service->save();
        return response()->json(['message'=>'Đã Đăng Kí Thành công']);
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
            $service = Service::where('id', $id)->get()->first();
            $service_ = view('admin.updateservice')->with('service', $service);
            return view('admin_layout')->with('admin.updateservice', $service_);
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
            if (Session::get("admin_name")) {
                $data = [
                    'id' => $id,
                    'service_fullname' => $request->fullname,
                    'service_email' => $request->email,
                    'time' => $request->time,
                    'date' => $request->date,
                    'description' => $request->description
                ];
                Mail::to($request->email)->later(now()->addMinutes(3),new OrderShipped($data, 'Tư Vấn Y Tế', 'join'));
                Service::where('id', $id)->update(['status' => 'Đã Lên Lịch']);
                meet::create($data);
                Session::put("message", "Đã Lên Lịch Hẹn");
                return Redirect::to('/Admin/service');
            } else {
                return Redirect::to('/');
            }
        } catch (Exception $e) {
            $e->getMessage();
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
        if(Session::get("admin_name")) {

        $join= meet::where('id', $id)->get()->first();
        if($join){
            $service = Service::where('id', $id)->delete();
            if ($service) {
                Session::put('message', 'Đã xóa ');
                return Redirect::back();
            } else {
                Session::put('message', 'Xảy ra lỗi');
                return Redirect::back();
            }
        }

    } else {
        return Redirect::to('/');
    }
    }
}
