<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Product extends Model
{
   protected $table="tbl_products";
    protected $fillable =["name","category","unit","created_by"];

    public static function fetchProducts(){
    	return DB::table('tbl_products')
    	       ->leftjoin('tbl_product_unit','tbl_product_unit.id','tbl_products.unit_id')
    	       ->leftjoin('tbl_product_category','tbl_product_category.id','tbl_products.category_id')
    	       ->select('tbl_products.*','tbl_product_unit.name as unitName','tbl_product_category.name as categoryName')
    	       ->paginate(10);
    }
}
