@extends('fronted.layout.app')
   @section('main_content')  

        <div class="container">
     
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <div itemscope itemtype="http://schema.org/محصولات">
            <h1 class="title" itemprop="name">{{$data['product']->name}}</h1>
            <div class="row product-info">
              <div class="col-sm-6">
                <div class="image"><img class="img-responsive" itemprop="image" id="zoom_01" src="{{asset('public/uploads/products')}}/{{$data['product']->feature_image}}" title="{{$data['product']->name}}" alt="{{$data['product']->name}}" data-zoom-image="{{asset('public/uploads/products')}}/{{$data['product']->feature_image}}" /> </div>
                <div class="center-block text-center"><span class="zoom-gallery"><i class="fa fa-search"></i> {{trans('labels.click_to_see_gallery')}}</span></div>
                <div class="image-additional" id="gallery_01"> 
				  
				  <a class="thumbnail" href="#" data-zoom-image="{{asset('public/uploads/products')}}/{{$data['product']->feature_image}}" data-image="{{asset('public/uploads/products')}}/{{$data['product']->feature_image}}" title="{{$data['product']->name}}"> 
                       <img src="{{asset('public/uploads/products')}}/{{$data['product']->feature_image}}" title="{{$data['product']->name}}" alt = "{{$data['product']->name}}"/>
				  </a> 
						  
                    <?php 
                      if($data['product']->gallery!=null):
                       $gallery=explode('|',$data['product']->gallery);
                       foreach($gallery as $gl):
                          ?>
                        
                        <a class="thumbnail" href="#" data-zoom-image="{{asset('public/uploads/gallery')}}/{{$gl}}" data-image="{{asset('public/uploads/gallery')}}/{{$gl}}" title="{{$data['product']->name}}"> 
                          <img src="{{asset('public/uploads/gallery')}}/{{$gl}}" title="{{$data['product']->name}}" alt = "{{$data['product']->name}}"/></a> 

                           <?php    
                             endforeach;
                           endif;   
                         ?>
                  </div>
              </div>
              <div class="col-sm-6">
                <ul class="list-unstyled description" style="font">
                  <li><b>{{trans('labels.category')}} :</b> <a href="#"><span itemprop="brand">{{$data['product']->catName}}</span></a></li>
                  <li style="display:none"><b>{{trans('labels.unit')}} :</b> <a href="#"><span itemprop="brand" >{{$data['product']->unitName}}</span></a></li>
                  <li><b>{{trans('labels.product_code')}}:</b> <span itemprop="mpn">{{$data['product']->product_code}}</span></li>
                  
                  <li><b> {{trans('labels.store_existance')}}:</b> @if($data['product']->qty>0) <span class="instock"> {{trans('labels.existance')}} </span> @else <span class="instock" style="background:#e20423"> {{trans('labels.not_existance')}} </span>  @endif </li>
                </ul>
                <ul class="price-box">
                  <li class="price" itemprop="offers" ><span class="price-old">{{$data['product']->old_price}}</span> <span itemprop="price">{{$data['product']->price}}  {{$data['setting']->currency}}<span itemprop="availability" content="موجود"></span></span></li>
                  <li></li>
                  <table class="table price-tax more_price" style="font-size:14px;"> 
                    
                      <tr><th>{{trans('labels.qty')}}</th><th>{{trans('labels.price')}}</th></tr> 
                  <?php  $morePrice= explode(",", $data['product']->more_price);
                         echo '<tr product_qty="1" product_price="'.$data['product']->price.'" class="product_qty1"><td>1 <span class="fa fa-plus"></span></td><td>'.$data['product']->price.' '.$data['setting']->currency.'</td></tr>';
						if($data['product']->more_price!=""):
						for ($i=0; $i<count($morePrice); $i++) {
                          $price=explode(":", $morePrice[$i])[0];
                          $qty=explode(":", $morePrice[$i])[1];
                         if($i==count($morePrice)-1){
                            $endqty='&#8734;';
                         } 
                         else{
                          $endqty=explode(":", $morePrice[$i+1])[1]-1;
                         } 
                          echo '<tr product_qty="'.$qty.'" product_price="'.$price.'" class="product_qty'.$qty.'"><td>'.$qty.' <span class="fa fa-plus"></span></td><td>'.$price.' '.$data['setting']->currency.'</td></tr>';
                        }
                       endif;						
                       ?>
                     
                    </table>   
                </ul>
                <div id="product">
                  <div class="cart">
                    <div>
                      <div class="qty">
                        <label class="control-label" for="input-quantity">{{trans('labels.qty')}}</label>
                        <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
                        <a class="qtyBtn plus change_qty" href="javascript:void(0);">+</a><br />
                        <a class="qtyBtn mines change_qty" href="javascript:void(0);">-</a>
                        <div class="clear"></div>
                      </div>
                      <button type="button" id="button-cart" class="btn btn-primary btn-lg" product_id="{{$data['product']->id}}"  product_name="{{$data['product']->name}}" product_price="{{$data['product']->price}}" product_image="{{$data['product']->feature_image}}">{{trans('labels.add_to_cart')}} &nbsp;&nbsp;|&nbsp;&nbsp;  <span class="fa fa-shopping-cart"></span></button>
                    </div>

                    
                       @if($data['product']->guide_file!="")
                       
                         <a href="{{asset('public/uploads/guide/'.$data['product']->guide_file)}}" class="btn btn-success datashit_download" download="download">{{trans('labels.datashit_download')}}</a>
                       @endif  
                   
                  </div>
                </div>
              
                <!-- AddThis Button BEGIN -->
              </div>
            </div>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#short-description" data-toggle="tab">{{trans('labels.technical_desc')}}</a></li>
              <li><a href="#long-decription" data-toggle="tab"> {{trans('labels.description')}} </a></li>
              <li><a href="#tab-review" data-toggle="tab">{{trans('labels.comment')}}</a></li>
            </ul>
            <div class="tab-content">
              <div itemprop="description" id="short-description" class="tab-pane active">
                <div>
                    {!! $data['product']->short_desc !!}
                </div>
              </div>
              <div id="long-decription" class="tab-pane">
                  {!! $data['product']->long_desc !!}
              </div>

              <div id="tab-review" class="tab-pane">
                
                  <div id="review">
                    <div>
                      @foreach($data['comments'] as $comments) 
                      <table class="table table-striped table-bordered">
                        <tbody>
                          <tr>
                            <td style="width: 50%;"><strong><span>{{$comments->user_name}}</span></strong></td>
                          </tr>
                          <tr>
                            <td>{{$comments->content}}</td>
                          </tr>
                        </tbody>
                      </table>
                      @endforeach
                    </div>
                    <div class="text-right"></div>
                  </div>
                  

                  <div class="">
                       <form method="Post" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="row">
                          <input type="hidden" name="product_id" value="{{ $data['product']->id }}">
                          <div class="col-md-12 form-group">
                            <textarea class="form-control" id="message" rows="6" cols="5" 
                                name="message" placeholder="{{ trans('labels.message') }}"></textarea>
                          </div>
                          <div class="col-md-6 form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ trans('labels.name') }}">
                          </div>
                          <div class="col-md-6 form-group">
                            <input type="email" name="email" id="email" class="form-control" 
                                placeholder="{{ trans('labels.email') }}">
                          </div>
                          <div class=" col-md-6 form-group">
                            <button type="submit" class="btn">{{ trans('labels.comment') }}</button>
                          </div>
                        </div> <!-- end of row -->
                      </form>
                  </div>
               
              </div>
            </div>
            <h3 class="subtitle">{{trans('labels.more_products')}}</h3>
            <div class="owl-carousel related_pro">
          @foreach($data['more_product'] as $moreProduct) 
              <div class="product-thumb">
                <div class="image"><a href="{{asset('product?id='.$moreProduct->id.'&name='.$moreProduct->name)}}"><img src="{{asset('public/uploads/products')}}/{{$moreProduct->feature_image}}" alt="{{$moreProduct->name}}" title="{{$moreProduct->name}}" class="img-responsive" /></a></div>
                <div class="caption">
                  <h4><a href="{{asset('product?id='.$moreProduct->id.'&name='.$moreProduct->name)}}">{{$moreProduct->name}}</a></h4>
                  <p class="price"> <span class="price-new">{{$moreProduct->price}}  {{$data['setting']->currency}}</span> <span class="price-old">{{$moreProduct->old_price}} </span>  </p>
                 
                </div>
                <div class="button-group">
                  <button class="btn-primary add_to_cart_more" type="button" p_id="{{$moreProduct->id}}" price="{{$moreProduct->price}}" p_name="{{$moreProduct->name}}" image="{{$moreProduct->feature_image}}"><span> {{trans('labels.add_to_cart')}}</span></button>
                  
                </div>
              </div>
            @endforeach   
            </div>
          </div>
        </div>
        <!--Middle Part End -->
        <!--Right Part Start -->
		
		
		
        <aside id="column-right" class="col-sm-3 hidden-xs">
          @include('fronted.includes.left-sidebar')  
        </aside>
        <!--Right Part End -->
      </div>
    </div>
 

   @endsection
   @section('style')
     <style type="text/css">
     
        .qty #button-cart, .qty #input-quantity{
          width: 80px; 
          height: 43px;
          font-size: 22px;
        }
        .qty a{
          width: 30px;
          background-position: 7px 2px;
        }
        #short-description img,#short-description p, #short-description iframe, #long-decription img, #long-decription iframe,#long-decription p{
            max-width: 100%;
            width: auto !important;
        }
		#swipebox-overlay{display:none;}
		.product-info .image-additional a img{max-height:85px;}
		#zoom_01{max-height:240px}
		
		.datashit_download{
		    margin-right: 169px;
            width: 170px;
		}
		@media(max-width:768px){
		  .datashit_download{
			margin-right: 0px;  
		  }	
		}
    .qty #button-cart, .qty #input-quantity{font-size: 16px}

     </style>
  

   @endsection

   @section('script')
   
      <script type="text/javascript">
	  
	  $("#zoom_01").elevateZoom({
	gallery:'gallery_01',
	cursor: 'pointer',
	galleryActiveClass: 'active',
	imageCrossfade: true,
	zoomWindowFadeIn: 500,
	zoomWindowFadeOut: 500,
	zoomWindowPosition : 11,
	lensFadeIn: 500,
	lensFadeOut: 500,
	loadingIcon: APP_URL+'/public/icons/progress.gif'
	}); 
		//////pass the images to swipebox
		$("#zoom_01").bind("click", function(e) {
		  var ez =   $('#zoom_01').data('elevateZoom');
			$.swipebox(ez.getGalleryList());
		  return false;
		});
          $(document).on("change","#input-quantity",function(){
               var qty=$(this).val();
               var active_qty='';
               $(".more_price tr").each(function(){
                 if(parseInt(qty)>=parseInt($(this).attr('product_qty'))){
                   active_qty=parseInt($(this).attr('product_qty'));
                   var active_price=parseInt($(this).attr('product_price'));
                   $("#button-cart").attr("product_price",active_price);
                 }
                 
                  $('table.more_price tr').removeClass('active_price_row');
                 $(".product_qty"+active_qty).addClass('active_price_row');
               })
          });
        

          $( ".change_qty" ).bind( "click", function() {
            $("#input-quantity").trigger("change");
          });


      $(document).on("click","#button-cart",function(){
         var name=$(this).attr("product_name");
         var price=$(this).attr("product_price");
         var id=$(this).attr("product_id");
         var image=$(this).attr("product_image");
         var qty=$("#input-quantity").val(); 
         var loader=$(".page_loader");
         loader.show();
         $.ajax({
          type:'get',
          url:APP_URL+'/cart/add_to_cart?id='+id+'&name='+name+'&price='+price+'&qty='+qty+'&image='+image+'&update=1',
          success:function(resource){
             $("#cart-total b").text(resource);
             loader.hide();
          }
         })
       })




      
       $(document).on("click",".add_to_cart_more",function(){
         var name=$(this).attr("p_name");
         var price=$(this).attr("price");
         var id=$(this).attr("p_id");
         var image=$(this).attr("image");
         var qty=1; 
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

       $("button[type='submit']").click(function(){
           $(".page_loader").show();
        })

      </script>
   @endsection