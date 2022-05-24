<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Download;
use DB;

class downloadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data['p_tab']='';
        $data["tab"] = 'download';
        $data["page_title"] = trans("labels.downloads");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.downloads.index')->with('downloads',Download::orderBy('id', 'DESC')->paginate(10))->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['p_tab']='';
        $data["tab"] = 'download';
        $data["page_title"] = trans("labels.add_new_download");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.downloads.create')->withData($data);
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
            'file' => 'required|file|mimes:exe,zip,rar,pdf|max:102400',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:1024',
            'description' => 'required'
        ]);

        $download = new Download();
        $data = $request -> all();

        $uploaded_file = $request->file('file');
        $size = $uploaded_file->getSize();

        if ($files = $request->file('file')) {
           $destinationPath = 'public/uploads/files/'; // upload path
           $file = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $file);
           $file = "$file";
        }

      if ($images = $request->file('image')) {
           $destinationPath = 'public/uploads/files_image/'; // upload path
           $image = date('YmdHis') . "." . $images->getClientOriginalExtension();
           $images->move($destinationPath, $image);
           $image = "$image";
        }

        $download -> name = $data['name'];
        $download -> description = $data['description'];
        $download -> size = $size;
        $download -> file = $file;
        $download -> price = $data['price'];
        $download -> image = $image;
     try {
         DB::beginTransaction(); 
        $download -> save();
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('downloads');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.downloads.show')->with('download',Download::find($id));
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
        $data["tab"] = 'download';
        $data["page_title"] = trans("labels.download_editing");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.downloads.edit')->with('download',Download::find($id))->withData($data);
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
            'file' => 'file|mimes:exe,zip,rar,pdf|max:102400',
            'description' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg,gif|max:1024'
        ]);

        $download = Download::find($id);
        $data = $request -> all();

        if ($files = $request->file('file')) {

            $size = $files->getSize();
            $download -> size = $size;

           $destinationPath = 'public/uploads/files/'; // upload path
           $file = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $file);
           $file = "$file";
           $download -> file = $file;

           $file = Download::find($id)->file;
            if(!is_null($file) && file_exists(public_path('uploads/files/'.$file))){
                unlink(public_path('uploads/files/'.$file));
            }
  
        }

        if ($images = $request->file('image')) {

           $destinationPath = 'public/uploads/files_image/'; // upload path
           $image = date('YmdHis') . "." . $images->getClientOriginalExtension();
           $images->move($destinationPath, $image);
           $image = "$image";
           $download -> image = $image;

           $image = Download::find($id)->image;
            if(!is_null($image) && file_exists(public_path('uploads/files_image/'.$image))){
                unlink(public_path('uploads/files_image/'.$image));
            }
  
        }

        $download -> name = $data['name'];
        $download -> description = $data['description'];
     try {
         DB::beginTransaction(); 
        $download -> update();
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('downloads');
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
            $download = Download::find($id);
            $download -> delete();
            $file=$download->file;
            if(!is_null($file) && file_exists(public_path('uploads/files/'.$file))){
                unlink(public_path('uploads/files/'.$file));
            }
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('downloads');
    }
}
