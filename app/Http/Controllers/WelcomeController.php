<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\SubCategory;
use App\Viewer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $viewer=new Viewer();
        $viewer->post_id=$id;
        $viewer->save();
        $value =Cookie::get('ahclan');
        if ($value=='mm'){
            App::setlocale('mm');
        }elseif ($value=='ch'){
            App::setlocale('ch');
        }
        $phones=SubCategory::all();
        $post=Post::where('id',$id)->with('languages:post_id,title')->first();
        return view('detail',compact('post','phones'));
    }
    public function welcome(){
        $value =Cookie::get('ahclan');
        if ($value=='mm'){
            App::setlocale('mm');
        }elseif ($value=='ch'){
            App::setlocale('ch');
        }
        return view('welcome');
    }

    public function posts()
    {
        $value =Cookie::get('ahclan');
        if ($value=='mm'){
            App::setlocale('mm');
        }elseif ($value=='ch'){
            App::setlocale('ch');
        }
        $phones=SubCategory::all();
        $posts=Post::paginate(9);
        return view('models',compact('posts','phones'));
    }


    public function search($name){
        $value =Cookie::get('ahclan');
        if ($value=='mm'){
            App::setlocale('mm');
        }elseif ($value=='ch'){
            App::setlocale('ch');
        }
        $id=Category::where('title',$name)->first()->id;
        $posts=Post::where('category_id', $id)->paginate(9);
        return view('models',compact(['posts','name']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function setCookie($data){
//        $minutes = 60;
//        $response = new Response($data);
//        $response->withCookie(cookie('ahclan', $data, $minutes));
//        return $response;
//    }
    public function change($request)
    {
        App::setlocale($request);
        $posts=Post::paginate(9);
        Cookie::queue('ahclan', $request, 120);
        return redirect()->back();
//        return view('models',compact('posts'));
    }
//    public function cookie(){
//        $value =Cookie::get('ahclan');
//        return $value;
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
