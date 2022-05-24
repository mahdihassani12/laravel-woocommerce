<?php

namespace App\Http\Controllers\fronted;
use App\Http\Controllers\Controller;
use App\About;
use App\Contact;
use App\Service;
use App\Download;
use App\Learning;
use App\Reply;
use Mail;
use DB;
use Illuminate\Http\Request;

class PageController extends Controller
{

   public function about(){ 
		$data['title']=trans('labels.about_us');
         $data['setting']=$this->getUserSetting(1);
        $data['title2']='';
   		return view('fronted.pages.about')->with('about',About::orderBy('id', 'ASC')->paginate(1))->withData($data);
   }

   public function contact(){
	   $data['title']=trans('labels.contact_us');
         $data['setting']=$this->getUserSetting(1);
        $data['title2']='';
   		return view('fronted.pages.contact')->with('contacts',Contact::orderBy('id', 'ASC')->paginate(1))->withData($data);
   }

   public function sendEmail(Request $request){

           $this->validate($request,[
            'firstName' => 'required',
            'lastName' => 'required',
            'message' => 'required',
            'subject' => 'required',
          ]);


                   $emailData['name']=$request->firstName;
                   $emailData['lastname']=$request->lastName;
                    $emailData['email']=$request->email;
                    $emailData['subject']= $request->subject;
                    $emailData['content_message']=$request->message;
                  
                  //sprint_r($emailData);exit();
         
         try {
       DB::beginTransaction();  
          

               Mail::send('mail', $emailData, function($message) use($emailData)
               {
                $message->to('jumahmk2020@gmail.com', 'دوستان   لایت')->subject($emailData['subject']);
              });


       DB::commit();
        $this->CreateMessages('email_sent');
        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('request_not_sent');
            throw $e;
        }
        

     
     return redirect()->back();
   }
   public function services(){
	   $data['title']=trans('labels.services');
         $data['setting']=$this->getUserSetting(1);
        $data['title2']='';
   		return view('fronted.pages.services')->with('services',Service::orderBy('id', 'DESC')->paginate(10))->withData($data);
   }

   public function product_request(){
	   $data['title']=trans('labels.request_product');
         $data['setting']=$this->getUserSetting(1);
        $data['title2']='';
   		return view('fronted.pages.product_request')->withData($data);
   }

   public function download(){
	   $data['title']=trans('labels.downloads');
         $data['setting']=$this->getUserSetting(1);
        $data['title2']='';
      return view('fronted.pages.downloads')->with('downloads',Download::orderBy('id', 'DESC')->paginate(10))->withData($data);
   }

   public function view_download(Request $request){
	   $id=$request->id;
	   $name=$request->download;
	   $data['title']=trans('labels.request_product');
         $data['setting']=$this->getUserSetting(1);
        $data['title2']=$name;

    $data['related']=Download::where('id','!=',$id)->limit(4)->get();

      return view('fronted.pages.view-download')->with('download',Download::find($id))->with('replies',Reply::all())->withData($data);
   }

    public function learning(){
     $data['title']=trans('labels.learning');
     $data['setting']=$this->getUserSetting(1);
     $data['title2']='';
     
      return view('fronted.pages.learning')->with('learning',Learning::orderBy('id', 'DESC')->paginate(10))->withData($data);
   }

   public function learning_single(Request $request){
     $id=$request->id;
     $name=$request->learning;
     $data['title']=trans('labels.learning');
     $data['setting']=$this->getUserSetting(1);
     $data['title2']=$name;
      $data['related']=Learning::where('id','!=',$id)->limit(4)->get();
    
      return view('fronted.pages.learning_single')->with('learning',Learning::find($id))->with('replies',Reply::all())->withData($data);
   }

}
