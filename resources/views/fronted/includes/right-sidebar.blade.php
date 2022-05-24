<h3 class="subtitle">{{trans('labels.categories')}}</h3>
<div class="box-category">
  <ul id="cat_accordion">

    <?php  $categories = DB::table('tbl_product_category')->get(); ?>
    @foreach($categories as $category)
      @if($category->parent_id == '')
        <li><a href="{{asset('store?category_id='.$category->id.'&name='.$category->name)}}">{{ $category->name }}</a> <span class="down"></span>
          <ul>
            <?php $subCat = DB::table('tbl_product_category')->where('parent_id',$category->id)->get(); ?>
            @foreach($subCat as $cat)
            <li><a href="{{asset('store?category_id='.$cat->id.'&name='.$cat->name)}}">{{ $cat->name }}</a> <span class="down"></span>
              <ul>
                    <?php $grandCat = DB::table('tbl_product_category')->where('parent_id',$cat->id)->get(); ?>
                    @foreach($grandCat as $grand)
                        <li><a href="{{asset('store?category_id='.$grand->id.'&name='.$grand->name)}}">{{ $grand->name }}</a></li>
                    @endforeach

              </ul>
            </li>
            @endforeach
          </ul>
        </li>
      @endif
    @endforeach
  </ul>
</div>

<h3 class="subtitle">{{trans('labels.recent_product')}}</h3>
<div class="side-item">
   <?php $products =  DB::table('tbl_products')->orderBy('id', 'desc')->limit(10)->get(); ?>
   @foreach($products as $product)
      <div class="product-thumb clearfix">
        <div class="image">
          <a href="{{asset('product?id='.$product->id.'&name='.$product->name)}}">
            <img src='{{ asset("public/uploads/products/$product->feature_image") }}' alt="" title="" class="img-responsive" />
          </a>
        </div>
        <div class="caption">
          <h4><a href="{{asset('product?id='.$product->id.'&name='.$product->name)}}">{{ $product->name }}</a></h4>
          <p class="price"> <span class="price-new">{{ $product->price }}  {{$data['setting']->currency}}</span>
            <span class="price-old">
              @if($product->old_price != '')
                {{ $product->old_price }}  {{$data['setting']->currency}}
              @endif
            </span>
          </p>
        </div>
      </div>
   @endforeach
</div>

<h3 class="subtitle"> {{trans('labels.special_product')}}</h3>
<div class="side-item">
   <?php $products =  DB::table('tbl_products')->where('old_price', '!=', '')->where('price', '!=', '')->orderBy('id', 'desc')
                      ->limit(10)->get(); ?>
   @foreach($products as $product)
      <div class="product-thumb clearfix">
        <div class="image">
          <a href="{{asset('product?id='.$product->id.'&name='.$product->name)}}">
            <img src='{{ asset("public/uploads/products/$product->feature_image") }}' alt="" title="" class="img-responsive" />
          </a>
        </div>
        <div class="caption">
          <h4><a href="{{asset('product?id='.$product->id.'&name='.$product->name)}}"	>{{ $product->name }}</a></h4>
          <p class="price"> <span class="price-new">{{ $product->price }} {{$data['setting']->currency}}</span> <span class="price-old">{{ $product->old_price }}  {{$data['setting']->currency}}<span></p>
        </div>
      </div>
   @endforeach
</div>