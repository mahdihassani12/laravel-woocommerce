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
        $data['description']=$request->description; 
        $data['phone']=$request->phone; 
        $data['address']=$request->address; 
        $data['currency']=$request->currency;
        $data['bank_number']=$request->bank_number;
        $data['email']=$request->email;
        $data['facebook']=$request->facebook;
        $data['twitter']=$request->twitter;
        $data['instagram']=$request->instagram;
        $data['telegram']=$request->telegram;
        $data['youtube']=$request->youtube;
        $data['wechat']=$request->wechat;
        $data['imo']=$request->imo;
        $data['whatsapp']=$request->whatsapp;
       
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

    public function ads(){
         $data['p_tab']='';
        $data["tab"] = 'ads';
        $data["page_title"] = trans("labels.ads");
        $data['setting']=$this->getUserSetting(1);
        $data['note']=DB::table('tbl_note')->where('id',1)->get()[0];
        return view('backend.setting.ads')->withData($data);
    }



  public function adsUpdate(Request $request){
       $data['text']=$request->text;
       $data['title1']=$request->title1;
       $data['description1']=$request->description1;
	   $data['title2']=$request->title2;
       $data['description2']=$request->description2;
	   $data['title3']=$request->title3;
       $data['description3']=$request->description3;
	   $data['title4']=$request->title4;
       $data['description4']=$request->description4;	
       $data['note']=DB::table('tbl_note')->where('id',1)->update($data);
       return redirect('ads');
  }
}
