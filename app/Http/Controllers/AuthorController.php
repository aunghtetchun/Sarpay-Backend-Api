<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
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
        $bauthors=User::where('role','reader')->latest()->paginate(10);
        $authors=User::where('role','author')->latest()->paginate();
        return view('author.index', compact(['authors', 'bauthors']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|max:255",
            "author" => "required|max:255|unique:users",
            "card" => "required|max:255|unique:users",
            "phone" => "required|max:255",
            "photo" => "required|mimetypes:image/jpeg,image/png|file|max:3500",
            "email" => "required|max:255|email|unique:users",
            "password" => "required|max:255|min:8",
        ]);
        $author=new User();
        $author->email=$request->email;
        $author->password=Hash::make($request->password);
        $author->name=$request->name;
        $author->author=$request->author;
        $author->card=$request->card;
        $author->phone=$request->phone;
        $author->role='author';
        $dir="public/author/photo";
        $newName = uniqid()."_photo.".$request->file("photo")->getClientOriginalExtension();
        $request->file("photo")->storeAs($dir,$newName);
        $author->photo=$newName;
        $author->save();
        return redirect()->route("author.index")->with("toast","New Author Add Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $author
     * @return \Illuminate\Http\Response
     */
    public function show(User $author)
    {
        $books=Book::where('user_id',$author->id)
            ->latest()
            ->limit(10)
            ->withCount('getCategory')
            ->get();
//        return $books;
        return view('author.show', compact(['author','books']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(User $author)
    {
        return view('author.edit',compact('author'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            "name" => "required|max:255",
            "author" => "required|max:255",
            "card" => "required|max:255",
            "phone" => "required|max:255",
//            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            "password" => "required|max:255|min:8",
            "photo" => "mimetypes:image/jpeg,image/png|file|max:3500",
        ]);
        $author=User::find($id);
        $author->password=Hash::make($request->password);
        $author->name=$request->name;
        $author->author=$request->author;
        $author->card=$request->card;
        $author->phone=$request->phone;
        $author->role='author';
        if ($request->file("photo")){
            $dir="public/author/photo";
            $newName = uniqid()."_photo.".$request->file("photo")->getClientOriginalExtension();
            $request->file("photo")->storeAs($dir,$newName);
            $author->photo=$newName;
        }
        $author->update();
        return redirect()->route('author.index')->with("toast","Author Updated Successfully");

    }
    public function ban($id) {
        $author=User::find($id);
        if ($author->role == 'reader') {
            $author->role = 'author';
        }else{
            $author->role='reader';
        }
        $author->update();
        return redirect()->route('author.index')->with("toast","Author Ban Successfully");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {

    }
}
