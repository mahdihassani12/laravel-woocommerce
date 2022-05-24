<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use DB;

class servicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['p_tab']='page';
        $data["tab"] = 'service';
        $data["page_title"] = trans("labels.services");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.services.index')->with('services',Service::orderBy('id', 'DESC')->paginate(10))->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['p_tab']='page';
        $data["tab"] = 'service';
        $data["page_title"] = trans("labels.add_service");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.services.create')->withData($data);
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
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048',
            'description' => 'required'
        ]);

        $service = new Service();
        $data = $request -> all();

        if ($files = $request->file('image')) {
           $destinationPath = 'public/uploads/services/'; // upload path
           $file = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $file);
           $file = "$file";
        }

        $service -> name = $data['name'];
        $service -> description = $data['description'];
        $service -> image = $file;
     try {
         DB::beginTransaction(); 
        $service -> save();
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('services');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['p_tab']='page';
        $data["tab"] = 'service';
        $data["page_title"] = trans("labels.add_service");
        $data['setting']=$this->getUserSetting(1);
        return view('backend.services.show')->with('service',Service::find($id))->withData($data);
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
        $data["tab"] = 'service';
        $data["page_title"] = trans("labels.services");
        $data['setting']=$this->getUserSetting(1);
        return view('backend.services.edit')->with('service',Service::find($id))->withData($data);
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
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $service = Service::find($id);
        $data = $request -> all();

        if ($files = $request->file('image')) {
           $destinationPath = 'public/uploads/services/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $service -> image = $profileImage;

           $photo = Service::find($id)->image;
            if(!is_null($photo) && file_exists(public_path('uploads/services/'.$photo))){
                unlink(public_path('uploads/services/'.$photo));
            }

        }

        $service -> name = $data['name'];
        $service -> description = $data['description'];
         try {
         DB::beginTransaction();
            $service -> update();
            DB::commit();
            $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('services');
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
            $service = Service::find($id);
            $service -> delete();
            $image = $service->image;
            if(!is_null($image) && file_exists(public_path('uploads/services/'.$image))){
                unlink(public_path('uploads/services/'.$image));
            }
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('services');
    }
}
