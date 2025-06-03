<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    //
    public function index()
    {
        return view('admin.news-updates');
    }
    public function store(Request $request)
    {
           $news = new News();
           $news->title = $request->title;
           $news->category = $request->category;
           $news->description = $request->description;
           $news->news_photo = $request->news_photo;
           $news->save();
        return redirect()->route('admin.news-updates',['news'=>$news]);
    }
    public function edit($id)
    {
        return view('admin.news-updates');
    }
    public function update(Request $request, $id)
    {
        return view('admin.news-updates');
    }
    public function destroy($id)
    {
        return view('admin.news-updates');
    }
}
