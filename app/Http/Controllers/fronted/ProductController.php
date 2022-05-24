<?php

namespace App\Http\Controllers\fronted;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;


use App\ProductCategory;
use DB;
class ProductController extends Controller
{
 
 public function index(Request $request){
    $category_id=$request->category_id;
    $search=$request->search;
    $data['title']=trans('labels.store');
    $data['setting']=$this->getUserSetting(1);
    $data['title2']='';

    $data['category']=ProductCategory::all();
    $product=DB::table('tbl_products')
        ->leftjoin('tbl_product_category','tbl_product_category.id','tbl_products.category_id'); 
   if($category_id){
      $product=$product->where('tbl_product_category.id',$category_id)->orWhere('tbl_product_category.parent_id',$category_id)->orWhere('tbl_product_category.parent_parent_id',$category_id);

      $data['title2']=ProductCategory::find($category_id)->name; 
   }
   if($search){
   	  $data['title2']=$search;
   	 $product=$product->where('tbl_products.name','like','%'.$search.'%')->orWhere('tbl_products.short_desc','like','%'.$search.'%')->orWhere('tbl_products.long_desc','like','%'.$search.'%')->orWhere('tbl_products.product_code',$search);
   }
   $product=$product->select('tbl_products.*')->orderBy('tbl_products.id','DESC')->paginate(10);

    $data['product']=$product; 
 
 	return view('fronted.product.index')->withData($data);
 }  

  public function singleProduct(Request $request){
    $id=$request->id; 
    $name=$request->name; 
    $data['title']=trans('labels.product');
    $data['setting']=$this->getUserSetting(1);
    $data['title2']=$name;
    $data['product']=DB::table('tbl_products')
                     ->leftjoin('tbl_product_category','tbl_product_category.id','tbl_products.category_id')
                     ->leftjoin('tbl_product_unit','tbl_product_unit.id','tbl_products.unit_id')
                       ->where('tbl_products.id',$id)
                       ->select('tbl_products.*','tbl_product_category.name as catName','tbl_product_unit.name as unitName')->first();
     $data['comments']=DB::table('tbl_comments')->where('product_id',$id)->where('status',1)->get();
     $data['more_product']=DB::table('tbl_products')->where('id','!=',$id)->limit(8)->get();
    return view('fronted.product.single')->withData($data);
  }

}
