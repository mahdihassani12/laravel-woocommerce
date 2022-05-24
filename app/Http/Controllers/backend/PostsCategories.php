<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PostCategory;
use DB;
class PostsCategories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['p_tab']='post';
        $data["tab"] = 'category';
        $data["page_title"] = trans("labels.categories");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.categories.index')->with('categories',PostCategory::orderBy('id', 'DESC')->where('parent',0)->paginate(10))->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['p_tab']='post';
        $data["tab"] = 'category';
        $data["page_title"] = trans("labels.add_category");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.categories.create')->with('categories',PostCategory::all()->where('parent',0))->withData($data);
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

        $categories = new PostCategory();
        $data = $request->all();

        $categories -> name = $data['name'];
        $categories -> parent = $data['parent'];
		try {
       DB::beginTransaction();	
          $categories -> save();
       DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
		
        return redirect('categories');
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
        $data['p_tab']='post';
        $data["tab"] = 'category';
        $data["page_title"] = trans("labels.edit_category");
        $data['setting']=$this->getUserSetting(1);


        return view('backend.categories.edit')->with('category',PostCategory::find($id))->with('categories',PostCategory::all()->where('parent',0))->withData($data);
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
            'name' => 'required',
            'parent' => 'required'
        ]);

        $category = PostCategory::find($id);
        $data = $request->all();

          $category -> name = $data['name'];
          $category -> parent = $data['parent'];
		try {
          DB::beginTransaction();	  
          $category -> save();
        
		  DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
		
        return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteCat($id)
    {
        $category = PostCategory::find($id);
        $category -> delete();
        try {
         DB::beginTransaction();	
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        return redirect('categories');
    }
}
