<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Learning;
use DB;

class LearningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data['p_tab']='';
        $data["tab"] = 'learning';
        $data["page_title"] = trans("labels.learning");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.learning.index')->with('learning',Learning::orderBy('id', 'DESC')->paginate(10))->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['p_tab']='';
        $data["tab"] = 'learning';
        $data["page_title"] = trans("labels.add_new_learning");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.learning.create')->withData($data);
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
            'excerpt' => 'required',
            'description' => 'required',
            'file' => 'file|mimes:zip,rar,pdf,mp4,avi,mp3|max:307200',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:1024',
            
        ]);

        $learning = new Learning();
        $data = $request -> all();

        
        $size=null;
        $file=null;
        $image=null;
        if ($files = $request->file('file')) {
           $uploaded_file = $request->file('file');
           $size = $uploaded_file->getSize();
         
           $destinationPath = 'public/uploads/learning_files/'; // upload path
           $file = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $file);
           $file = "$file";
        }

      if ($images = $request->file('image')) {
           $destinationPath = 'public/uploads/learning_images/'; // upload path
           $image = date('YmdHis') . "." . $images->getClientOriginalExtension();
           $images->move($destinationPath, $image);
           $image = "$image";
        }

        $learning->title = $data['title'];
        $learning->excerpt = $data['excerpt'];
        $learning->description = $data['description'];
        $learning->size = $size;
        $learning->file = $file;
        $learning->feature_image = $image;
     try {
         DB::beginTransaction(); 
        $learning -> save();
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('learnings');

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
        $data["tab"] = 'learning';
        $data["page_title"] = trans("labels.learning");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.learning.edit')->with('learning',Learning::find($id))->withData($data);
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
            'excerpt' => 'required',
            'description' => 'required',
            'file' => 'file|mimes:zip,rar,pdf,mp4,avi,mp3|max:307200',
            'image' => 'image|mimes:jpg,jpeg,png,svg,gif|max:1024',

        ]);

        $learning = Learning::find($id);
        $data = $request -> all();

        if ($files = $request->file('file')) {

            $size = $files->getSize();
            $learning -> size = $size;

           $destinationPath = 'public/uploads/learning_files/'; // upload path
           $file = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $file);
           $file = "$file";
           $learning -> file = $file;

           $file = Learning::find($id)->file;
            if(!is_null($file) && $file != "" && file_exists(public_path('uploads/learning_files/'.$file))){
                unlink(public_path('uploads/learning_files/'.$file));
            }
  
        }

        if ($images = $request->file('image')) {

           $destinationPath = 'public/uploads/learning_images/'; // upload path
           $image = date('YmdHis') . "." . $images->getClientOriginalExtension();
           $images->move($destinationPath, $image);
           $image = "$image";
           $learning -> feature_image = $image;

           $image = Learning::find($id)->feature_image;
            if(!is_null($image) && $image!="" && file_exists(public_path('uploads/learning_images/'.$image))){
                unlink(public_path('uploads/learning_images/'.$image));
            }
  
        }

        $learning->title = $data['title'];
        $learning->description = $data['description'];
     try {
         DB::beginTransaction(); 
        $learning -> update();
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('learnings');
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
            $learning = Learning::find($id);
            $learning -> delete();
            $file=$learning->file;
            if(!is_null($file) && $file!="" && file_exists(public_path('uploads/learning_files/'.$file))){
                unlink(public_path('uploads/learning_files/'.$file));
            }
            $image=$learning->feature_image;
            if(!is_null($image) && $image!="" && file_exists(public_path('uploads/learning_images/'.$image))){
                unlink(public_path('uploads/learning_images/'.$image));
            }
        DB::commit();
        $this->CreateMessages('done');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
        
        return redirect('learnings');
    }
}
