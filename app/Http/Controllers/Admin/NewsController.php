<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get("admin_name")) {
            $news = News::orderByDesc('id')->paginate(8);
            $news_ = view('admin.news')->with('news', $news);
            return view('admin_layout')->with('admin.news', $news_);
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
        if (Session::get('admin_name')) {
            return view('admin.addnews');
        } else {
            return Redirect::to('/');
        }
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
            $newimage = time() . "-news." . $image->getClientOriginalExtension();
            $image->move('./public/imageupload', $newimage);
            $data = [
                'title' => $request->name,
                'description' => $request->description,
                'image' => env('APP_HOST','http://127.0.0.1:8000').'/imageupload/' . $newimage,
            ];
            News::create($data);
            Session::put('message', 'Đã Thêm Tin Này');
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
        if (Session::get("admin_name")) {
            $news = News::where('id', $id)->get()->first();
            $news_ = view('admin.updatenews')->with('news', $news);
            return view('admin_layout')->with('admin.updatenews', $news_);
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
            $request->validate([
                'image' => [
                    'required',
                    'mimes:jpeg,png,jpg',
                    'mimetypes:image/jpeg,image/png,image/jpg',
                    'max:1000000'
                ]
            ]);
            $image = $request->file('image');
            $newimage = md5(time()) . "-news." . $image->getClientOriginalExtension();
            $image->move('./imageupload', $newimage);
            $data = [
                'title' => $request->name,
                'description' => $request->description,
                'image' => env('APP_HOST','http://127.0.0.1:8000').'/imageupload/' . $newimage,
            ];
            News::where('id',$id)->update($data);
            Session::put('message', 'Đã Sửa Tin Này');
            return Redirect::back();
        } catch (Exception $e) {
            abort(404);
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
        if (Session::get("admin_name")) {
            $news = News::where('id', $id)->delete();
            if ($news) {
                Session::put('message', 'Đã xóa nội dung này');
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
