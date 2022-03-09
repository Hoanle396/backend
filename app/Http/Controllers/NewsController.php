<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $news=News::orderByDesc('id')->paginate(4);
        $new = News::first();
        return response()->json(['new'=>$new,'news'=>$news]);
    }
    public function show($id){
        $news = News::where('id',$id)->get()->first();
        return response()->json($news);
    }
}
