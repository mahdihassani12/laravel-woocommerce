<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use DB;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data['p_tab']='';
        $data["tab"] = 'comments';
        $data["page_title"] = trans("labels.comments");
        $data['setting']=$this->getUserSetting(1);
        return view('backend.comments.index')->with('comments',Comment::orderBy('id', 'DESC')->paginate(10))->withData($data);
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
        $this->validate($request,[
            'message' => 'required',
            'name' => 'required',
            'email' => 'required'
        ]);

        $comments = new Comment();
        $data = $request -> all();

        $comments -> user_name = $data['name'];
        $comments -> user_email = $data['email'];
        $comments -> content = $data['message'];
        if ($request->has('post_id')) {
            $comments -> post_id = $data['post_id'];
        } 
        if ($request->has('download_id')) {
           $comments -> download_id = $data['download_id'];
        }
        
     try {
         DB::beginTransaction();
        $comments -> save();        
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }   
        return redirect()->back();
    }

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

       $comment = Comment::find($id);
        $data = $request -> all();

        $comment -> status = 1;
        
     try {
         DB::beginTransaction();
        $comment -> update();        
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }   
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
         try {
        DB::beginTransaction();  
        $comment = Comment::find($id);
        $comment -> delete();
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('comments');
    }


}
