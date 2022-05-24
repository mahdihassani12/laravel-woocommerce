<?php

namespace App\Http\Controllers\fronted;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Download;
use App\Post;
use App\Product;
use App\ProductCategory;
use App\Slider;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

  

    public function index()
    {

        $data['title']=trans('labels.home');
        $data['setting']=$this->getUserSetting(1);
        return view('fronted.home.index')->withData($data)->with('sliders',Slider::all());
    
    }
}
