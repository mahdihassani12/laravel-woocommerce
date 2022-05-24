<?php

namespace App\Http\Controllers\fronted;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;

class UserController extends Controller
{

  function index(){
  	     $data['user']=Auth()->user();
  	     $data['title']=$data['user']->name;
         $data['setting']=$this->getUserSetting(1);
        $data['title2']='';
        
        return view('fronted.user.index')->withData($data);
  }

  public function save(Request $req){

       $id=$req->user_id;
        $st_data['name'] = $req->name;
        $st_data['lastname'] = $req->lastname;
        $st_data['phone'] = $req->phone;
        $st_data['email'] = $req->email; 
        if($req->password){
        	$st_data['password']=Hash::make($req->password);
         }

          $user=new User;
         $user->updateUser($id,$st_data); 
         return 1;
  }
public function Orders(){
		 $data['user']=Auth()->user();
  	     $data['title']=$data['user']->name;
         $data['setting']=$this->getUserSetting(1);
         $data['title2']='';
         $user_id=$data['user']->id;
       
		$orders=DB::table('tbl_orders')->where('user_id',$user_id);
		$data['orders']=$orders->paginate(20);
		
		return view('fronted.user.orders')->withData($data);
}
}