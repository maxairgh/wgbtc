<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $news = News::orderBy('created_at','DESC')->paginate(4); 
        return view('admin.news.list',['news'=>$news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //caption news status
        $validated = $request->validate([
            'caption' => 'required',
            'news' => 'required',
            'status' => 'required',
        ]);

        //save 
        $news = News::create([
            'title' => $validated['caption'],
            'annoucement' => $validated['news'],
            'status' => $validated['status'],
            'user_id' => Auth::user()->id, 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

       //on success
       if ($news){
        return redirect()->route('news.index')->with('success','Annoucement saved successfully');
       }
    

    return back()->withInput()->with('errors','Error adding new Annoucement');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
        return view('admin.news.update',['news'=>$news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
          //caption news status
          $validated = $request->validate([
            'caption' => 'required',
            'news' => 'required',
            'status' => 'required',
        ]);

        $news = $news->update([
            'title' => $validated['caption'],
            'annoucement' => $validated['news'],
            'status' => $validated['status'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

       //on success
       if ($news){
        return redirect()->route('news.index')->with('success','Annoucement saved successfully');
       }
    

    return back()->withInput()->with('errors','Error adding new Annoucement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
        if ($news->delete()){
            //redirect 
            return redirect()->route('news.index')
            ->with('success', 'Announcement deleted Successfully');
        }
        return back()->withInput()->with('errors', 'Announcement could not be deleted.');
    }
}
