@extends('fronted.layout.app')
   @section('main_content')
      <div class="container">
      
      <div class="row">
        <!--Left Part Start -->
        <aside id="column-left" class="col-sm-3 hidden-xs">
           @include('fronted.includes.right-sidebar')  
        </aside>
        <!--Left Part End -->
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <h1 class="title"> {{$data['title']}}  @if(isset($data['title2']) and $data['title2']!='') &nbsp;<span class="fa fa-angle-left"></span> &nbsp;{{$data['title2']}} @endif </h1>
          
          <div class="product-filter">
            <div class="row">

              <div class="col-md-4 col-sm-5">
                <div class="btn-group">
                  <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                  <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                </div>
                </div>
              <div class="col-sm-2 text-right" style="display: none">
                <label class="control-label" for="input-sort">{{trans('labels.sort_by')}}:</label>
              </div>

              <div class="col-md-3 col-sm-2 text-right" style="display: none">
                <select id="input-sort" class="form-control" name="sort">
                   <option value="" selected="selected">پیشفرض</option>
                  <option value="">نام (الف - ی)</option>
                  <option value="">نام (ی - الف)</option>
                  <option value="">قیمت (کم به زیاد)</option>
                  <option value="">قیمت (زیاد به کم)</option>
                </select>
              </div>

              <div class="col-sm-1 text-right" style="display: none">
                <label class="control-label" for="input-limit">نمایش :</label>
              </div>

              <div class="col-sm-2 text-right" style="display: none">
                <select id="input-limit" class="form-control">
                  <option value="" selected="selected">20</option>
                  <option value="">25</option>
                  <option value="">50</option>
                  <option value="">75</option>
                  <option value="">100</option>
                </select>
              </div>

            </div>
          </div>

          <br />
          <div class="row products-category">
           @foreach($data['product'] as $product) 
            <div class="product-layout product-list col-xs-12" >
              <div class="product-thumb">
                <div class="image"><a href="{{asset('product?id='.$product->id.'&name='.$product->name)}}"><img src="{{asset('public/uploads/products')}}/{{$product->feature_image}}" alt="{{$product->name}}" title="{{$product->name}}" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="{{asset('product?id='.$product->id.'&name='.$product->name)}}">{{$product->name}}</a></h4>
                    <p class="description"> {{$product->short_desc}}</p>
                    <div class="price"> <div style="padding:12px;"> <span class="price-new"> {{$product->price}} {{$data['setting']->currency}}</span> <span class="price-old">{{$product->old_price}} </span> </div>
                     @if($product->old_price) <span class="saving">{{trans('labels.discount')}}</span> @endif 
                      <div class="price-tax">
                      <table class="table price-tax more_price" style="font-size:17px;">
                        
                      <tr><th>{{trans('labels.qty')}}</th><th>{{trans('labels.price')}}</th></tr> 
                        
                      <?php  $morePrice= explode(",", $product->more_price);
                      $i=0;
					  echo '<tr product_qty="1" product_price="'.$product->price.'" class="product_qty1"><td>1 <span class="fa fa-plus"></span></td><td>'.$product->price.'</td></tr>';
                        if($product->more_price!=""):
						foreach ($morePrice as $mp) {
                          $price=explode(":", $mp)[0];
                          $qty=explode(":", $mp)[1];

                          if($i==count($morePrice)-1){
                            $endqty='&#8734;';
                         } 
                         else{
                          $endqty=explode(":", $morePrice[$i+1])[1]-1;
                         }
                          echo '<tr product_qty="'.$qty.'" product_price="'.$price.'" class="product_qty'.$qty.'"><td>'.$qty.' <span class="fa fa-plus"></span></td><td>'.$price.'</td></tr>';
                          $i++;
                        } 
                        endif;						
                       ?>
                       
                       </table>
					   <div class="qty store_page_qty">
					   <label class="control-label" for="input-quantity">{{trans('labels.qty')}}</label>
					   <input type="number" class="add_to_cart_qty input-quantity" value="1" min="1">
                        <a class="qtyBtn plus change_qty"  onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</a><br />
                        <a class="qtyBtn mines change_qty" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</a>
					   </div>
					  </div>
                    </div>
                  </div>
                  <div class="button-group">
				    
                    <button style="height:43px;" class="btn-primary add_item_to_cart" type="button" p_id="{{$product->id}}" price="{{$product->price}}" p_name="{{$product->name}}" image="{{$product->feature_image}}"><span>{{trans('labels.add_to_cart')}}  </span></button>
                  </div>
                </div>
              </div>
            </div>
           @endforeach
            <div class="col-xs-12">
                {{$data['product']->appends(request()->input())->links()}} 
            </div>
           </div> 
          </div>
        </div>
        <!--Middle Part End -->
      </div>
   
   @endsection
   @section('script')
   <script type="text/javascript">
      
	      $( ".change_qty" ).bind( "click", function() {
            $(this).parents('.store_page_qty').find('input.add_to_cart_qty').trigger('change');
          });


       $(document).on("change",".add_to_cart_qty",function(){
		   
               var qty=$(this).val();
               var active_qty='';
			   var active_product=$(this).parents('.product-layout');
			   var addToCartBTN=$(this).parents('.product-layout').find('.add_item_to_cart');
               //addToCartBTN.attr("product_price",1222);
			   
			   $(this).parents('.product-layout').find(".more_price tr").each(function(){
                 if(parseInt(qty)>=parseInt($(this).attr('product_qty'))){
                   active_qty=parseInt($(this).attr('product_qty'));
                   var active_price=parseInt($(this).attr('product_price'));
                   addToCartBTN.attr("price",active_price);
                 }
                  active_product.find('table.more_price tr').removeClass('active_price_row');
                  active_product.find("table.more_price .product_qty"+active_qty).addClass('active_price_row');
               })
			   
          });
		  
       $(document).on("click",".add_item_to_cart",function(){
         var name=$(this).attr("p_name");
         var price=$(this).attr("price");
         var id=$(this).attr("p_id");
         var image=$(this).attr("image");
         var qty=$(this).parents(".product-layout").find(".add_to_cart_qty").val(); 
         var loader=$(".page_loader");
         loader.show();
         $.ajax({
          type:'get',
          url:APP_URL+'/cart/add_to_cart?id='+id+'&name='+name+'&price='+price+'&qty='+qty+'&image='+image,
          success:function(resource){
             $("#cart-total b").text(resource);
             loader.hide();
          }
         })
       })
   </script>
   @endsection