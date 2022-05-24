<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Slider;
use App\Http\Controllers\Controller;
use DB;

class slidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['p_tab']='';
        $data["tab"] = 'slider';
        $data["page_title"] = trans("labels.sliders");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.sliders.index')->with('sliders',Slider::orderBy('id', 'DESC')->paginate(10))->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['p_tab']='';
        $data["tab"] = 'slider';
        $data["page_title"] = trans("labels.sliders");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.sliders.create')->withData($data);
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
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $sliders = new Slider();
        $data = $request -> all();

        if ($files = $request->file('image')) {
           $destinationPath = 'uploads/sliders/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $featured_image = "$profileImage";
        }

        $sliders -> title = $data['title'];
        $sliders -> description = $data['description'];
        $sliders -> image = $featured_image;
        try {
            DB::beginTransaction();   
            $sliders -> save();
            DB::commit();
            $this->CreateMessages('done');
            } catch (\Exception $e) {
                DB::rollback();
                $this->CreateMessages('not_done');
                throw $e;
        }
        return redirect('/sliders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.sliders.show')->with('slider',Slider::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data['p_tab']='';
        $data["tab"] = 'slider';
        $data["page_title"] = trans("labels.sliders");
        $data['setting']=$this->getUserSetting(1);
        return view('backend.sliders.edit')->with('slider',Slider::find($id))->withData($data);
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
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $sliders =Slider::find($id);
        $data = $request -> all();

        if ($files = $request->file('image')) {
           $destinationPath = 'uploads/sliders/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $featured_image = "$profileImage";
           $sliders -> image = $featured_image;

           $photo = Slider::find($id)->image;
            if(!is_null($photo) && file_exists(public_path('uploads/sliders/'.$photo))){
                unlink(public_path('uploads/sliders/'.$photo));
            }

        }

        $sliders -> title = $data['title'];
        $sliders -> description = $data['description'];
        try {
            DB::beginTransaction();   
            $sliders -> update();
            DB::commit();
            $this->CreateMessages('done');
            } catch (\Exception $e) {
                DB::rollback();
                $this->CreateMessages('not_done');
                throw $e;
        }
        return redirect('/sliders');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();   
            $slider = Slider::find($id);
            $slider -> delete();
            $photo=$slider->featured_image;
            if(!is_null($photo) && file_exists(public_path('uploads/sliders/'.$photo))){
                unlink(public_path('uploads/sliders/'.$photo));
            }
            DB::commit();
            $this->CreateMessages('done');
            } catch (\Exception $e) {
                DB::rollback();
                $this->CreateMessages('not_done');
                throw $e;
        }

        return redirect('/sliders');

    }
}