<?php

namespace App\Http\Controllers;

use App\Book;
use App\Buy;
use App\Category;
use App\Chapter;
use App\Helpers\PhotoHelper;
use App\Http\Requests\UpdateBookRequest;
use App\Payment;
use App\Reader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }
    /////////////////////////////////////Reader Functions ///////////////////////////////////////////////
    public function reader(){
        $readers=Reader::withCount('getBuy')->get();
        return view('main.reader.index',compact('readers'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reader  $reader
     * @return \Illuminate\Http\Response
     */
    public function redit(Reader $reader){
        return view('main.reader.edit',compact('reader'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reader  $reader
     * @return \Illuminate\Http\Response
     */
    public function rupdate(Request $request, Reader $reader)
    {
        $request->validate([
            "coin" => "required|digits_between:0,9",
            "password" => "required"
        ]);
        if ($request->password=="password"){
            
        $reader->coin=$reader->coin+ $request->coin;
        $reader->update();
        return redirect()->route('admin.rindex')->with("toast"," ပိုက်ဆံထည့်ပီးပါပီ...");
            // $reader->password = bcrypt($request->password);
        }
                return redirect()->route('admin.rindex')->with("toast"," Password Wrong...");
    }

    public function rbook($id){
        $books=Buy::where('reader_id',$id)->with('getBooks')->latest()->get();
        return view('main.reader.bought-books',compact('books'));
    }


    /////////////////////////////////////Book Functions ///////////////////////////////////////////////
    /**
     * Show the form for editing the specified resource.
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function bedit(Book $book)
    {
        return view('book.edit',compact('book'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */

    public function bupdate(UpdateBookRequest $request,Book $book)
    {
        $book->title=$request->title;
        $book->chapter=$request->chapter;
        $book->price=0;
        $book->group_id=$request->group_id;
        $book->type=$request->type;
        if ($request->file("cover")){
            $book->cover = PhotoHelper::storePhoto($request->file("cover"));
        }
        $book->update();
        return redirect()->route('author.show', $book->user_id)->with("toast","Book Updated Successfully");
    }

    public function bshow($book)
    {
        $books=Category::where([['book_id',$book]])
            ->latest()
            ->withCount('getChapter')
            ->withCount('getBuy')
            ->paginate(10);
        $fbooks=Category::where([['book_id',$book],['ads','free']])
            ->latest()
            ->withCount('getChapter')
            ->paginate(10);
        return view('main.book.show',compact('books','fbooks'));
    }
    public function popularBook(Request $request){
        Book::where('id', $request->id)->update(['popular' => $request->popular]);
        return redirect()->route('admin.bookList')->with("toast","Popular book added.");
    }

    public function bookStatus(Request $request){
        Book::where('id', $request->id)->update(['status' => $request->status]);
        return redirect()->route('admin.bookList')->with("toast","This book is finished.");

    }


    /////////////////////////////////////Chapter Functions ///////////////////////////////////////////////

    public function chindex($id)
    {
        $chapters=Chapter::where([['category_id',$id]])->get();
        return view('main.chapter.index', compact('chapters'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function chdestroy(Chapter $chapter)
    {
        $chapter->delete();
        return redirect()->back()->with("toast"," Chapter Delete Successfully");;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function chshow(Chapter $chapter)
    {
        return view('main.chapter.show', compact('chapter'));
    }


    /////////////////////////////////////Category Functions ///////////////////////////////////////////////

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function cedit(Category $category)
    {
        return view('main.category.edit', compact('category'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function cupdate(Request $request, Category $category)
    {
        $request->validate([
            "title" => "required|max:255",
            "chapter" => "required|max:255",
            "price" => "required|integer",
            "type" => "required|in:release,done",
            "cover" => "mimetypes:image/jpeg,image/png|file|max:3500"
        ]);
        $category->title=$request->title;
        $category->chapter=$request->chapter;
        $category->price=$request->price;
        $category->type=$request->type;
        if ($request->file("cover")){
            $category->cover=PhotoHelper::storePhoto($request->file("cover"));
        }

        $category->update();
        return redirect()->route('admin.bshow', $category->book_id)->with("toast"," Category Update Successfully");

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function cdestroy(Category $category)
    {
        Chapter::where([['category_id',$category->id]])->delete();
        $category->delete();
        return redirect()->back()->with("toast"," Category Delete Successfully");
    }
/////////////////////////////////////Payment Functions ///////////////////////////////////////////////
    public function pmindex()
    {
        $payment=Payment::where('status','wait')->get();
        $dpayment=Payment::where('status','done')->get();
        return view('main.payment.index', compact(['payment','dpayment']));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pmdestroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->back()->with("toast"," Payment Remove Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pmshow(Payment $payment)
    {
        $reader=Reader::find($payment->reader_id);
        $reader->coin=$reader->coin+$payment->amount;
        $reader->update();
        $payment->status='done';
        $payment->update();
        return redirect()->route('admin.pmindex')->with("toast"," ပိုက်ဆံထည့်ပီးပါပီ...");
    }

    public function bookList(){
        $books=Book::all();
        return view('main.book.index',compact('books'));
    }


}
