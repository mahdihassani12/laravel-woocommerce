<?php

namespace App\Http\Controllers\backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB; 
use Auth;
class SettingController extends Controller
{
    
    public function index(){
         $data['p_tab']='';
        $data["tab"] = 'setting';
        $data["page_title"] = trans("labels.settings");
        $data['setting']=$this->getUserSetting(1);

        return view('backend.setting.setting')->withData($data);
    }

    public function updateSetting(Request $request){
        $user_id=Auth::user()->id;
        $data['id']=1; 
        $data['app_name']=$request->app_name; 
        $data['phone']=$request->phone; 
        $data['address']=$request->address; 
        $data['currency']=$request->currency;
       
        if ($request->hasFile('logo')){ 
            $ext = $request->logo->getClientOriginalExtension();
            $image_name = 'app_logo'.".".$ext; 
            $file = $request->file('logo');
            $destinationPath = public_path("icons");
            $file->move($destinationPath, $image_name); 
            $photo=$image_name;
            $data['logo']=$photo; 
        }

      $setting=DB::table('tbl_setting')->where('id',1)->get();
       if(count($setting)>0){
        $setting=DB::table('tbl_setting')->where('id',1)->update($data); 
       }
       else{
        $setting=DB::table('tbl_setting')->insert($data); 
       }
      return redirect('settings');
    }
}
