@extends('fronted.layout.app')
   @section('main_content')  

  
    <div class="container">
      <div class="row">
        <!-- Left Part Start-->
        <aside id="column-left" class="col-sm-3 hidden-xs">
            @include('fronted.includes.right-sidebar')   
    </aside>
        <!-- Left Part End-->
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <!-- Slideshow Start-->
          <div class="slideshow single-slider owl-carousel">
            @foreach($sliders as $slider)
              <div class="item">
                <img class="img-responsive" src='{{ asset("public/uploads/sliders/$slider->image") }}' alt="{{ $slider->title }}" />
                <div class="details" style="display: none;">
                    
                </div>
              </div>

            @endforeach
          </div>
          <!-- Slideshow End-->
          <div class="row home_categories_section home_category_slider">
            <?php 
			 $categories= DB::table('tbl_product_category')->where('parent_id', null)->where('parent_parent_id',null)->orderBy('id', 'DESC')
                      ->get();
			  foreach($categories as $cat):		  
			?>
			  <a href="{{asset('store?category_id='.$cat->id.'&name='.$cat->name)}}">
			   <div class="item">
          @if($cat->photo!="")
			      <img src="{{asset('public/uploads/product_category/'.$cat->photo)}}" >
          @else
            <img src="{{asset('public/icons/category.png')}}" >
          @endif  
			       <h3>{{$cat->name}}</h3>
				</div>
			   </a>
			<?php endforeach;?>
          </div>		  
          <?php $Special_products =  DB::table('tbl_products')->where('old_price', '!=', '')->where('price', '!=', '')->orderBy('id', 'DESC')
                      ->limit(10)->get(); ?>

          <!-- Featured محصولات Start-->
          <h3 class="subtitle">{{trans('labels.special_product')}}</h3>
          <div class="owl-carousel product_carousel">
            @foreach($Special_products as $product)
            <div class="product-thumb clearfix">
              <div class="image"><a href="{{asset('product?id='.$product->id.'&name='.$product->name)}}"><img src='{{ asset("public/uploads/products/$product->feature_image") }}' 
                  alt="{{ $product->name }}" 
                  title="{{ $product->name }}" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="{{asset('product?id='.$product->id.'&name='.$product->name)}}" >{{ $product->name }}</a></h4>
                <p class="price"><span class="price-new">{{ $product->price }} {{$data['setting']->currency}}</span>
                  <span class="price-old">{{$product->old_price}} {{$data['setting']->currency}}</span>

                    <table class="table price-tax more_price_table" style="display:none;">
                      @if($product->more_price!="")  
                      <tr><th>{{trans('labels.qty')}}</th><th>{{trans('labels.price')}}</th></tr> 
                        
                      <?php  $morePrice= explode(",", $product->more_price);
                      $i=0;
                        foreach ($morePrice as $mp) {
                          $price=explode(":", $mp)[0];
                          $qty=explode(":", $mp)[1];

                          if($i==count($morePrice)-1){
                            $endqty='&#8734;';
                         } 
                         else{
                          $endqty=explode(":", $morePrice[$i+1])[1]-1;
                         }
                          echo '<tr><td>'.$qty.' - '.$endqty.'</td><td>'.$price.'</td></tr>';
                          $i++;
                        }  
                       ?>
                       @endif
                       </table>
                </p>

              </div>
              <div class="button-group">
                <button class="btn-primary add_to_cart_btn"  product_name="{{$product->name}}"  product_id="{{$product->id}}"  product_price="{{$product->price}}" product_image="{{$product->feature_image}}" ><span>{{trans('labels.add_to_cart')}}</span></button>
               
              </div>
            </div>
            @endforeach
           </div>
          <!-- Featured محصولات End-->

          <?php $latest_products =  DB::table('tbl_products')->where('old_price',null)->orderBy('id', 'DESC')->limit(10)->get(); ?>

          <!-- Featured محصولات Start-->
          <h3 class="subtitle">{{trans('labels.recent_product')}}</h3>
          <div class="owl-carousel product_carousel">
            @foreach($latest_products as $product)
            <div class="product-thumb clearfix">
              <div class="image"><a href="{{asset('product?id='.$product->id.'&name='.$product->name)}}"><img src='{{ asset("public/uploads/products/$product->feature_image") }}' 
                  alt="{{ $product->name }}" 
                  title="{{ $product->name }}" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="{{asset('product?id='.$product->id.'&name='.$product->name)}}">{{ $product->name }}</a></h4>
                <p class="price"><span class="price-new">{{ $product->price }} {{$data['setting']->currency}}</span>
                                <span class="price-old">{{$product->old_price}} </span>
                   
                     <table class="table price-tax more_price_table" style="display:none;">
                      @if($product->more_price!="")  
                      <tr><th>{{trans('labels.qty')}}</th><th>{{trans('labels.price')}}</th></tr> 
                        
                      <?php  $morePrice= explode(",", $product->more_price);
                      $i=0;
                        foreach ($morePrice as $mp) {
                          $price=explode(":", $mp)[0];
                          $qty=explode(":", $mp)[1];

                          if($i==count($morePrice)-1){
                            $endqty='&#8734;';
                         } 
                         else{
                          $endqty=explode(":", $morePrice[$i+1])[1]-1;
                         }
                          echo '<tr><td>'.$qty.' - '.$endqty.'</td><td>'.$price.'</td></tr>';
                          $i++;
                        }  
                       ?>
                       @endif
                       </table>
                </p>
              </div>
              <div class="button-group">
                <button class="btn-primary add_to_cart_btn"  product_name="{{$product->name}}"  product_id="{{$product->id}}"  product_price="{{$product->price}}" product_image="{{$product->feature_image}}" ><span>{{trans('labels.add_to_cart')}}</span></button>
                
              </div>
            </div>
            @endforeach
           </div>
          <!-- Featured محصولات End-->
          
          <!-- blog posts -->
          <?php $posts =  DB::table('tbl_posts')->orderBy('id', 'asc')->limit(3)->get(); ?>
          <h3 class="subtitle">{{trans('labels.latest_news')}}</h3>
          <div class="marketshop-banner">
            <div class="row">
              @foreach($posts as $post)
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <a href='{{ asset("blog/post?id=".$post->id."&title=".$post->title) }}'>
                    <img src='{{ asset("public/uploads/posts/$post->featured_image") }}' alt="{{ $post->title }}" title="{{ $post->title }}" />
                  </a>
                  <h4>
                    <a href='{{ asset("blog/post?id=".$post->id."&title=".$post->title) }}'>{{ $post->title }}</a>
                  </h4>
                  <p>{{ str_limit($post->except, $limit = 50, $end = ' ...') }}</p>
                </div>
              @endforeach
            </div>
          </div>
          <!-- end of blog posts -->

          <!-- blog posts -->
          <?php $downloads =  DB::table('tbl_downloads')->orderBy('id', 'asc')->limit(2)->get(); ?>
          <h3 class="subtitle"> {{trans('labels.downloads')}}</h3>
          <div class="marketshop-banner downloads_banner">
            <div class="row">
              @foreach($downloads as $download)
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <a href='{{ asset("view-download?id=".$download->id."&download=".$download->name) }}'>
                    <img src='{{ asset("public/uploads/files_image/$download->image") }}' 
                        alt="{{ $download->name }}" title="{{ $download->name }}" />
                  </a>
                  <h4>
                    <a href='{{ asset("view-download?id=".$download->id."&download=".$download->name) }}'>{{ $download->name }}</a>
                  </h4>
                  <p>{!! str_limit($download->description, $limit = 150, $end = ' ...') !!}</p>
                  <a href='{{ asset("view-download?id=".$download->id."&download=".$download->name) }}' class="download_link">
                    {{ trans('labels.view') }} &nbsp; <span class="fa fa-angle-left"></span>
                  </a>
                </div>
              @endforeach
            </div>
          </div>
          <!-- end of blog posts -->
          
        </div>
        <!--Middle Part End-->
      </div>
    </div>
 
 <!-- Feature Box Start-->
    <div class="container">
      <div class="custom-feature-box row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="feature-box fbox_1">
		  <?php $footerNote=DB::table('tbl_note')->where('id',1)->first();?>
            <div class="title"> {{$footerNote->title1}} </div>
            <p> {{$footerNote->description1}} </p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="feature-box fbox_2">
            <div class="title"> {{$footerNote->title2}} </div>
            <p> {{$footerNote->description2}}  </p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="feature-box fbox_3">
            <div class="title">{{$footerNote->title3}}  </div>
            <p> {{$footerNote->description3}} </p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="feature-box fbox_4">
            <div class="title">{{$footerNote->title4}} </div>
            <p>{{$footerNote->description4}} </p>
          </div>
        </div>
      </div>
    </div>
    <!-- Feature Box End-->
 @endsection

 @section('style')
  <style type="text/css">
   .caption{
    position: relative;
   }
   .product-thumb:hover .more_price_table{
     display: table;
   }
  .more_price_table{
      
    }
	.home_categories_section{
		text-align:center;
		margin-bottom:30px;
	}
	.home_categories_section h3{margin:0px;font-size:17px;}
	.home_categories_section img{
    width: 100%;
  }
  .custom-feature-box .feature-box{
    min-height: 103px;
  }
  
  </style>
 @endsection
 
 @section('script')
   <script>
       $(document).on("click",".add_to_cart_btn",function(){
         var name=$(this).attr("product_name");
         var price=$(this).attr("product_price");
         var id=$(this).attr("product_id");
         var image=$(this).attr("product_image");
         var qty=1; 
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


  
$('.home_category_slider').owlCarousel({
	items : 3
	autoPlay: 3000,
	pagination: true,
	loop:true,
    margin:10,
   responsive : {
            0 : { items : 2  }, // from zero to 480 screen width 4 items
            480 : { items : 3  }, // from zero to 480 screen width 4 items
            768 : { items : 3  }, // from 480 screen widthto 768 6 items
            1024 : { items : 6  } // from 768 screen width to 1024 8 items
            
        },
});

   </script>
 @endsection