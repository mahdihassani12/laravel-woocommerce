<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App;
use App\Product;
use App\Download;
use App\Post;
use App\Product_Request;
use DB;
use \Morilog\Jalali\Jalalian;
use \Morilog\Jalali\CalendarUtils;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function changeLanguage($lang){
        App::setLocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }
    public function index()
    {
        $data['p_tab']='';
        $data["tab"] = 'home';
        $data["page_title"] = trans("labels.home");
        $data['setting']=$this->getUserSetting(1);
       
        $today= DB::table('tbl_visitors')->whereDate('created_at','>=',date('Y-m-d'));
        $all= DB::table('tbl_visitors');
       
        $data['todayVisits']=$today->sum('visits');
        $data['todayVisitors']=$today->sum('visitor');
       
        $data['allVisits']=$all->sum('visits');
        $data['allVisitors']=$all->sum('visitor');


        $startDate=date('Y-m-d');
        $endDate=date('Y-m-d');
        $today=date('Y-m-d');
        $newDate=explode('-',$today);
        $year=$newDate[0];
        $month=$newDate[1];
        $day=$newDate[2];

        $jdate=CalendarUtils::toJalali($year, $month, $day);
        $checkSaturday = (new Jalalian($jdate[0],$jdate[1],$jdate[2]))->isSaturday();

       $mstartDate=CalendarUtils::toGregorian($jdate[0],$jdate[1],1);
       $mstartDate=$mstartDate[0].'-'.$mstartDate[1].'-'.$mstartDate[2];
       $mendDate=date('Y-m-d');
        
        
        if($checkSaturday!=1){
         $sdate = Jalalian::forge('last saturday')->format("Y-m-d");
         $condate=explode("-",$sdate);
         $startDate=CalendarUtils::toGregorian($condate[0],$condate[1],$condate[2]);
         $startDate= $startDate[0].'-'.$startDate[1].'-'.$startDate[2];
         
       }
        
        $week= DB::table('tbl_visitors')->whereDate('created_at','>=',$startDate)->whereDate('created_at','<=',$endDate);
        $month= DB::table('tbl_visitors')->whereDate('created_at','>=',$mstartDate)->whereDate('created_at','<=',$mendDate);
       
        $data['weekVisits']=$week->sum('visits');
        $data['weekVisitors']=$week->sum('visitor');
       
        $data['monthVisits']=$month->sum('visits');
        $data['monthVisitors']=$month->sum('visitor');
		
        $data['orders']=DB::table('tbl_orders')->orderBy('id','DESC')->limit(8)->get();
        return view('backend.home')->withData($data)->with('products',Product::all())->with('downloads',Download::all())->with('posts',Post::all())->with('requests',Product_Request::all());
    }
}
