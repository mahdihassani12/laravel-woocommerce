<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App;
use App\product;
use App\Download;
use App\Post;
use App\Product_Request;
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
    
        return view('backend.home')->withData($data)->with('products',Product::all())->with('downloads',Download::all())->with('posts',Post::all())->with('requests',Product_Request::all());
    }
}
