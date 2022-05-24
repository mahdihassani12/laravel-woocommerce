<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
use DB;
use Hash;
class userController extends Controller
{
    public function profile(Request $req){
    	
        $data['p_tab']='user';
        $data["tab"] = 'user';
        $data["page_title"] = trans("labels.users");
        $data['setting']=$this->getUserSetting(1);

        
        
        $id=$req->id;
        $data['user']=User::find($id);
        return view('user.profile')->withData($data);
    }

    public function index(){
         
        $data['p_tab']='user';
        $data["tab"] = 'user';
        $data["page_title"] = trans("labels.users");
        $data['setting']=$this->getUserSetting(1);


    	  $data['users']=User::orderBy('id', 'DESC')->paginate(10);
        return view('backend.user.index')->withData($data);
    }

    public function add(){
        $data['p_tab']='user';
        $data["tab"] = 'add_user';
        $data["page_title"] = trans("labels.add_user");
        $data['setting']=$this->getUserSetting(1);

      return view('backend.user.partial.create-form')->withData($data);
    }

    public function create(Request $req){
       
       $array = array(  
            'name'  => 'required',    
            'email'  => 'required|email|unique:tbl_users',    
            'password'  => 'required|same:conf_password',  
            'conf_password'  => 'required',     
            'photo'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',     
        ); 
        $this->validate($req, $array);



        $st_data['name'] = $req->name;
        $st_data['lastname'] = $req->lastname;
        $st_data['phone'] = $req->phone;
        $st_data['email'] = $req->email; 
        $st_data['password'] =Hash::make($req->password);
        $st_data['photo'] = 'default.png';
        $st_data['role_id'] =1;

          if ($req->hasFile('photo')){ 
            $ext = $req->photo->getClientOriginalExtension();
            $image_name = uniqid().".".$ext; 
            $file = $req->file('photo');
            $destinationPath = public_path("uploads/users");
            $file->move($destinationPath, $image_name); 
            $photo=$image_name;
            $st_data['photo']=$photo; 
        } 
       try {
            DB::beginTransaction();
            $user=new User;
            $user->insert($st_data);

            DB::commit();
          $this->CreateMessages('done');

        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }

      return redirect('users');
    }

    public function edit(Request $req){
       $uid=$req->user_id;
      
      $data['user']=User::find($uid);
      $data['p_tab']='user';
        $data["tab"] = 'user';
        $data["page_title"] = trans("labels.users");
        $data['setting']=$this->getUserSetting(1);
      return view('backend.user.partial.edit-form')->withData($data);
    }

    public function updateUser(Request $req){
       
        $array = array(  
            'name'  => 'required',    
            'email'  => 'required|email',    
            'password'  => 'same:conf_password',       
            'photo'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',     
        ); 
        $this->validate($req, $array);

        $id=$req->user_id;
        $st_data['name'] = $req->name;
        $st_data['lastname'] = $req->lastname;
        $st_data['phone'] = $req->phone;
        $st_data['email'] = $req->email; 
        $st_data['role_id'] =$req->role;
        //$st_data['password'] = $req->password;
       // $st_data['photo'] = 'default.png';

          if ($req->hasFile('photo')){ 
            $ext = $req->photo->getClientOriginalExtension();
            $image_name = uniqid().".".$ext; 
            $file = $req->file('photo');
            $destinationPath = public_path("uploads/users");
            $file->move($destinationPath, $image_name); 
            $photo=$image_name;
            $st_data['photo']=$photo; 
          }
         if($req->password){
        	$st_data['password']=Hash::make($req->password);
         }   
       try {
            DB::beginTransaction();
            $user=new User;
            $user->updateUser($id,$st_data);

            DB::commit();
          $this->CreateMessages('done');

        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
     return redirect('users');
    }

  

    public function delete(Request $req){
      $uid =$req->user_id;
      try {
        DB::beginTransaction();
        $photo=User::find($uid)->photo;
        if($photo!='default.png'){
    	if(!is_null($photo) && file_exists(public_path('uploads/users/'.$photo))){
            unlink(public_path('uploads/users/'.$photo));
		    }
		 }  

	
        $res=User::where('id',$uid)->delete();

          DB::commit();
          $this->CreateMessages('done');

        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
     return redirect('users');

    }
}
