<h3 class="subtitle">دسته ها</h3>
<div class="box-category">
  <ul id="cat_accordion">

    <?php  $categories = DB::table('tbl_product_category')->get(); ?>
    @foreach($categories as $category)
      @if($category->parent_id == '')
        <li><a href="category.html">{{ $category->name }}</a> <span class="down"></span>
          <ul>
            <?php $subCat = DB::table('tbl_product_category')->where('parent_id',$category->id)->get(); ?>
            @foreach($subCat as $cat)
            <li><a href="category.html">{{ $cat->name }}</a> <span class="down"></span>
              <ul>
                    <?php $grandCat = DB::table('tbl_product_category')->where('parent_id',$cat->id)->get(); ?>
                    @foreach($grandCat as $grand)
                        <li><a href="category.html">{{ $grand->name }}</a></li>
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

<h3 class="subtitle">جدیدترین ها</h3>
<div class="side-item">
   <?php $products =  DB::table('tbl_products')->orderBy('id', 'asc')->limit(10)->get(); ?>
   @foreach($products as $product)
      <div class="product-thumb clearfix">
        <div class="image">
          <a href="product.html">
            <img src='{{ asset("/uploads/products/$product->feature_image") }}' alt="" title="" class="img-responsive" />
          </a>
        </div>
        <div class="caption">
          <h4><a href="product.html">{{ $product->name }}</a></h4>
          <p class="price"> <span class="price-new">{{ $product->price }} افغانی </span>
            <span class="price-old">
              @if($product->old_price != '')
                {{ $product->old_price }} افغانی
              @endif
            </span>
          </p>
        </div>
      </div>
   @endforeach
</div>

<h3 class="subtitle"> ویژه ها</h3>
<div class="side-item">
   <?php $products =  DB::table('tbl_products')->where('old_price', '!=', '')->where('price', '!=', '')->orderBy('id', 'asc')
                      ->limit(10)->get(); ?>
   @foreach($products as $product)
      <div class="product-thumb clearfix">
        <div class="image">
          <a href="product.html">
            <img src='{{ asset("/uploads/products/$product->feature_image") }}' alt="" title="" class="img-responsive" />
          </a>
        </div>
        <div class="caption">
          <h4><a href="product.html">{{ $product->name }}</a></h4>
          <p class="price"> <span class="price-new">{{ $product->price }} افغانی </span> <span class="price-old">{{ $product->old_price }} افغانی</span></p>
        </div>
      </div>
   @endforeach
</div>