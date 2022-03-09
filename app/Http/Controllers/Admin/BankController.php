<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get("admin_name")) {
            $auth = Bank::orderByDesc('id')->first();
            $bank = view('admin.bank')->with('bank', $auth);
            return view('admin_layout')->with('admin.auth', $bank);
        } else {
            return Redirect::to('/Admin');
        }return view('admin.bank');
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
        try {
            $request->validate([
                'image' => [
                    'required',
                    'mimes:jpeg,png,jpg',
                    'mimetypes:image/jpeg,image/png,image/jpg',
                    'max:1000000'
                ]
            ]);
            $image = $request->file('image');
            $newimage = time() . "-" . $request->name . "." . $image->getClientOriginalExtension();
            $image->move('./imageupload', $newimage);
            $data = [
                'bankname' => $request->name,
                'bankauth' => $request->description,
                'banknumber'=>$request->banknumber,
                'qrcode' => env('APP_HOST','http://127.0.0.1:8000').'/imageupload/' . $newimage,
            ];
            Bank::where('id',1)->update($data);
            Session::put('message', 'Đã Sửa ');
            return Redirect::back();
        } catch (Exception $e) {
            abort(404);
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
}
