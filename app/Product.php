<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Product extends Model
{
   protected $table="tbl_products";
    protected $fillable =["name","category","unit","created_by"];

   

    public static function fetchProducts($search=null){
    	$products= DB::table('tbl_products')
    	       ->leftjoin('tbl_product_unit','tbl_product_unit.id','tbl_products.unit_id')
    	       ->leftjoin('tbl_product_category','tbl_product_category.id','tbl_products.category_id')
    	       ->select('tbl_products.*','tbl_product_unit.name as unitName','tbl_product_category.name as categoryName')
    	       ->orderBy('tbl_products.id', 'DESC');
               if($search!=null){
                  $products=$products->where('tbl_products.name','like','%'.$search.'%')->orWhere('tbl_products.short_desc','like','%'.$search.'%')->orWhere('tbl_products.long_desc','like','%'.$search.'%')->orWhere('tbl_products.product_code',$search);
               }
    	      return $products->paginate(10);
    }
}
