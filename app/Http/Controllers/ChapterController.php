<?php

namespace App\Http\Controllers;

use App\Category;
use App\Chapter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class ChapterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chapter($title){
        $chapters=Chapter::where([['sub_title',$title],['name',auth()->user()->name ]])->latest()->paginate(10);
        return view('chapter.index',compact('chapters', 'title'));
    }

    public function create($title)
    {
        return view('chapter.create',compact('title'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            "sub_title" => "required|max:255",
            "title" => "required|max:255",
            "description" => "required",
        ]);
        $category_id=Category::where([['title',$request->sub_title],['name',auth()->user()->name ]])->first('id')->id;
        $chapter=new Chapter();
        $chapter->category_id=$category_id;
        $chapter->name= auth()->user()->name ;
        $chapter->author=auth()->user()->author ;
        $chapter->sub_title=$request->sub_title;
        $chapter->title=$request->title;
        $chapter->description=$request->description;
        $chapter->save();
        return redirect()->route( 'chapter-insert',$request->sub_title )->with("toast","New Chapter Add Successfully");
    }

    public function show($id)
    {
        $chapter=Chapter::where([['id',$id],['name',auth()->user()->name ]])->first();
        return view('chapter.show', compact('chapter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit($chapter)
    {
        return view('chapter.edit', compact('chapter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required|max:255",
            "description" => "required",
        ]);
        $chapter=Chapter::find($id);
        $chapter->title=$request->title;
        $chapter->description=$request->description;
        $chapter->update();
        $title=$chapter->sub_title;
        return redirect()->route( 'chapter-insert',$title )->with("toast","Chapter Update Successfully");
    }

    public function delete($id)
    {
        $chapter=Chapter::where([['id',$id],['name',auth()->user()->name ]])->first();
        $chapter->delete();
        $title=$chapter->sub_title;
        return redirect()->route( 'chapter-insert',$title)->with("toast"," Chapter Deleted Successfully");

    }
}
