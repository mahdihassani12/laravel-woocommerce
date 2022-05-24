<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Category;
class CategoryController extends Controller
{
       public function index(){
    	$data['active_tab']='pos';
        $data["breadcrumb_level_one"] = trans("labels.categories");
         
        $user_id=Auth::user()->id;
        $data['role_id']=Auth::user()->role_id;
        $data['user_setting']=$this->getUserSetting($user_id);
                 
        if($this::checkPermission($data['role_id'],40)==0){
         return redirect('home')->with(['no_permission'=>trans('msg.no_permission')]);
        }

        $data['category']=Category::all()->sortByDesc('id')->where('status',1);
        return view('pos.categories.view')->withData($data);
    }

    public function add(){
      $user_id=Auth::user()->id;
      $data['user_setting']=$this->getUserSetting($user_id);
      
      return view('pos.categories.partial.create-form')->withData($data);
    }


   public function create(Request $req){
    $user_id=Auth::user()->id;
   try {
    DB::beginTransaction();	
   	
    $category=new Category;
    $category->name=$req->name;
    $category->description=$req->description;
    $category->created_by=$user_id;
    $category->save();
    
   

    DB::commit();
    $this->CreateMessages('done');

    } catch (\Exception $e) {
        DB::rollback();
        $this->CreateMessages('not_done');
        throw $e;
    }

    return view('includes.modal-message'); 
   }



   public function edit(Request $req){
      $id=$req->category_id;
      $data['category']=Category::find($id);
     
      return view('pos.categories.partial.edit-form')->withData($data);
   }

   public function updateCategory(Request $req){
     try {
      DB::beginTransaction();

	   	$id=$req->category_id;
	   	
	    $category=Category::find($id);
	    $category->name=$req->name;
	    $category->description=$req->description;
	    $category->save();
	     
	    DB::commit();
	    $this->CreateMessages('done');

	    } catch (\Exception $e) {
	        DB::rollback();
	        $this->CreateMessages('not_done');
	        throw $e;
	    }

    return view('includes.modal-message'); 
   }
   


   public function delete(Request $req){
   	 $data['category_id']=$req->category_id;
      return view('pos.categories.partial.delete-form')->withData($data);
   }



   public function deleteCategory(Request $req){
     try {
      DB::beginTransaction();	
      	
       $id=$req->category_id;
       $unit=Category::find($id);
       $unit->status=0;
       $unit->save();

       DB::commit();
    $this->CreateMessages('done');
    } catch (\Exception $e) {
        DB::rollback();
        $this->CreateMessages('not_done');
        throw $e;
    }

    return view('includes.modal-message'); 
   }
}
