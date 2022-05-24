<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use DB;

class tagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['p_tab']='post';
        $data["tab"] = 'tag';
        $data["page_title"] = trans("labels.tags");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.tags.index')->with('tags',Tag::orderBy('id', 'DESC')->paginate(10))->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['p_tab']='post';
        $data["tab"] = 'tag';
        $data["page_title"] = trans("labels.tag");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.tags.create')->withData($data);
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
            'name' => 'required'
        ]);

        $tags = new Tag();
        $data = $request -> all();
        $tags -> name = $data['name'];
        try {
            DB::beginTransaction();   
            $tags -> save();
            DB::commit();
            $this->CreateMessages('done');
            } catch (\Exception $e) {
                DB::rollback();
                $this->CreateMessages('not_done');
                throw $e;
        }

        return redirect('/tags');


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
        return view('backend.tags.edit')->with('tag',Tag::find($id));
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
        $this->validate($request,[
            'name' => 'required'
        ]);

        $tags = Tag::find($id);
        $data = $request -> all();
        $tags -> name = $data['name'];
        try {
            DB::beginTransaction();   
            $tags -> save();
            DB::commit();
            $this->CreateMessages('done');
            } catch (\Exception $e) {
                DB::rollback();
                $this->CreateMessages('not_done');
                throw $e;
        }
        return redirect('/tags');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteTag($id)
    {
        
        try {
            DB::beginTransaction();   
            $tag = Tag::find($id);
            $tag -> delete();

            DB::table('tbl_post_tag')->where('tag_id',$id)->delete();
            DB::commit();
            $this->CreateMessages('done');
            } catch (\Exception $e) {
                DB::rollback();
                $this->CreateMessages('not_done');
                throw $e;
        }

        return redirect('/tags');

    }
}