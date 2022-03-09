<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedBack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback = FeedBack::paginate(8);
        $feedbacks= view('feedback.index')->with('feedback',$feedback);
        return view('admin_layout')->with('feedback.index',$feedbacks);
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
        $feedback= new FeedBack();
        $feedback->fill($request->all());
        $feedback->save();
        return response()->json(['message'=>'Đã Phản Hồi Thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        if(Session::get("admin_name")) {

            $feedback= FeedBack::where('id', $id)->get()->first();
            if($feedback){
                $result = FeedBack::where('id', $id)->delete();
                if ($result) {
                    Session::put('message', 'Đã xóa ');
                    return Redirect::back();
                } else {
                    Session::put('message', 'Xảy ra lỗi');
                    return Redirect::back();
                }
            }
            abort(404);

        } else {
            return Redirect::to('/');
        }
    }
}
