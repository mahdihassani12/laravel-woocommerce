<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     protected function CreateMessages($type=''){
            $message="";
            $className="";
            switch ($type) { 
               
                case 'done':
                    $message=trans("msg.done");
                    $className="successmessages";        
                break;
                case 'not_done':
                    $message=trans("msg.not_done");
                    $className="wrongmessages";        
                break;
				case 'request_sent':
                    $message=trans("msg.request_sent");
                    $className="successmessages";        
                break;
				case 'request_not_sent':
                    $message=trans("msg.request_not_sent");
                    $className="wrongmessages";        
                break;
                case 'waiting_for_accepting':
                    $message=trans("msg.waiting_for_accepting");
                    $className="successmessages";        
                break;


                case 'email_sent':
                    $message=trans("msg.email_sent");
                    $className="successmessages";        
                break;
                

            }
            Session::flash('alert_message',$message); 
            Session::flash('alert_class', $className); 
     }//CreateMessages 

   public function getUserSetting($user_id){
       return DB::table('tbl_setting')->where('id',1)->first();
   }


   public static function checkPermission($role_id,$permission_id){
    return DB::table('role_has_permission')->where('role_id',$role_id)->where('permission_id',$permission_id)->count();
   }
}
