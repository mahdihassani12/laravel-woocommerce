
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

<div class="list-group">
  <h3 class="subtitle">محتوای سفارشی</h3>
  <p>این یک بلاک محتواست. هر نوع محتوایی شامل html، نوشته یا تصویر را میتوانید در آن قرار دهید. </p>
  <p> در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد. </p>
  <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
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
        