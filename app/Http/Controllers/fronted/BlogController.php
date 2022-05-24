<?php

namespace App\Http\Controllers\fronted;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\PostCategory;
use App\Reply;

class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
		 $data['title']=trans('labels.blog');
         $data['setting']=$this->getUserSetting(1);
        $data['title2']='';

         $posts=Post::orderBy('id', 'DESC')->paginate(10); 
         $cid=$req->id;
         if($cid){
           $posts=Post::orderBy('id', 'DESC')->paginate(10); 
         }
        if($req->name){
          $data['title2']=$req->name;  
        }

       
        return view('fronted.blog.index')->with('posts',$posts)->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
		$id=$request->id; 
		$title=$request->title; 
		$data['title']=trans('labels.blog');
         $data['setting']=$this->getUserSetting(1);
        $data['title2']=$title;
		$data['related']=Post::where('id','!=',$id)->limit(4)->get();
        return view('fronted.blog.show')->with('post',Post::find($id))->with('replies',Reply::all())->withData($data);
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
