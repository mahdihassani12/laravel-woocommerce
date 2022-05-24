<?php

namespace App\Http\Controllers\fronted;
use App\Http\Controllers\Controller;
use App\About;
use App\Contact;
use App\Service;
use App\Download;
use App\Reply;
use Illuminate\Http\Request;

class PageController extends Controller
{

   public function about(){ 
		$data['title']=trans('labels.about_us');
    $data['setting']=$this->getUserSetting(1);
    $data['title2']='';
   	return view('fronted.pages.about')->with('about',About::orderBy('id', 'DESC')->paginate(1))->withData($data);
   }

   public function contact(){
	   $data['title']=trans('labels.contact_us');
      $data['setting']=$this->getUserSetting(1);
      $data['title2']='';
   		return view('fronted.pages.contact')->with('contacts',Contact::orderBy('id', 'DESC')->paginate(1))->withData($data);
   }

   public function services(){
	   $data['title']=trans('labels.services');
      $data['setting']=$this->getUserSetting(1);
      $data['title2']='';
   		return view('fronted.pages.services')->with('services',Service::orderBy('id', 'DESC')->paginate(5))->withData($data);
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
      return view('fronted.pages.view-download')->with('download',Download::find($id))->with('replies',Reply::all())->withData($data);
   }

}
