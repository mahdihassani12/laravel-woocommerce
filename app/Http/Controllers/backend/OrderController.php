<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use DB;
class OrderController extends Controller
{
	
	public function index(Request $request){
		$status=$request->status;
		 $data['p_tab']='';
        $data["tab"] = 'order';
        $from_date=$request->from_date;
        $to_date=$request->to_date;
        $data['from_date']=$from_date;

        $data['to_date']=$to_date;
        $data["page_title"] = trans("labels.orders");
        $data['setting']=$this->getUserSetting(1); 
		$orders=DB::table('tbl_orders');

		if($status){
			$orders=$orders->where('status',$status);
		}
		if($from_date){
			$from_date=convertDateToGregorian($from_date);
			$orders=$orders->whereDate('created_at','>=',$from_date);
		}
		if($to_date){
			$to_date=convertDateToGregorian($to_date);
			$orders=$orders->whereDate('created_at','<=',$to_date);
		}
		$data['orders']=$orders->paginate(20);
		$data['status']=$status;
		return view('backend.orders.index')->withData($data);
	}
	
	public function delete($id){
		 try {
        DB::beginTransaction();
       
		DB::table('tbl_orders')->where('id',$id)->delete();

		  DB::commit();
          $this->CreateMessages('done');

        } catch (\Exception $e) {
            DB::rollback();
            $this->CreateMessages('not_done');
            throw $e;
        }
		return redirect()->back();
	}

	public function changeStatus(Request $request){
		$id=$request->id;
		$status=$request->status;

		DB::table('tbl_orders')->where('bill_no',$id)->update(['status'=>$status]);
		//$items=DB::table('tbl_order_items')->where('order_no',$id)->get();
	}
}

?>