<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\About;
use DB;

class aboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['p_tab']='page';
        $data["tab"] = 'aboutus';
        $data["page_title"] = trans("labels.about_us");
        $data['setting']=$this->getUserSetting(1);
         
        return view('backend.about.index')->with('about',About::find(1))->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $data['p_tab']='page';
        $data["tab"] = 'aboutus';
        $data["page_title"] = trans("labels.about_us");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.about.create')->withData($data);
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
            'title' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048',
            'content' => 'required'
        ]);

        $about = new About();
        $data = $request -> all();

        if ($files = $request->file('image')) {
           $destinationPath = 'public/uploads/about/'; // upload path
           $file = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $file);
           $file = "$file";
        }

        $about -> title = $data['title'];
        $about -> content = $data['content'];
        $about -> image = $file;
     try {
         DB::beginTransaction(); 
        $about -> save();
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('about');
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
          $data['p_tab']='page';
        $data["tab"] = 'aboutus';
        $data["page_title"] = trans("labels.about_us");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.about.edit')->with('about',About::find($id))->withData($data);
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
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $about = About::find($id);
        $data = $request -> all();

        if ($files = $request->file('image')) {
           $destinationPath = 'public/uploads/about/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $about -> image = $profileImage;

           $photo = About::find($id)->image;
            if(!is_null($photo) && file_exists(public_path('public/uploads/about/'.$photo))){
                unlink(public_path('public/uploads/about/'.$photo));
            }

        }

        $about -> title = $data['title'];
        $about -> content = $data['content'];
         try {
         DB::beginTransaction();
            $about -> update();
            DB::commit();
            $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('about');
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
