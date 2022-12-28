<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Book;
use App\Buy;
use App\Category;
use App\Chapter;
use App\Group;
use App\Helpers\PhotoHelper;
use App\Reader;
use App\Payment;
use App\Viewer;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isReader');
    }
    public function getUser()
    {
        return response()->json(array('user'=> Auth::guard('api')->user()));
    }
    public function home(){
        try {
            $group=Group::latest()->get();
            foreach ($group as $g){
                $g->photos = array_map(function($book){
                    $book['cover']=asset("storage/book/cover/".$book["cover"]);
                    return $book;
                },Book::where('group_id',$g->id)->limit(3)->get()->toArray());
            }
            return response()->json([
                'result' => 1,
                'message' => 'success',
                'group' => $group
            ], 201);

        }catch(\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'Fail to proceed!',
                'message_detail' => $e->getMessage(),
            ], 500);
        }

    }
    

    public function bookList($id)
    {
        try {
            $books=Book::where('group_id',$id)->latest()->paginate(12);
            foreach ($books as $g){
                $cover = $g->cover;
                $g->cover = asset("storage/book/cover/".$cover);
            }
            return response()->json([
                'result' => 1,
                'message' => 'success',
                'books' => $books
            ], 201);

        }catch(\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'Fail to get book list!',
                'message_detail' => $e->getMessage(),
            ], 500);
        }

    }
     public function searchBooks(Request $request)
    {
        try {
              $request->validate([
                "title" => "required",
            ]);
            $books=Book::query()->where('title','LIKE', "%{$request->title}%")->latest()->paginate(12);
            foreach ($books as $g){
                $cover = $g->cover;
                $g->cover = asset("storage/book/cover/".$cover);
            }
            return response()->json([
                'result' => 1,
                'message' => 'success',
                'books' => $books
            ], 201);

        }catch(\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'Fail to get book list!',
                'message_detail' => $e->getMessage(),
            ], 500);
        }

    }
      public function getCategoryList($id)
    {
        try {
            $free=Category::where('book_id',$id)->where('ads','free')->first();
            $books=Category::where('book_id',$id)->where('ads','paid')->latest()->paginate(12);
            foreach ($books as $g){
                $cover = $g->cover;
                $g->cover = asset("storage/book/cover/".$cover);
            }
            $cv=$free->cover;
            // return $cv;
            $free->cover = asset("storage/book/cover/".$cv);
            return response()->json([
                'result' => 1,
                'message' => 'success',
                'free'=>$free,
                'books' => $books
            ], 201);

        }catch(\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'Fail to get book list!',
                'message_detail' => $e->getMessage(),
            ], 500);
        }

    }
    public function getBookDetail($id)
    {
        try {
            $free=Category::where('book_id',$id)->where('ads','free')->first();
            $cover=$free->cover;
            $free->cover=asset("storage/book/cover/".$cover);
            $books=Category::where('book_id',$id)->where('ads','paid')->latest()->paginate(12);
            foreach ($books as $g){
                $cover = $g->cover;
                $g->cover = asset("storage/book/cover/".$cover);
            }
            return response()->json([
                'result' => 1,
                'message' => 'success',
                'free' => $free,
                'books' => $books
            ], 201);

        }catch(\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'Fail to get book list!',
                'message_detail' => $e->getMessage(),
            ], 500);
        }

    }
    public function getChapter($id)
    {
        try {
            $free=Category::where('id',$id)->first('ads');
            $buy=Buy::where('category_id',$id)->where('reader_id',Auth::guard('api')->user()->id)->exists();
            if($buy){
                $chapters=Chapter::where('category_id',$id)->get();
                return response()->json([
                    'result' => 1,
                    'message' => 'success',
                    'chapters' => $chapters
                ], 201);
            }elseif ($free['ads'] !=="paid"){
                $chapters=Chapter::where('category_id',$id)->get();
                return response()->json([
                    'result' => 1,
                    'message' => 'success',
                    'chapters' => $chapters
                ], 201);
            }else{
                return response()->json([
                    'result' => 0,
                    'message' => 'Buy this book first',
                ], 201);
            }

        }catch(\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'Fail to read book!',
                'message_detail' => $e->getMessage(),
            ], 500);
        }
    }
    public function addPayment(Request $request){
        try {
            $request->validate([
                "amount" => "required",
                "payment" => "required|max:3500"
            ]);
            
             $image_64 = $request->payment; //your base64 encoded data

  $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

  $replace = substr($image_64, 0, strpos($image_64, ',')+1); 

// find substring fro replace here eg: data:image/png;base64,

 $image = str_replace($replace, '', $image_64); 

 $image = str_replace(' ', '+', $image); 

 $imageName = Str::random(10).'.'.$extension;

 Storage::disk('public')->put($imageName, base64_decode($image));
            
            $payment=new Payment();
            $payment->amount=$request->amount;
            $payment->payment=$imageName;
            $payment->reader_id=Auth::guard('api')->user()->id;
            $payment->save();
            $finish=' We will check your payment and reply soon.....';
            return response()->json([
                'result' => 1,
                'message' => $finish,
            ], 201);

        }catch(\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'Fail to send payment!',
                'message_detail' => $e->getMessage(),
            ], 500);
        }

    }

    public function buyBook(Request $requestbookLi){
        try {
            $request->validate([
                "category_id" => "required|integer|max:100",
                "reader_id" => "required|integer|max:100",
            ]);
            if ($request->reader_id = Auth::guard('api')->user()->id){
                $reader=Reader::find(Auth::guard('api')->user()->id);
                $category=Category::find($request->category_id);
                $isExit=Buy::where('category_id',$request->category_id)->where('reader_id', Auth::guard('api')->user()->id)->doesntExist();
                if ($isExit){
                    if ($reader->coin >= $category->price){
                        $uprice=$reader->coin - $category->price;
                        Reader::where('id', Auth::guard('api')->user()->id)
                            ->update(['coin' => $uprice]);
                        $buy=new Buy();
                        $buy->category_id=$request->category_id;
                        $buy->reader_id=Auth::guard('api')->user()->id;
                        $buy->price=$category->price;
                        $buy->save();
                        $finish='Thanks for buying this book.....';
                    }else{
                        $finish='Not enough money for this books.....';
                    }
                }
                else{
                    $finish='Thanks for buying this book.....';
                }

            }else{
                $finish='Wrong User Login.....';
            }
            return response()->json([
                'result' => 1,
                'message' => $finish,
            ], 201);

        }catch(\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'Fail to buy books!',
                'message_detail' => $e->validator->errors(),
            ], 500);
        }

    }

    //all books by reader
    public function boughtBooks(){
        try {
            $books=Buy::where('reader_id',Auth::guard('api')->user()->id)->with('getBooks')->latest()->paginate(12);
            foreach ($books as $b){
                $cover = $b->getBooks->cover;
                $b->getBooks->cover = asset("storage/book/cover/".$cover);
            }
            return response()->json([
                'result' => 1,
                'message' => 'success',
                'b_books' => $books
            ], 201);

        }catch(\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'Fail to get bought books!',
                'message_detail' => $e->getMessage(),
            ], 500);
        }

    }
    public function getAds(){
        try {
            $ads=Ads::latest()->first();
            return response()->json([
                'result' => 1,
                'message' => 'success',
                '$ads' => $ads
            ], 201);

        }catch(\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'Fail to get Ads!',
                'message_detail' => $e->getMessage(),
            ], 500);
        }

    }


    //all popular books
    public function popularBooks(){
        try{
            $books=Book::where('popular','1')->latest()->paginate(12);
            foreach ($books as $b){
                $cover = $b->cover;
                $b->cover = asset('storage/book/cover/'.$cover);
//                $b->category = array_map(function($category){
//                    $category['cover']=asset("storage/book/cover/".$category["cover"]);
//                    return $category;
//                },$b->getCategory()->get()->toArray());
            }
            return response()->json([
                'result' => 1,
                'message' => 'success',
                'books' => $books
            ], 201);

        }catch(\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'Fail to get popular books!',
                'message_detail' => $e->getMessage(),
            ], 500);
        }

    }

    //for show books
    public function forShowBooks(){
        try {
            $bbooks=Buy::where('reader_id',Auth::guard('api')->user()->id)->with('getBooks')->latest()->paginate(12);
            foreach ($bbooks as $b){
                $cover = $b->getBooks->cover;
                $b->getBooks->cover = asset("storage/book/cover/".$cover);
            }

            $pbooks=Book::where('popular','1')->latest()->with('getCategory')->limit(3)->get();
            foreach ($pbooks as $b){
                $cover = $b->cover;
                $b->cover = asset('storage/book/cover/'.$cover);
//                $b->category = array_map(function($category){
//                    $category['cover']=asset("storage/book/cover/".$category["cover"]);
//                    return $category;
//                },$b->getCategory()->get()->toArray());
            }
            return response()->json([
                'result' => 1,
                'message' => 'success',
                'bought_books' => $bbooks,
                'popular_books' => $pbooks
            ], 201);

        }catch(\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'Fail to proceed!',
                'message_detail' => $e->getMessage(),
            ], 500);
        }

    }
    public function readBook(Request $request){
        try {
            $request->validate([
                "reader_id" => "required|integer",
                "category_id" =>"required|integer",
            ]);
            $old=Viewer::whereMonth('created_at', Carbon::now()->month)
                ->where('category_id',$request->category_id)
                ->where('reader_id',$request->reader_id)
                ->exists();
            if ($old){
                $old->reader_id=$request->reader_id;
                $old->category_id=$request->category_id;
                $old->update();
            }else{
                $viewer=new Viewer();
                $viewer->reader_id=$request->reader_id;
                $viewer->category_id=$request->category_id;
                $viewer->save();
            }
            return response()->json([
                'result' => 1,
                'message' => 'success',
            ], 201);

        }catch(\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'Fail to read book!',
                'message_detail' => $e->validator->errors(),
            ], 500);
        }

    }
}
