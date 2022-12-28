<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Helpers\PhotoHelper;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
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
        $all=Book::where([['type','all'],['name',auth()->user()->name ]])->latest()->paginate(10);
        $one=Book::where([['type','one'],['name',auth()->user()->name ]])->latest()->paginate(10);
        return view('book.index',compact('all','one'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }
//    public function getUser()
//    {
//       return Auth::guard('api')->user();
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $book=new Book();
        $book->user_id=auth()->user()->id;
        $book->name= auth()->user()->name ;
        $book->author=auth()->user()->author ;
        $book->title=$request->title;
        $book->group_id=$request->group_id;
        $book->chapter=$request->chapter;
        $book->price=$request->price;
        $book->type=$request->type;
        $book->cover = PhotoHelper::storePhoto($request->file("cover"));
        $book->save();

        $category=new Category();
        $category->user_id=auth()->user()->id;
        $category->book_id=$book->id;
        $category->name= auth()->user()->name ;
        $category->author=auth()->user()->author ;
        $category->main_title=$request->title;
        $category->title=$request->title;
        $category->chapter=$request->chapter;
        $category->price=0;
        $category->ads='free';
        $category->type='done';
        $category->cover = PhotoHelper::storePhoto($request->file("cover"));
        $category->save();

        return redirect()->route("book.index")->with("toast","New Book Add Successfully");
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
