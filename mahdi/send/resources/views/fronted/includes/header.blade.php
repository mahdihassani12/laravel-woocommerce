   <div id="header">
    <!-- Top Bar Start-->
    <nav id="top" class="htop">
      <div class="container">
        <div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
          <div class="pull-left flip left-top">
            <div class="links">
              <ul>
                <li class="mobile"><i class="fa fa-phone"></i>+21 9898777656</li>
                <li class="email"><a href="mailto:info@marketshop.com"><i class="fa fa-envelope"></i>info@marketshop.com</a></li>
              
                <li><a href="checkout.html">تسویه حساب</a></li>
                <li><a href="checkout.html">ثبت خرید</a></li>
              </ul>
            </div>
          </div>
          <div id="top-links" class="nav pull-right flip">
            <ul>
              <li><a href="login.html">ورود</a></li>
              <li><a href="register.html">ثبت نام</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- Top Bar End-->
    <!-- Header Start-->
    <header class="header-row">
      <div class="container">
        <div class="table-container">
          <!-- Logo Start -->
          <div class="col-table-cell col-lg-6 col-md-6 col-sm-12 col-xs-12 inner">
            <div id="logo"><a href="index.html"><img class="img-responsive" src="{{asset('fronted/image/logo.png')}}" title="MarketShop" alt="MarketShop" /></a></div>
          </div>
          <!-- Logo End -->
          <!-- Mini Cart Start-->
          <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div id="cart">
              <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="heading dropdown-toggle">
              <span class="cart-icon pull-left flip"></span>
              <span id="cart-total">2 آیتم - 132000 تومان</span></button>
              <ul class="dropdown-menu">
                <li>
                  <table class="table">
                    <tbody>
                      <tr>
                        <td class="text-center"><img class="img-thumbnail" title="کفش راحتی مردانه" alt="کفش راحتی مردانه" src="{{asset('fronted/image/product.jpg')}}"></td>
                        <td class="text-left">کفش راحتی مردانه </td>
                        <td class="text-right">x 1</td>
                        <td class="text-right">32000 تومان</td>
                        <td class="text-center"><button class="btn btn-danger btn-xs remove" title="حذف" onClick="" type="button"><i class="fa fa-times"></i></button></td>
                      </tr>
                      <tr>
                        <td class="text-center"><img class="img-thumbnail" title="تبلت ایسر" alt="تبلت ایسر" src="{{asset('fronted/image/product.jpg')}}"></td>
                        <td class="text-left">تبلت ایسر </td>
                        <td class="text-right">x 1</td>
                        <td class="text-right">98000 تومان</td>
                        <td class="text-center"><button class="btn btn-danger btn-xs remove" title="حذف" onClick="" type="button"><i class="fa fa-times"></i></button></td>
                      </tr>
                    </tbody>
                  </table>
                </li>
                <li>
                  <div>
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td class="text-right"><strong>جمع کل</strong></td>
                          <td class="text-right">132000 تومان</td>
                        </tr>
                        <tr>
                          <td class="text-right"><strong>کسر هدیه</strong></td>
                          <td class="text-right">4000 تومان</td>
                        </tr>
                        <tr>
                          <td class="text-right"><strong>مالیات</strong></td>
                          <td class="text-right">11880 تومان</td>
                        </tr>
                        <tr>
                          <td class="text-right"><strong>قابل پرداخت</strong></td>
                          <td class="text-right">139880 تومان</td>
                        </tr>
                      </tbody>
                    </table>
                    <p class="checkout"><a href="cart.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> مشاهده سبد</a>&nbsp;&nbsp;&nbsp;<a href="checkout.html" class="btn btn-primary"><i class="fa fa-share"></i> تسویه حساب</a></p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <!-- Mini Cart End-->
          <!-- جستجو Start-->
          <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12 inner">
            <div id="search" class="input-group">
              <form method="get" action="{{asset('store')}}">
              <input id="search" type="text" name="search" value="" placeholder="{{trans('labels.search_product')}}" class="form-control input-lg" />
              <button type="submit" class="button-search"><i class="fa fa-search"></i></button>
              </form> 
            </div>
          </div>
          <!-- جستجو End-->
        </div>
      </div>
    </header>
    <!-- Header End-->
    <?php

      $categories = DB::table('tbl_product_category')->get();

    ?>
    <!-- Main آقایانu Start-->
    <div class="container">
      <nav id="menu" class="navbar">
        <div class="navbar-header"> <span class="visible-xs visible-sm"> منو <b></b></span></div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li><a class="home_link" title="خانه" href="index.html"><span>خانه</span></a></li>
            <li class="mega-menu dropdown"><a>دسته ها</a>
              <div class="dropdown-menu">

                @foreach($categories as $category)
                  @if($category->parent_id == '')
                    <div class="column col-lg-2 col-md-3"><a href="category.html">{{ $category->name }}</a>

                      <div>
                        <ul>
                          <?php $subCat = DB::table('tbl_product_category')->where('parent_id',$category->id)->get(); ?>
                          @foreach($subCat as $cat)
                              <li><a href="category.html" >{{ $cat->name }}</a>
                                <div class="dropdown-menu">
                                  <ul>
                                    <?php $grandCat = DB::table('tbl_product_category')->where('parent_id',$cat->id)->get(); ?>
                                    @foreach($grandCat as $grand)
                                      <li><a href="category.html">{{ $grand->name }}</a></li>
                                    @endforeach
                                  </ul>
                                </div>
                              </li>

                          @endforeach
                        </ul>
                      </div>

                    </div> <!-- end of parent category -->
                  @endif
                @endforeach
              
              </div> <!-- end of category drop down -->

            </li>
            <li class="contact-link"><a href="{{asset('store')}}">{{trans('labels.store')}}</a></li>
            <li class="contact-link"><a href="{{ route('product-request') }}">{{ trans('labels.request_product') }}</a></li>
            <li class="contact-link"><a href="{{ route('download-file') }}">{{ trans('labels.downloads') }}</a></li>
			       <li class="contact-link"><a href="{{ route('blog.index') }}">{{ trans('labels.blog') }}</a></li>
            <li class="contact-link"><a href="{{ route('our-services') }}">{{ trans('labels.services') }}</a></li>
			      <li class="contact-link"><a href="{{ route('contact-us') }}">{{ trans('labels.contact_us') }}</a></li>
            <li class="contact-link"><a href="{{ route('about-us') }}">{{ trans('labels.about_us') }}</a></li>
			     <li class="custom-link-right"><a href="#" target="_blank"> همین حالا بخرید!</a></li>
          </ul>
        </div>
      </nav>
    </div>
    <!-- Main آقایانu End-->
  </div>
 

