<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Helpers\PhotoHelper;
use App\Photo;
use App\Post;
use App\PostCategory;
use App\PostLanguage;
use App\Rating;
use App\Traffic;
use App\Viewer;
use Faker\Provider\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class PostController extends Controller
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
        $posts=Post::latest()->get();
        return view('post.index',compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
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
            "title" => "required",
            "video" => "required|file",
            "name" => "required",
            "price" => "required",
            "number" => "required",
            "age" => "required",
            "body" => "required",
            "height" => "required",
            "weight" => "required",
            "bust" => "required",
            "description" => "required",
            "languages" => "required",
        ]);
//        return $request;

        $post=new Post();
        $post->title=$request->title;
        $post->name=$request->name;
        $post->price=$request->price;
        $post->number=$request->number;
        $post->category_id=$request->city;
        $post->age=$request->age;
        $post->body=$request->body;
        $post->height=$request->height;
        $post->weight=$request->weight;
        $post->bust=$request->bust;
        $post->description=$request->description;

        $fileName = $request->video->getClientOriginalName();
        $filePath = 'videos/' . $fileName;

        $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));

        // File URL to access the video in frontend
        $url = Storage::disk('public')->url($filePath);

        if ($isFileUploaded) {
          $post->video=$filePath;
        }

        if ($post->save()){
//            PostCategory::where('post_id',$post->id)->delete();
            foreach ($request['languages'] as $t){
                $language=new PostLanguage();
                $language->post_id = $post->id;
                $language->language_id = $t;
                $language->save();
            }
            if ($request->hasFile('images')){
                foreach($request->file('images') as $image)
                {
                    $photo=new Photo();
                    $photo->url=PhotoHelper::storePhoto($image);
                    $photo->post_id=$post->id;
                    $photo->save();
                }
//            return 'success';
            }

        }
        return redirect()->route("post.create")->with("toast","Post Add Successful");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            "title" => "required",
            "name" => "required",
            "number" => "required",
            "age" => "required",
            "price" => "required",
            "body" => "required",
            "height" => "required",
            "weight" => "required",
            "video" => "file",
            "bust" => "required",
            "description" => "required",
//            "languages" => "required",
            "city" => "exists:categories,id",
//            "images.*" => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if ($request['languages']){
            PostLanguage::where('post_id',$post->id)->delete();
            foreach ($request['languages'] as $t){
                $language=new PostLanguage();
                $language->post_id = $post->id;
                $language->language_id = $t;
                $language->save();
            }
        }

        $post->title=$request->title;
        $post->name=$request->name;
        $post->price=$request->price;
        $post->number=$request->number;
        $post->category_id=$request->city;
        $post->age=$request->age;
        $post->body=$request->body;
        $post->height=$request->height;
        $post->weight=$request->weight;
        $post->bust=$request->bust;
        $post->description=$request->description;
        if ($request->hasFile('video')){
            $fileName = $request->video->getClientOriginalName();
            $filePath = 'videos/' . $fileName;

            $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));

            // File URL to access the video in frontend
            $url = Storage::disk('public')->url($filePath);

            if ($isFileUploaded) {
                $post->video=$filePath;
            }
        }

        $post->update();
        return redirect()->route("post.index")->with("toast","Post Update Successful");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        $old=Photo::where('post_id',$post->id)->get();
        // foreach ($old as $o){
            // unlink(storage_path('/app/public/model/'.$o->name));
        // }
        Photo::where('post_id',$post->id)->delete();
        Viewer::where('post_id',$post->id)->delete();
        $post->delete();
        return redirect()->route("post.index")->with("toast","Post Delete Successful");
    }

}
