<?php

namespace App\Http\Controllers\fronted;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cart;
use DB;
use Auth;
class CartController extends Controller
{
   public function addToCart(Request $request){
      $name=$request->name;
      $id=$request->id;
      $price=$request->price;
      $qty=$request->qty;
      $image=$request->image;
      
         Cart::add($id, $name, $qty, $price, $price*$qty,['image' => $image]);
      
      //check if more quantity
      $data['cart']=Cart::content();
      foreach($data['cart'] as $ct){
      	$cartProductId=$ct->id; 
      	$product=DB::table('tbl_products')->where('id',$cartProductId)->first();
      	$product_price_qty=$product->more_price;
  if($product_price_qty!=""):
      	$rowId=$ct->rowId; 
      	$cartQty=$ct->qty;
      	$updatedPrice=$product->price;
        
        $product_price_qty=explode(",", $product_price_qty);
        foreach($product_price_qty as $pricQty){
        	$procutPrice=explode(":", $pricQty)[0];
        	$productQty=explode(":", $pricQty)[1];
        	//echo $cartQty.' > '.$productQty;
        	if($cartQty>=$productQty){
        		$updatedPrice=$procutPrice;
        		//echo $cartQty;
        	}

        }
    Cart::update($rowId, ['price' => $updatedPrice]);
    endif;
       // echo $updatedPrice;exit();
      	
      }
     return Cart::count();
   }
   public function cartModelItem(){
      $data['setting']=$this->getUserSetting(1);
   	 $data['cart']=Cart::content();
   	 
   	 return view('fronted.cart.cart-dropdown')->withData($data);
   }

   public function Cart(){
   	 $data['title']=trans('labels.cart');
     $data['setting']=$this->getUserSetting(1);
     $data['title2']='';
     $data['cart']=Cart::content();
   	 return view('fronted.cart.cart_page')->withData($data);   
   }

   public function removeFromCart(Request $request){
   	  $id=$request->id; 
   	  Cart::remove($id);

   	  return 1;
   }

   public function updateCart(Request $request){
   	 $rowid=$request->rowid;
   	 $qty=$request->quantity;
   	 for($i=0; $i<count($rowid); $i++){
   	 	Cart::update($rowid[$i], $qty[$i]);
   	 }


        //check if more quantity
      $data['cart']=Cart::content();
      foreach($data['cart'] as $ct){
        $cartProductId=$ct->id; 
        $product=DB::table('tbl_products')->where('id',$cartProductId)->first();
        $product_price_qty=$product->more_price;
  if($product_price_qty!=""):
        $rowId=$ct->rowId; 
        $cartQty=$ct->qty;
        $updatedPrice=$product->price;
        
        $product_price_qty=explode(",", $product_price_qty);
        foreach($product_price_qty as $pricQty){
          $procutPrice=explode(":", $pricQty)[0];
          $productQty=explode(":", $pricQty)[1];
          //echo $cartQty.' > '.$productQty;
          if($cartQty>=$productQty){
            $updatedPrice=$procutPrice;
            //echo $cartQty;
          }

        }
    Cart::update($rowId, ['price' => $updatedPrice]);
    endif;
       // echo $updatedPrice;exit();
        
      }

   	 return redirect()->back();
   }

   public function checkout(){
       $data['title']=trans('labels.checkout');
       $data['setting']=$this->getUserSetting(1);
       $data['title2']='';
       $data['cart']=Cart::content();
   	 return view('fronted.cart.checkout_form')->withData($data);  
   }

   public function updateCheckout(Request $request){

   	  $this->validate($request,[
            'firstname' => 'required',
            'lastname' => 'required',
            'telephone' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'bank_bill' => 'required|mimes:jpg,jpeg,pdf,png,gif',
        ]);

       $orders=DB::table('tbl_orders')->orderBy('id','DESC')->get();
       if(count($orders)>0){
          $billno=$orders[0]->bill_no+1;
       }
       else{
       	  $billno=1201;
       }
       $image_name='';
       if ($request->hasFile('bank_bill')){ 
            $ext = $request->bank_bill->getClientOriginalExtension();
            $image_name = date('mis').uniqid().".".$ext; 
            $file = $request->file('bank_bill');
            $destinationPath = public_path("uploads/bank_bill");
            $file->move($destinationPath, $image_name); 
            
          }
      if(Auth::check()){ $user_id=Auth::user()->id; }else{ $user_id=null; }    
      $order_key=bcrypt($billno); 
      $total=Cart::subtotal();
      $total=str_replace(",", "", $total);
   	  $data['name']=$request->firstname;
   	  $data['last_name']=$request->lastname;
   	  $data['phone']=$request->telephone;
   	  $data['email']=$request->email;
   	  $data['address1']=$request->address_1;
   	  $data['address2']=$request->address_2;
   	  $data['city']=$request->city;
   	  $data['company']=$request->company;
   	  $data['bank_bill']=$image_name;
   	  $data['bank_name']=$request->bank_name;
   	  $data['bill_no']=$billno;
      $data['order_key']=$order_key;
   	  $data['note']=$request->comments;
   	  $data['total']=$total;
   	  $data['discount']=0;
   	  $data['paid']=$total;
      $data['user_id']=$user_id;

    DB::table('tbl_orders')->insert($data);
    $cartItems=Cart::content();
    foreach($cartItems as $itm):
       $itdata['order_no']=$billno;
       $itdata['item_id']=$itm->id;
       $itdata['qty']=$itm->qty;
       $itdata['price']=$itm->price;
       $itdata['total']=$itm->price*$itm->qty;
        DB::table('tbl_order_items')->insert($itdata);
    endforeach; 	

    Cart::destroy();

    return redirect('order/success?key='.$order_key);
   }

   public function orderSent(Request $request){
     $id=$request->key; 
     $data['title']=trans('labels.sent_success');
     $data['setting']=$this->getUserSetting(1);
     $data['title2']='';
     $orders=DB::table('tbl_orders')->where('order_key',$id)->get();
     $data['wrong_key']=0;
     if(count($orders)<=0){
        $data['wrong_key']=1;
     }
     else{
      $order_no=$orders[0]->bill_no;
     $data['order']=DB::table('tbl_orders')->where('order_key',$id)->first();
     $data['item']=DB::table('tbl_order_items')->join('tbl_products','tbl_products.id','tbl_order_items.item_id')->where('tbl_order_items.order_no',$order_no)->select('tbl_order_items.*','tbl_products.name as productName','tbl_products.feature_image')->get();
     }
      return view('fronted.cart.ordersent')->withData($data);
   }
}
