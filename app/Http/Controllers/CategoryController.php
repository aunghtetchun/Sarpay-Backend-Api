<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Helpers\PhotoHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function category($title){
        $books=Category::where([['main_title',$title],['ads','paid'],['name',auth()->user()->name ]])
            ->latest()
            ->limit(10)
            ->withCount('getChapter')
            ->get();
        $fbooks=Category::where([['main_title',$title],['ads','free'],['name',auth()->user()->name ]])
            ->latest()
            ->limit(10)
            ->withCount('getChapter')
            ->get();
        return view('category.index',compact(['books','fbooks', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($title)
    {
//        return $title;
        return view('category.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request;
        $request->validate([
            "main_title" => "required|max:255",
            "title" => "required|max:255",
            "type" => "required|in:release,done",
            "chapter" => "required|max:255",
            "price" => "required|integer",
            "cover" => "required|mimetypes:image/jpeg,image/png|file|max:3500"
        ]);
        $book_id=Book::where([['title',$request->main_title],['name',auth()->user()->name ]])->first('id')->id;
        $category=new Category();
        $category->user_id=auth()->user()->id;
        $category->book_id=$book_id;
        $category->name= auth()->user()->name ;
        $category->author=auth()->user()->author ;
        $category->main_title=$request->main_title;
        $category->title=$request->title;
        $category->chapter=$request->chapter;
        $category->type=$request->type;
        $category->price=$request->price;
        $category->cover=PhotoHelper::storePhoto($request->file("cover"));
        $category->save();
        return redirect()->route( 'book-insert',$request->main_title )->with("toast","New Category Add Successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
                    "title" => "required|max:255",
                    "chapter" => "required|max:255",
                    "type" => "required|in:release,done",
        ]);
                $category=Category::find($id);
                $category->title=$request->title;
                $category->chapter=$request->chapter;
                $category->type=$request->type;
                $category->update();
                return redirect()->route('book-insert',$category->main_title)->with("toast","Category Updated Successfully");
    }
    public function done(Request $request, $id)
    {
        $category= Category::where([['id',$id],['name',auth()->user()->name ]])->update(['type' => 'done']);
        return redirect()->route( 'book-insert',$category->main_title )->with("toast","Book Finish Successfully");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
     //
    }
}
