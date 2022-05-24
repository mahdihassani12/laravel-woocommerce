<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Unit;
class UnitController extends Controller
{
    public function index(){
    	$data['active_tab']='pos';
        $data["breadcrumb_level_one"] = trans("labels.units");
         
        $user_id=Auth::user()->id;
        $data['role_id']=Auth::user()->role_id;
        $data['user_setting']=$this->getUserSetting($user_id);
                 
        if($this::checkPermission($data['role_id'],39)==0){
         return redirect('home')->with(['no_permission'=>trans('msg.no_permission')]);
        }

        $data['unit']=Unit::all()->sortByDesc('id')->where('status',1);
        return view('pos.units.view')->withData($data);
    }

    public function add(){
      $user_id=Auth::user()->id;
      $data['user_setting']=$this->getUserSetting($user_id);
      
      return view('pos.units.partial.create-form')->withData($data);
    }


   public function create(Request $req){
    $user_id=Auth::user()->id;
   try {
    DB::beginTransaction();	
   	
    $unit=new Unit;
    $unit->name=$req->name;
    $unit->created_by=$user_id;
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



   public function edit(Request $req){
      $id=$req->unit_id;
      $data['unit']=Unit::find($id);
     
      return view('pos.units.partial.edit-form')->withData($data);
   }

   public function updateUnit(Request $req){
     try {
      DB::beginTransaction();

	   	$unitId=$req->unit_id;
	   	
	    $unit=Unit::find($unitId);
	    $unit->name=$req->name;
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
   


   public function delete(Request $req){
   	 $data['unit_id']=$req->unit_id;
      return view('pos.units.partial.delete-form')->withData($data);
   }



   public function deleteUnit(Request $req){
     try {
      DB::beginTransaction();	
      	
       $id=$req->unit_id;
       $unit=Unit::find($id);
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
