<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    //
    public function index()
    {
        $news = News::paginate(10);
        // get the added_by name from admin table
        $news->load('admin');

        return view('admin.news-updates',['news'=>$news]);
    }
    public function store(Request $request)
    {  
        $validate=$request->validate([
            'title'=>'required',
            'category'=>'required',
            'description'=>'required',
            'added_by'=>'required',
            'news_photo'=>'required',
        ]);
         
        if(!$validate){
            return redirect()->back()->with('error','Please fill all the fields');
        }
        $news = new News();
        $news->title = $request->title;
        $news->category = $request->category;
        $news->description = $request->description;
        $news->added_by = $request->added_by;
        if($request->hasFile('news_photo')){
            $photo = $request->file('news_photo');
            $photo->store('news', 'public');
            $news->news_photo = $photo->hashName();
        }
        $news->save();
        return $request;
    }
    public function show($id)
    {
         print_r($id, "hello world");
          $news = News::paginate(10);
        // get the added_by name from admin table
        $news->load('admin');
        // $news = News::find($id);
        return view('admin.news-updates',['news'=>$news]);
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
